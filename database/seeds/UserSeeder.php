<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => date('Y-m-d h:i:s'),
                'password' => Hash::make('password'),
                'user_type' => 'Admin',
                'remember_token' => '',
            ], [
                'id' => 2,
                'name' => 'user three',
                'email' => 'user3@user.com',
                'email_verified_at' => date('Y-m-d h:i:s'),
                'password' => Hash::make('password'),
                'user_type' => 'User',
                'remember_token' => '',
            ],
            [
                'id' => 3,
                'name' => 'user two',
                'email' => 'user2@user.com',
                'email_verified_at' => date('Y-m-d h:i:s'),
                'password' => Hash::make('password'),
                'user_type' => 'User',
                'remember_token' => '',
            ],
            [
                'id' => 4,
                'name' => 'user one',
                'email' => 'user1@user.com',
                'email_verified_at' => date('Y-m-d h:i:s'),
                'password' => Hash::make('password'),
                'user_type' => 'User',
                'remember_token' => '',
            ],
        ]);
    }

}
