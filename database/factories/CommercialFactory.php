<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommercialFactory extends Factory
{
    public function definition(): array
    {
        static $imageCounter = 2;

        return [
            'user_id' => 1,
            'company_id' => $this->faker->numberBetween(1, 8),
            'media_url' => 'https://www.google.com/?hl=es',
            'image' => "commercials/ad{$imageCounter}.png",
            'ad_text' => $this->faker->randomElement([
                "¡Descubre lo que todos están hablando!",
                "Oferta por tiempo limitado. ¡Haz clic ahora!",
                "Eleva tu estilo con nuestra nueva colección.",
                "Innovación y confianza en cada paso.",
                "Tu futuro empieza aquí. Conócenos.",
                "El mejor precio garantizado. Solo por hoy.",
                "¿Buscas calidad? Estás en el lugar correcto.",
                "Haz tu vida más fácil con nuestra solución."
            ]),
            'publication_date' => now(),
            'expiration_date' => now()->addDays(30),
            'clicks' => 0,
        ];
    }
}

