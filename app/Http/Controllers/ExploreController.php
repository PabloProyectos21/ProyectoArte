<?php

namespace App\Http\Controllers;


use App\Models\Publication;

class ExploreController extends Controller
{
    public function index()
    {
        $publications = Publication::inRandomOrder()->get(); // Shuffle
        return view('explore', compact('publications'));
    }
    public function show($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publications.show', compact('publication'));
    }

}

