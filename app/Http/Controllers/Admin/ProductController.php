<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::all();

    	return view('admin.products.products')->with('products', $products);
    }

    public function show(Product $product)
    {
        if(!$product)
            return back()->with('error', 'Product not found.');

    	return view('admin.products.product')->with('product', $product);
    }

    public function update(Request $request, Product $product)
    {
        if(!$product)
            return back()->with('error', 'Product not found');

    	$this->validate($request,[
    		'title' => 'required|max:255',
    		'slug' => 'required',
    		'description' => 'max:255',
    		'price' => 'required|numeric',
    		'stock' => 'required|numeric'
    	]);

    	$product->update($request->only(['title','slug','description','price','stock']));

    	return redirect()->route('admin.products')->with('success','Product information updated.');
    }

    public function showCreate()
    {
    	return view('admin.products.create');
    }

    public function create(Request $request)
    {
    	$this->validate($request,[
    		'title' => 'required|max:255',
    		'slug' => 'required',
    		'description' => 'max:255',
    		'price' => 'required|numeric',
    		'stock' => 'required|numeric'
    	]);

    	Product::create($request->only(['title','slug','description','price','stock']));

    	return redirect()->route('admin.products')->with('success', 'Product created.');
    }

    public function delete(Product $product)
    {
        if(!$product)
            return back()->with('error', 'Product not found');

    	$product->delete();

    	return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }
}
