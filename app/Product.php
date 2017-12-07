<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use Storage;

class Product extends Model
{
    public $quantity = null;

    // Mass assignable properties
    protected $fillable = [
        'title', 
        'slug', 
        'description', 
        'image', 
        'stock', 
        'price'
    ];

    // Check if product is low in stock
    public function hasLowStock() {
    	if ($this->outOfStock()) {
    		return false;
    	}

    	return (bool) ($this->stock <= 5);
    }

    // Check if product is out of stock
    public function outOfStock() {
    	return $this->stock === 0;
    }

    // Check if product is in stock
    public function inStock() {
    	return $this->stock >= 1;
    }

    // Check if product has stock
    public function hasStock($quantity) {
    	return $this->stock >= $quantity;
    }

    // Order contains many Products
    public function order() {
        return $this->belongsToMany(Order::class, 'orders_products')->withPivot('quantity');
    }

    public function getImageURL() {
        if (substr($this->image, 0, 4) === "http") {
            return $this->image;
        }

        return Storage::url($this->image);
    }

    public function truncateDescription() {
        if(strlen($this->description) > 25)
            return substr($this->description, 0, 25) . '...';

        return $this->description;
    }
}
