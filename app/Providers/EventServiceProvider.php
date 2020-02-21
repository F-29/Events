<?php

namespace App\Providers;

use App\Events\RegisterUserEvent;
use App\Listeners\CallAdminOnRegister;
use App\Listeners\SendVerificationCodeEmail;
use App\Listeners\SendWelcomeEmail;
use App\Subscriber\RegisterSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
        ],
        RegisterUserEvent::class => [
//            SendVerificationCodeEmail::class,
//            SendWelcomeEmail::class,
//            CallAdminOnRegister::class,
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
//        RegisterSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
