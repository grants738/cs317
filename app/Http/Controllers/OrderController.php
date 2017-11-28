<?php

namespace App\Http\Controllers;

use App\Product;
use App\Customer;
use App\Basket\Basket;
use App\Address;
use App\Order;
use Mail;

use Illuminate\Http\Request;

class OrderController extends Controller
{
	protected $basket;

	public function __construct(Basket $basket) {
		$this->basket = $basket;
	}
    
    public function index() {

    	$this->basket->refresh();

    	if (!$this->basket->subTotal()) {
    		return redirect()->route('cart.index')->with('message', 'Something went wrong.');
    	}

    	return view('order.index');
    }

    public function show($hash, Order $order) {
        $order = $order->with(['address', 'products'])->where('hash', $hash)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', "We were unable to find the selected order.");
        }

        return view('order.show')->with('order', $order);
    }

    public function create(Request $request, Customer $customer, Address $address) {
    	$this->basket->refresh();

    	if (!$this->basket->subTotal()) {
    		return redirect()->route('cart.index')->with('message', 'One or more of the items in your cart have been removed due to stock changes');
    	}

        if (!$request->payment_method_nonce) {
            return redirect()->route('order.index')->with('message', "We're having issues with our payment system right now. Try again later.");
        }

    	$this->validate($request, [
    		'name' => 'required|max:255',
    		'email' => 'required|email|max:255',
    		'address1' => 'required|max:255',
    		'address2' => 'max:255',
    		'city' => 'required|max:255',
    		'zCode' => 'required|numeric'
    	]);

    	$hash = bin2hex(random_bytes(32));

    	$customer = $customer->firstOrCreate([
    		'email' => $request->email,
    		'name' => $request->name,
    	]);

    	$address = $address->firstOrCreate([
    		'address1' => $request->address1,
    		'address2' => $request->address2,
    		'city' => $request->city,
    		'postal_code' => $request->zCode
    	]);

    	$order = $customer->orders()->create([
    		'hash' => $hash,
    		'paid' => false,
    		'total' => $this->basket->subTotal() + 5,
    		'address_id' => $address->id
    	]);

    	$allItems = $this->basket->all();

    	$order->products()->saveMany(
    		$allItems,
    		$this->getQuantities($allItems)
    	);

    	$result = \Braintree_Transaction::sale([
            'amount' => $this->basket->subTotal() + 5,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $event = new \App\Events\OrderWasCreated($order, $this->basket);

        if (!$result->success) {
            $event->attach(new \App\Events\RecordFailedPayment);
            $event->dispatch();

            return redirect()->route('order.index')->with('error', 'The order payment failed. Please use another payment method.');
        }

        $event->attach([
            new \App\Events\UpdateStock,
            new \App\Events\MarkOrderPaid,
            new \App\Events\RecordSuccessfulPayment($result->transaction->id),
            new \App\Events\EmptyBasket,
            new \App\Events\SendOrderCreatedEmail
        ]);

        $event->dispatch();

        return redirect()->route('order.show', ['hash' => $hash])->with('success', "Your order has been placed and is preparing for shipment!");
    }

    protected function getQuantities($items) {
    	$quantities = [];

    	foreach ($items as $item) {
    		$quantities[] = ['quantity' => $item->quantity];
    	}

    	return $quantities;
    }
}
