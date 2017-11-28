<?php

namespace App\Basket;

class QuantityExcededException extends \Exception {
	public $message = 'You have exceded the amount of items in stock.';
}