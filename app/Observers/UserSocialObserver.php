<?php

namespace App\Observers;

use App\Models\UserSocial;

class UserSocialObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\UserSocial  $user
     * @return void
     */
    public function created(UserSocial $user)
    {
        $this->handleRegisteredEvent('created', $user);
    }

    protected function handleRegisteredEvent($event, UserSocial $user)
    {
        $class = config("social.events.{$user->service}.{$event}", null);

        if (!$class) {
            return;
        }

        event(new $class($user->user()->first()));
    }
}
