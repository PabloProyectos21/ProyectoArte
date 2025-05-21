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
    public function create()
    {
        return view('publications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:photography,tattoos,painting,draws,fashion,other',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Crear carpeta si no existe
            $destination = public_path('publications');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destination, $filename);
            $imagePath = 'publications/' . $filename;
        } else {
            $imagePath = null;
        }

        Publication::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image_route' => $imagePath,
            'number_of_ratings' => 0,
            'clicks' => 0,
            'publication_date' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Publication created successfully.');

    }

    public function edit(Publication $publication)
    {
        // Solo el dueño o un administrador puede editar
        if (auth()->id() !== $publication->user_id && auth()->user()->user_permission_level !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('publications.edit', compact('publication'));
    }


    public function update(Request $request, Publication $publication)
    {
        // Permitir solo al autor o a un administrador
        if (auth()->id() !== $publication->user_id && auth()->user()->user_permission_level !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:photography,tattoos,painting,draws,fashion,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($publication->image_route && file_exists(public_path($publication->image_route))) {
                unlink(public_path($publication->image_route));
            }
            $destination = public_path('publications');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destination, $filename);
            $publication->image_route = 'publications/' . $filename;
        }

        $publication->title = $request->title;
        $publication->description = $request->description;
        $publication->category = $request->category;
        $publication->save();

        return redirect()->route('publications.show', $publication->id)
            ->with('success', 'Publication updated successfully.');
    }


    public function destroy(Publication $publication)
    {
        // Solo el dueño o un admin puede eliminar
        if (auth()->id() !== $publication->user_id && auth()->user()->user_permission_level !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Eliminar la imagen física
        if ($publication->image_route && file_exists(public_path($publication->image_route))) {
            unlink(public_path($publication->image_route));
        }

        $userId = $publication->user_id;
        $publication->delete();

        return redirect()->route('profile.view', $userId)
            ->with('success', 'Publication deleted successfully.');
    }


}
