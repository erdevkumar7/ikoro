<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Events\Registered;

class CreateUserWallet
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Wallet::create([
            'user_id' => $event->user->id,
            'balance' => 0,
        ]);
    }
}
