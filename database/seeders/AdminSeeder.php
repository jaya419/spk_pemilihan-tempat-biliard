<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('users')->where('email', 'acha@gmail.com')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'Siti Nurhaliza',
                'email' => 'acha@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profile_picture' => 'acha.jpg',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}