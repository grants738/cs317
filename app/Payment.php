<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	// Mass assignable properties
    protected $fillable = [
    	'failed',
    	'transaction_id',
    ];
}
