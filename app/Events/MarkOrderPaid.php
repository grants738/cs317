<?php

namespace App\Events;

class MarkOrderPaid implements HandlerInterface
{
	public function handle($event) {
		$event->order->update([
			'paid' => true
		]);
	}
}