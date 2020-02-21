<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class EloquentObserverServiceProvider extends ServiceProvider
{
    /**
     * @var array register observers that you want to use
     */
    private $observers = [
        User::class => UserObserver::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->observers as $model => $observer) {
            /**
             * @var $model Illuminate\Database\Eloquent\Model
             */
            $model::observe($observer);
        }
    }
}
