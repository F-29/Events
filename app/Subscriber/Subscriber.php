<?php


namespace App\Subscriber;


use Illuminate\Contracts\Events\Dispatcher;

interface Subscriber
{
    public function subscriber(Dispatcher $events);
}
