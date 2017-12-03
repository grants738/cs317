<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
	// Display product page
    public function get(Request $request, $slug) {
    	$product = Product::where('slug', $slug)->first();

    	if (!$product) {
    		return redirect()->route('home');
    	}

    	return view('products.product')->with(['product' => $product]);
    }
}
