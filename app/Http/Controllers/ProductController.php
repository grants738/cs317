<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
	// Display product page
    public function get(Request $request, $slug) {
    	$product = Product::where('slug', $slug)->first();

    	return view('products.product')->with(['product' => $product]);
    }

    public function returnErrorIfNotExists($model, $message) {
    	if(!isset($model))
            return redirect()->route('home');
    }
}
