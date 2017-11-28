<?php

namespace App\Events;

class EmptyBasket implements HandlerInterface {
	public function handle($event) {
		$event->basket->clear();
	}
}