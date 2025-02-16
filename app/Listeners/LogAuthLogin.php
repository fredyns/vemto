<?php

namespace App\Listeners;

use App\Models\UserActivityLog;
use Illuminate\Auth\Events\Login;

class LogAuthLogin
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
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        UserActivityLog::write(
            'User logged in',
            "{$user->name} <{$user->email}>",
        );
    }
}
