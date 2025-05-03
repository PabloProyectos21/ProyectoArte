<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'image_route' => fake()->randomElement([
                'https://picsum.photos/400/480.jpg',
                'https://picsum.photos/200/200.jpg'
            ]),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'clicks' => 0,
            'number_of_ratings' => 0,
            'publication_date' => now(),
            'category' => fake()->randomElement(['photography', 'tattoos', 'painting', 'draws', 'fashion', 'other']),
        ];
    }
}


