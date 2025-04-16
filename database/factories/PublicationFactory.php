<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'image_route' => 'uploads/' . $this->faker->image('public/storage/uploads', 640, 480, null, false),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'rating_avg' => 0,
            'number_of_ratings' => 0,
            'publication_date' => now(),
        ];
    }
}
