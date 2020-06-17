<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        //$userRole = Role::where('name','user')->first();

        $admin = User::create(['username'=>'admin', 'email'=>'admin@songspace.test','password'=>Hash::make('password')]);
        $user = User::create(['username'=>'johnmayer','email'=>'jcmayer@newlight.com','password'=>Hash::make('password')]);
        $admin->roles()->attach($adminRole);
        //$user->roles()->attach($userRole);
    }
}
