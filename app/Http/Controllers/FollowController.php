<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;



class FollowController extends Controller
{



    public function toggle(Request $request, User $user)
    {
        $follower = auth()->user();

        if ($follower->isFollowing($user)) {
            $follower->following()->detach($user->id);
        } else {
            $follower->following()->attach($user->id);
        }

        $followersCount = $user->followers()->count();


        if ($request->expectsJson()) {
            return response()->json([
                'followersCount' => $followersCount,
                'isFollowing' => $follower->isFollowing($user),
            ]);
        }


        return back();
    }

}
