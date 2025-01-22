<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\CreateUserWallet;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        Registered::class => [
            CreateUserWallet::class,
        ],
    ];

}


