<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemoImageSeeder extends Seeder
{
    public function run(): void
    {
        $demoImages = glob(public_path('demo-images/*.{jpg,png,jpeg,gif}'), GLOB_BRACE);

        foreach ($demoImages as $imagePath) {
            $fileName = Str::random(10) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
            $destinationPath = 'uploads/' . $fileName;

            Storage::disk('public')->put(
                $destinationPath,
                file_get_contents($imagePath)
            );

            \App\Models\Publication::create([
                'user_id' => \App\Models\User::inRandomOrder()->first()->id,
                'image_route' => $destinationPath,
                'title' => 'Demo: ' . pathinfo($imagePath, PATHINFO_FILENAME),
                'description' => 'Obra de prueba generada automáticamente.',
                'rating_avg' => 0,
                'number_of_ratings' => 0,
                'publication_date' => now(),
            ]);
        }
    }
}
