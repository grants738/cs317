<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function token() {
    	return response()->json([
    		'token' => \Braintree_ClientToken::generate()
    	]);
    }
}
