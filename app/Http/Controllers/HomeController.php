<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
	// Show products page
    public function index() {
    	return view('home')->with(['products'=>Product::all()]);
    }
}
