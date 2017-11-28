<?php

namespace App\Events;

interface HandlerInterface {
	public function handle($event);
}