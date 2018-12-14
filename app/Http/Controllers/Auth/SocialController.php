<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function login($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {
        $driver = Socialite::driver($provider);

        try {
            $user = $service->createOrGetUser($driver, $provider);
            auth()->login($user, true);
        } catch (InvalidStateException $e) {
            return redirect()->intended('/');
        } catch (ClientException $e) {
            return redirect()->intended('/');
        }

        return redirect()->intended('/');
    }
}
