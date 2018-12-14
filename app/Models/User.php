<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    const ADMIN = 'Admin';
    const WORKER = 'Worker';
    const USER = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password','user_name','slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the service requests for the user.
     */
    public function requests()
    {
        return $this->hasMany('App\Models\ServiceRequest', 'user_id', 'id');
    }

    public static function createBySocialProvider($providerUser)
    {
        $email = $providerUser->getEmail();

        if ($email) {
            return self::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName()
            ]);
        }

        return self::create([
            'name' => $providerUser->getName()
        ]);
    }
}
