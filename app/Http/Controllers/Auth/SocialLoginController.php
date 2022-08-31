<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect(Request $request, $service)
    {
        return Socialite::driver($service)->redirect();
    }
    public function callback(Request $request, $service)
    {
        $user = Socialite::driver($service)->user();

        dd($user);
    }
}
