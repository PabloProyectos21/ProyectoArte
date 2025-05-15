<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publication;
use App\Models\User;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->count() === 0) {
            $users = User::factory(10)->create();
        }

        foreach ($users as $user) {
            Publication::factory(rand(1, 37))->create([
                'user_id' => $user->id,
            ]);
        }
    }

}

