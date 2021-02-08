<?php

use Illuminate\Database\Seeder;
use Brainr\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * @throws \Throwable
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@brainr.com';
        $admin->password = Hash::make('pass');

        $admin->saveOrFail();
    }
}
