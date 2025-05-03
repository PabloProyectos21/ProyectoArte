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
        ]);

        User::factory(9)->create();
    }
}


