<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::all();

    	return view('admin.products.products')->with('products', $products);
    }

    public function show(Product $product)
    {
    	return view('admin.products.product')->with('product', $product);
    }

    public function update(Request $request, Product $product)
    {
    	$this->validate($request,[
    		'title' => 'required|max:255',
    		'slug' => 'required',
    		'description' => 'max:255',
    		'price' => 'required|numeric',
    		'stock' => 'required|numeric'
    	]);

    	$product->update($request->only(['title','slug','description','price','stock']));

        $this->storeImageIfExists($request);

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

        $product = Product::create($request->only(['title','slug','description','price','stock']));

        $this->storeImageIfExists($request);

    	return redirect()->route('admin.products')->with('success', 'Product created.');
    }

    public function delete(Product $product)
    {
    	$product->delete();

    	return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }

    protected function storeImageIfExists($request) {
         if($request->hasFile('image')) { 
            $path = $request->file('image')->store('public');

            $product->image = $path;

            $product->save();
        }
    }
}
