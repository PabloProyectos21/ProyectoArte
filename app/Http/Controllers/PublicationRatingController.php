<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Publication;

class PublicationRatingController extends Controller
{
    public function toggleLike(Request $request, $publicationId)
    {
        $user = auth()->user();

        // Verifica si ya ha dado like
        $alreadyLiked = $user->likedPublications()->where('publication_id', $publicationId)->exists();

        if ($alreadyLiked) {
            $user->likedPublications()->detach($publicationId);
        } else {
            $user->likedPublications()->attach($publicationId);
        }

        return redirect()->back(); // o response()->json([...]) si usas AJAX
    }
}

