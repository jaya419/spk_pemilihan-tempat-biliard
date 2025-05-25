<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'sitinurhaliza@gmail.com',
            'password' => Hash::make('password'),
            'profile_picture' => 'acha.jpg', 
        ]);
    }
}
