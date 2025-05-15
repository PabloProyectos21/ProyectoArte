<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pablo',
            'surname' => 'Ruiz',
            'email' => 'pabloruce@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'user_permission_level' => 'admin',
            'profile_picture' => 'https://randomuser.me/api/portraits/men/1.jpg',
            'description' => 'Usuario admin pruebas.',
            'username' => 'pabloruiz',
            'is_premium' => true,
            'is_private' => false,
        ]);

        User::create([
            'name' => 'Maria',
            'surname' => 'Ruiz',
            'email' => 'mae@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'user_permission_level' => 'user',
            'profile_picture' => 'https://randomuser.me/api/portraits/women/2.jpg',
            'description' => 'Usuario basic pruebas.',
            'username' => 'mariaruiz',
            'is_premium' => false,
            'is_private' => false,
        ]);

        User::factory(37)->create();
    }
}
