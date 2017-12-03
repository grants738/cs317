<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
    	$orders = Order::all();

    	return view('admin.orders.orders')->with('orders', $orders);
    }

    public function show(Order $order)
    {
    	if (!$order)
    		return back()->with('error', 'Order not found.');

    	return view('admin.orders.order')->with('order', $order);
    }

    public function delete(Order $order)
    {
    	if (!$order)
    		return back()->with('error', 'Order not found.');

    	$order->delete();

    	return redirect()->route('admin.orders')->with('success', 'Order deleted');
    }
}
