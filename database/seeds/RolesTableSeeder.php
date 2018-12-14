<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => User::ADMIN]);
        Role::firstOrCreate(['name' => User::WORKER]);
        Role::firstOrCreate(['name' => User::USER]);
    }
}
