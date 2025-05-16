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
        $number = fake()->numberBetween(3, 99);
        $profileUrl = "https://randomuser.me/api/portraits/{$gender}/{$number}.jpg";
        $isPremium = fake()->boolean(30); // 30% chance de ser premium

        return [
            'name' => fake()->firstName($gender),
            'surname' => fake()->lastName(),
            'username' => $this->faker->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Contraseña fija para pruebas
            'remember_token' => Str::random(10),
            'user_permission_level' => 'user',
            'profile_picture' => $profileUrl,
            'description' => fake()->sentence(10),
            'is_premium' => $isPremium,
            'background_image' => $isPremium ? 'fondos/fondo1.png' : null,
            'is_private' => fake()->boolean(20),  // 20% chance
        ];
    }

}

