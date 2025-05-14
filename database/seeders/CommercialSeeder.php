<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    public function run(): void
    {
        $images = ['ad2.jpg', 'ad3.jpg', 'ad4.jpg', 'ad5.jpg'];

        foreach ($images as $image) {
            Commercial::factory()->create([
                'image' => "commercials/{$image}",
            ]);
        }
    }
}


