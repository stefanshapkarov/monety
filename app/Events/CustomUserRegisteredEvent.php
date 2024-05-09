<?php

namespace App\Events;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomUserRegisteredEvent extends Registered
{
    use Dispatchable, SerializesModels;

    public function __construct($user, public $currency)
    {
        parent::__construct($user);
    }
}
