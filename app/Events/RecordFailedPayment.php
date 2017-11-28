<?php

namespace App\Events;

class RecordFailedPayment implements HandlerInterface {
	public function handle($event) {
		$event->order->payment()->create([
			'failed' => true,
			'transaction_id' => null
		]);	
	}
}