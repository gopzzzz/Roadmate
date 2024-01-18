<?php

namespace App\Listeners;
use App\Events\UserLoggedIn;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;



class CheckUserLogin implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        if (auth()->check() && auth()->user()->id !== $event->userId) {
            auth()->logout();
        }
    }
}
