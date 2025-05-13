<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Publication::with(['user' => function ($q) {
            $q->withCount(['followers', 'following']);
        }]);


        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $publications = $query->latest()->paginate(16)->withQueryString();

        return view('explore', compact('publications'));
    }

    public function show($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publications.show', compact('publication'));
    }

}

