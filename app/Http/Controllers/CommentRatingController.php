<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentRating;
use Illuminate\Http\Request;

class CommentRatingController extends Controller
{
    public function toggle(Request $request, Comment $comment)
    {
        $user = $request->user();

        $existing = CommentRating::where('user_id', $user->id)
            ->where('comment_id', $comment->id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            CommentRating::create([
                'user_id' => $user->id,
                'comment_id' => $comment->id,
                'like' => true
            ]);
        }

        $count = $comment->ratings()->count();

        return response()->json(['count' => $count]);
    }
}
