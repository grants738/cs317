<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Customer extends Model
{
	// Mass assignable properties
    protected $fillable = [
    	'email',
    	'name',
    ];

    // Returns the orders of the specified customer
    public function orders() {
    	return $this->hasMany(Order::class);
    }
}
