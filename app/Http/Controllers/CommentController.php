<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Publication $publication)
    {
        $comment = new Comment();
        $comment->publication_id = $publication->id;
        $comment->user_id = auth()->id();
        $comment->content = $request->input('comment');
        $comment->user_response_id = $request->input('user_response_id');
        $comment->parent_comment_id = $request->input('parent_comment_id'); // 🔥 esta línea es clave
        $comment->save();

        return redirect()->back();
    }



    public function destroy(Comment $comment)
    {
        $user = auth()->user();

        if ($user->id === $comment->user_id || $user->id === $comment->publication->user_id) {

            // Borrar respuestas asociadas
            Comment::where('parent_comment_id', $comment->id)
                ->where('publication_id', $comment->publication_id)
                ->delete();


            // Luego borra el comentario original
            $comment->delete();

            return back()->with('success', 'Comment and its replies deleted.');
        }

        abort(403);
    }

    public function toggleLike(Comment $comment)
    {
        $user = auth()->user();
        $existing = $comment->ratings()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
        } else {
            $comment->ratings()->create(['user_id' => $user->id]);
        }

        return response()->json(['count' => $comment->ratings()->count()]);
    }

}

