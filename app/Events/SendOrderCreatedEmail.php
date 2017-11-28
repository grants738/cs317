<?php

namespace App\Events;

use App\Mail\OrderCreated;
use Mail;

class SendOrderCreatedEmail implements HandlerInterface
{

	public function handle($event) {
		$m = new OrderCreated($event->order);

        Mail::to($event->order->customer)->send($m);
	}
}


