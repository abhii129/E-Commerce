<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate([
            'email' => 'abhinav107singh@gmail.com',
        ], [
            'name' => 'Abhinav Singh',
            'password' => Hash::make('abhinav129'),
            'role' => 'admin',
            'number' => '9560711201',
            'age' => 23,
            'address' => 'Admin Address',
            'gender' => 'male',
        ]);
    }
}


