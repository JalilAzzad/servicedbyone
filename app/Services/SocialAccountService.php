<?php
namespace App\Services;

use App\Models\UserSocialAccount;
use App\Models\User;

class SocialAccountService
{
    public function createOrGetUser($providerObj, $providerName)
    {
        $providerUser = $providerObj->user();

        $account = UserSocialAccount::where('provider', $providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new UserSocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName]);

            $email = $providerUser->getEmail();

            $user = $email ? User::where('email', $email)->first() : null;

            if (!$user) {
                $user = User::createBySocialProvider($providerUser);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}