<?php

namespace App\Providers;

use App\Events\Social\FacebookAccountWasLinked;
use App\Events\Social\GithubAccountWasLinked;
use App\Listeners\Social\SendFacebookEmailLinked;
use App\Listeners\Social\SendGithubEmailLinked;
use App\Models\UserSocial;
use App\Observers\UserSocialObserver;
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
            SendEmailVerificationNotification::class,
        ],
        GithubAccountWasLinked::class => [
            SendGithubEmailLinked::class,
        ],
        FacebookAccountWasLinked::class => [
            SendFacebookEmailLinked::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        UserSocial::observe(UserSocialObserver::class);
    }
}
