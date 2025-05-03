<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        $current = Auth::user();

        if ($current->id === $user->id) {
            return back()->with('error', 'No puedes seguirte a ti mismo.');
        }

        $isFollowing = $current->following()->where('followed_id', $user->id)->exists();

        if ($isFollowing) {
            $current->following()->detach($user->id);
        } else {
            $current->following()->attach($user->id);
        }

        return back();
    }
}
