<?php

namespace App\Listeners\Social;

use App\Events\Social\FacebookAccountWasLinked;
use App\Mail\Social\FacebookAccountLinked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendFacebookEmailLinked
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
     * @param  \App\Events\FacebookAccountWasLinked  $event
     * @return void
     */
    public function handle(FacebookAccountWasLinked $event)
    {
        Mail::to($event->user)->send(new FacebookAccountLinked($event->user));
    }
}
