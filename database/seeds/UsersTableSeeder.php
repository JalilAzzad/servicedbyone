<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'abdullahnaseer999@gmail.com')->first();
        if (is_null($user))
        {
            $user = \App\Models\User::create(
                [
                    'name' => 'Muhammad Abdullah',
                    'email' => 'abdullahnaseer999@gmail.com',
                    'password' => bcrypt('c5Q2aR{!\3nCz`z5')
                ]
            );

            $user->syncRoles(array(
                User::ADMIN,
                User::WORKER,
                User::USER
            ));
        }

        $user = User::where('email', 'tevarjohnson@gmail.com')->first();
        if (is_null($user))
        {
            $user = \App\Models\User::create(
                [
                    'name' => 'Tevar Johnson',
                    'email' => 'tevarjohnson@gmail.com',
                    'password' => bcrypt('^>7P:b]a-J+?-,Cu')
                ]
            );

            $user->syncRoles(array(
                User::ADMIN,
                User::WORKER,
                User::USER
            ));
        }

        if(app()->environment(['local', 'staging'])) {
            $users = factory(App\Models\User::class, 50)
                ->create()
                ->each(function ($u) {
                    $u->syncRoles(array(User::USER));
                });
            $users = factory(App\Models\User::class, 50)
                ->create()
                ->each(function ($u) {
                    $u->syncRoles(array(User::WORKER));
                });
            $users = factory(App\Models\User::class, 50)
                ->create()
                ->each(function ($u) {
                    $u->syncRoles(array(User::WORKER, User::USER));
                });
        }
    }
}
