<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'publication_id' => \App\Models\Publication::factory(),
            'user_response_id' => null,
            'content' => $this->faker->sentence(8),
            'number_of_likes' => $this->faker->numberBetween(0, 30),
        ];
    }
}
