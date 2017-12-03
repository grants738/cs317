<?php

namespace App\Events;

// Clears shopping cart
class EmptyBasket implements HandlerInterface {
	public function handle($event) {
		$event->basket->clear();
	}
}