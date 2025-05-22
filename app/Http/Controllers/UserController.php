<?php
namespace App\Http\Controllers;
use App\Models\Commercial;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function explore(Request $request)
    {
        $query = User::query()->withCount(['followers', 'following']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('category')) {
            $query->whereHas('publications', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        $users = $query->inRandomOrder()->paginate(12);
        $commercial = Commercial::inRandomOrder()
            ->with('company')
            ->first();
        return view('users.users-explore', compact('users','commercial'));
    }

    public function show($id)
    {
        $user = User::with('publications')
            ->withCount(['followers', 'following'])
            ->findOrFail($id);
        return view('users.show', compact('user'));
    }


    public function searchByUsername(Request $request)
    {
        $query = $request->input('q', '');
        $users = \App\Models\User::where('username', 'like', $query . '%')
            ->where('id', '!=', auth()->id()) // No mostrarte a ti mismo
            ->limit(10)
            ->get(['id', 'username', 'name', 'profile_picture']);

        return response()->json($users);
    }

}
