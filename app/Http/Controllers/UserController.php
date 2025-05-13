<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function explore(Request $request)
    {
        $query = User::query()->withCount(['followers', 'following']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('publications', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        $users = $query->inRandomOrder()->paginate(12);

        return view('users.users-explore', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('publications')
            ->withCount(['followers', 'following'])
            ->findOrFail($id);

        return view('users.show', compact('user'));
    }




}
