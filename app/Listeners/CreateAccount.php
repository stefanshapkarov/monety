<?php

namespace App\Listeners;

use App\Events\CustomUserRegisteredEvent;
use App\Models\Account;

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
    public function handle(CustomUserRegisteredEvent $event): void
    {
        // When a user is registered we initialize its Account object
        $user = $event->user;
        $account = new Account();
        $account->currency = $event->currency;
        $user->account()->save($account);
    }
}
