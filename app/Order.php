<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Address;
use App\Product;
use App\Payment;
use App\Customer;

class Order extends Model
{
    // Mass assignment properties
    protected $fillable = [
    	'hash',
    	'total',
    	'paid',
    	'address_id'
    ];

    // Returns the associated address of the order
    public function address() {
    	return $this->belongsTo(Address::class);
    }

    // Returns all products associated with the order
    public function products() {
    	return $this->belongsToMany(Product::class, 'orders_products')->withPivot('quantity');
    }

    // Returns the payment associated with the order
    public function payment() {
        return $this->hasOne(Payment::class);
    }

    // Returns the customer data associated witht the order
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
