<?php
namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function show($id)
    {

        $publication = Publication::with(['comments.user'])->findOrFail($id);

        $comments = $publication->comments;
        $numberOfComments = $comments->count();
        $mainComments = $comments->whereNull('parent_comment_id');
        $repliesGrouped = $comments->whereNotNull('parent_comment_id')
            ->groupBy(function ($comment) {
                // Recorremos hacia arriba hasta encontrar el comentario raíz
                $parent = $comment;
                while ($parent->parent_comment_id && $parent->parent_comment_id != $parent->id) {
                    $parent = $parent->parent;
                }
                return $parent->id;
            });





        $recommended = Publication::where('category', $publication->category)
            ->where('id', '!=', $publication->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('publications.show', compact('publication', 'mainComments', 'repliesGrouped', 'recommended','numberOfComments'));

    }
    public function toggleFavorite(Publication $publication)
    {
        $user = auth()->user();

        if ($user->favoritePublications()->where('publication_id', $publication->id)->exists()) {
            $user->favoritePublications()->detach($publication);
        } else {
            $user->favoritePublications()->attach($publication);
        }

        return response()->json(['favorited' => $user->favoritePublications->contains($publication->id)]);
    }

}
