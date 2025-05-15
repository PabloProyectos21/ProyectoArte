<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    public function run(): void
    {
        $images = ['ad2.png', 'ad3.png', 'ad4.png', 'ad5.png'];

        foreach ($images as $image) {
            Commercial::factory()->create([
                'image' => "commercials/{$image}",
            ]);
        }
    }
}


