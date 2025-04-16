<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 10 usuarios cada uno con 3 publicaciones y 5 comentarios
        \App\Models\User::factory(10)
            ->has(\App\Models\Publication::factory()->count(3))
            ->has(\App\Models\Comment::factory()->count(5))
            ->create();

        // Crear valoraciones aleatorias entre usuarios y publicaciones existentes
        $users = \App\Models\User::all();
        $publications = \App\Models\Publication::all();

        foreach ($users as $user) {
            $publications->random(3)->each(function ($pub) use ($user) {
                \App\Models\PublicationRating::create([
                    'user_id' => $user->id,
                    'publication_id' => $pub->id,
                    'rating' => rand(1, 5),
                ]);

                // actualizar media y recuento en la publicación
                $pub->rating_avg = \App\Models\PublicationRating::where('publication_id', $pub->id)->avg('rating');
                $pub->number_of_ratings = \App\Models\PublicationRating::where('publication_id', $pub->id)->count();
                $pub->save();
            });
        }
        $this->call(DemoImageSeeder::class);

    }
}
