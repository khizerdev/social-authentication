<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class SocialLoginController extends Controller
{
    public function redirect(Request $request, $service)
    {
        return Socialite::driver($service)->redirect();
    }
    public function callback(Request $request, $service)
    {
        $serviceUser = Socialite::driver($service)->user();

        $user = $this->getExistingUser($serviceUser, $service);

        if (!$user) {

            $user = User::create([
                'name' => $serviceUser->getName(),
                'email' => $serviceUser->getEmail(),
            ]);
        }

        if ($this->needsToCreateSocial($user, $service)) {

            $user->social()->create([
                'social_id' =>  $serviceUser->getId(),
                'service' =>  $service,
            ]);
        }

        Auth::login($user, false);

        return redirect()->intended();
    }

    protected function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    protected function getExistingUser($serviceUser, $service)
    {
        return User::where('email', $serviceUser->getEmail())->orWhereHas('social', function ($q) use ($serviceUser, $service) {
            $q->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
}
