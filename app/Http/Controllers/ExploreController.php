<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Publication::with(['user' => function ($q) {
            $q->withCount(['followers', 'following']);
        }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQ) use ($search) {
                        $userQ->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $publications = $query->inRandomOrder()->paginate(16)->withQueryString();
        $commercial = Commercial::inRandomOrder()
            ->with('company')
            ->first();

        return view('explore', compact('publications', 'commercial'));
    }

    public function show($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publications.show', compact('publication'));
    }

}

