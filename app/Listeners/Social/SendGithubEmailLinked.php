<?php

namespace App\Listeners\Social;

use App\Events\Social\GithubAccountWasLinked;
use App\Mail\Social\GithubAccountLinked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendGithubEmailLinked
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
     * @param  \App\Events\GithubAccountWasLinked  $event
     * @return void
     */
    public function handle(GithubAccountWasLinked $event)
    {
        Mail::to($event->user)->send(new GithubAccountLinked($event->user));
    }
}
