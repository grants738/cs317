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
    	return view('admin.orders.order')->with('order', $order);
    }

    public function delete(Order $order)
    {
        // Detach items in pivot table
    	$order->products()->detach();

        // Remove customer associated with order
        if ($order->customer->orders()->count() < 2)
            $order->customer()->delete();

        // Remove address associated with order
        if ($order->address->order()->count() < 2)
            $order->address()->delete();

        // Remove payment associated with order
        $order->payment()->delete();

        // Remove order
        $order->delete();

    	return redirect()->route('admin.orders')->with('success', 'Order deleted');
    }
}
