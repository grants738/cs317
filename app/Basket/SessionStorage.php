<?php

namespace App\Basket;

use Countable;
use App\Basket\StorageInterface;

class SessionStorage implements StorageInterface, Countable
{	
	protected $bucket;
	
	public function __construct() {
		if (!session()->has('cart')) {
			session(['cart' => []]);
		}

		$this->bucket = 'cart';
	}

	public function set($index, $value) {
		session([$this->bucket . '.' . $index => $value]);
	}

	public function get($index) {
		if (!$this->exists($index)) {
			return null;
		}

		return session($this->bucket . '.' . $index);
	}

	public function exists($index) {
		return session()->has($this->bucket . '.' . $index);
	}

	public function all() {
		return session($this->bucket);
	}

	public function unset($index) {
		if ($this->exists($index)) {
			session()->forget($this->bucket . '.' . $index);
		}
	}

	public function clear() {
		session()->forget($this->bucket);
	}

	public function count() {
		return count($this->all());
	}
}