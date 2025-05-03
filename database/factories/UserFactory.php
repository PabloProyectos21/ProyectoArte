<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserFactory extends Factory
{
    public function definition(): array
    {
        $gender = fake()->randomElement(['men', 'women']);
        $number = fake()->numberBetween(1, 99);
        $profileUrl = "https://randomuser.me/api/portraits/{$gender}/{$number}.jpg";

        return [
            'name' => fake()->firstName($gender),
            'surname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Contraseña fija para pruebas
            'remember_token' => Str::random(10),
            'user_permission_level' => 'user',
            'profile_picture' => $profileUrl,
            'description' => fake()->sentence(10),
        ];
    }
}

