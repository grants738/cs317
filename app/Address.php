<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Address extends Model
{
	// Mass assignable properties
    protected $fillable = [
    	'address1',
    	'address2',
    	'city',
    	'postal_code'
    ];

    // Returns the order associated with the address
    public function order() {
    	return $this->hasMany(Order::class);
    }
}
