<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Publication;

class PublicationRatingController extends Controller
{

    public function toggleLike(Request $request, Publication $publication): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $liked = $publication->ratings()->where('user_id', $user->id)->exists();

        if ($liked) {
            $publication->ratings()->where('user_id', $user->id)->delete();
        } else {
            // 👇 Aquí es donde hacemos el cambio
            $publication->ratings()->firstOrCreate([
                'user_id' => $user->id,
                'publication_id' => $publication->id,
            ]);

        }

        $count = $publication->ratings()->count();

        return response()->json(['count' => $count]);
    }

}

