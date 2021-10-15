<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ValidateEvent;
use App\Listeners\ValidateListener;
use App\Events\ProccessOrderEvent;
use App\Listeners\ProccessOrderListener;
use App\Events\ProccessListOrderEvent;
use App\Listeners\ProccessListOrderListener;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ValidateEvent::class =>[
            ValidateListener::class,
        ],
        ProccessOrderEvent::class =>[
            ProccessOrderListener::class,
        ],
         ProccessListOrderEvent::class =>[
            ProccessListOrderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
