<?php

namespace App\Listeners;

use App\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateAccount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        // When a user is registered we initialize its Account object
        $user = $event->user;
        $account = new Account();
        $user->account()->save($account);
    }
}
