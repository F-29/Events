<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendVerificationCodeEmail
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
     *
     * @param RegisterUserEvent $event
     * @return void
     * @throws \Exception
     */
    public function handle(RegisterUserEvent $event)
    {
        $user = $event->user();
        $code = random_int(111111, 999999);
        Log::info('sending activation code to ' . $user->email . ' | activation code is: ' . $code);
    }
}
