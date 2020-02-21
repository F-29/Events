<?php


namespace App\Subscriber;


use App\Events\RegisterUserEvent;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class RegisterSubscriber implements Subscriber
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(RegisterUserEvent::class, RegisterSubscriber::class . "@sendHello");
        $events->listen(RegisterUserEvent::class, RegisterSubscriber::class . "@sendHowYouDoing");
        $events->listen(RegisterUserEvent::class, RegisterSubscriber::class . "@sendWhatsUp");
        $events->listen(RegisterUserEvent::class, RegisterSubscriber::class . "@sendBye");
    }

    public function sendHello()
    {
        Log::info("Hi!\n");
    }

    public function sendHowYouDoing()
    {
        Log::info("How You Doing\n");
    }

    public function sendWhatsUp()
    {
        Log::info("Whats Up\n");
    }

    public function sendBye()
    {
        Log::info("Bye!\n");
    }

    public function subscriber(\Illuminate\Contracts\Events\Dispatcher $events)
    {
        // TODO: Implement subscriber() method.
    }
}
