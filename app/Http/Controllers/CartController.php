<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Basket\Basket;
use App\Basket\QuantityExcededException;

class CartController extends Controller
{

	protected $basket;
	protected $product;

	public function __construct(Basket $basket, Product $product) {
		$this->basket = $basket;
		$this->product = $product;
	}

    // Show the shopping cart with added items
    public function index() {
        $this->basket->refresh();
    	return view('cart.index');
    }

    // Add a product to the shopping cart
    public function add($slug, $quantity) {
    	$product = $this->product->where('slug', $slug)->first();

    	if (!$product) {
    		return redirect()->route('home');
    	}

        // Throw exception if quantity of product is added to cart
        // that exceeds stock quantity.
    	try {
    		$this->basket->add($product, $quantity);
    	} catch(QuantityExcededException $e) {
    		return redirect()->route('cart.index')->with('message', $e->message);
    	}

        return redirect()->route('cart.index')->with('message','Added ' . $product->title . ' to cart.');
    }

    // Update product quantity in cart
    public function update(Request $request, $slug) {
        $product = $this->product->where('slug', $slug)->first();

        if (!$product) {
            return redirect()->route('home');
        }

        try {
            $this->basket->update($product, $request->quantity);
        } catch(QuantityExcededException $e) {
            return redirect()->route('cart.index')->with('message', $e->message);
        }

        return redirect()->route('cart.index')->with('message', 'Updated ' . $product->title . ' quantity.');
    }

    // Remove a Product from the cart
    public function remove($slug) {
    	$product = $this->product->where('slug', $slug)->first();

    	if (!$product) {
    		return redirect()->route('home');
    	}

    	$this->basket->remove($product);

        return redirect()->route('cart.index');
    }

    // Clear the entire cart of Products
    public function flush() {
    	$this->basket->clear();

        return redirect()->route('cart.index');
    }

}
