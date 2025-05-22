<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    public function run(): void
    {
        $images = ['ad2.png', 'ad3.png', 'ad4.png', 'ad5.png'];

        // Asegúrate de que los archivos están en el storage correcto
        foreach ($images as $image) {
            $src = database_path("seeders/commercials/$image");
            $dst = storage_path("app/public/commercials/$image");
            if (!file_exists(dirname($dst))) {
                mkdir(dirname($dst), 0775, true);
            }
            copy($src, $dst);
            @chmod($dst, 0664); // Opcional pero recomendado
        }

        // Ahora crea los commercials como ya haces
        foreach ($images as $image) {
            Commercial::factory()->create([
                'image' => "commercials/{$image}",
            ]);
        }
    }
}


