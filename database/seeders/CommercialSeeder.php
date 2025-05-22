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
            $src = database_path('seeders/commercials/' . $image);
            $dst = storage_path('app/public/commercials/' . $image);
            if (!file_exists(dirname($dst))) {
                mkdir(dirname($dst), 0775, true);
            }
            if (!file_exists($dst)) {
                copy($src, $dst);
                @chmod($dst, 0664);
            }

            Commercial::factory()->create([
                'image' => "commercials/{$image}",
            ]);
        }
    }

}


