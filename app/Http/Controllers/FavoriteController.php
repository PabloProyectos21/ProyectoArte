<?php
namespace App\Http\Controllers;

use App\Models\Commercial;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favoritePublications()->latest()->paginate(16);
        $commercial = Commercial::inRandomOrder()
            ->with('company')
            ->first();
        return view('publications.favorites', compact('favorites','commercial'));

    }
}

