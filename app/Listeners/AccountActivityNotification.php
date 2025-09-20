<?php

namespace App\Listeners;

use Filament\Pages\Auth\Login;
use IlluminateAuthEventsLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\AccountActivityNotification as UserLoginNotification;

class AccountActivityNotification
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
    public function handle(Login $event): void
    {
        //

        $event->user->notify(new  UserLoginNotification());
    }
}
