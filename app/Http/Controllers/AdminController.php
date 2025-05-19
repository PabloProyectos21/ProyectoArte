<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use App\Models\Company;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // ✅ BIEN


class AdminController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user(); // 👈
        $userCount = User::where('user_permission_level', 'user')->count();
        $publicationCount = Publication::count();

        return view('admin.dashboard', compact('user', 'userCount', 'publicationCount'));
    }




    public function listUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('user_permission_level', 'user')
            ->when($search, function ($query, $search) {
                $query->where('surname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users', compact('users', 'search'));
    }

    public function deleteUser($id)
    {
        User::where('user_permission_level', 'user')->findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }



    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'nullable|string|max:255',
        'username' => 'nullable|string|max:255|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'is_premium' => 'required|boolean',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

        $user = User::findOrFail($id);

        $data = $request->only(['name', 'surname', 'username', 'email', 'is_premium']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function listPublications(Request $request)
    {
        $search = $request->input('search');

        $publications = Publication::with('user')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.publications', compact('publications', 'search'));
    }

    public function deletePublication($id)
    {
        Publication::findOrFail($id)->delete();
        return back()->with('success', 'Publication deleted successfully.');
    }
    public function createCommercial()
    {
        $companies = Company::all();
        return view('admin.commercials.create', compact('companies'));
    }

    public function storeCommercial(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'media_url' => 'required|url',
            'publication_date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:publication_date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('commercials', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['clicks'] = 0;

        Commercial::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Commercial created successfully.');
    }
    public function createCompany()
    {
        return view('admin.companies.create');
    }

    public function storeCompany(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'nif' => 'required|string|max:20|unique:companies',
            'contact_email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        Company::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Company created successfully.');
    }
    public function listCompanies(Request $request)
    {
        $companies = Company::query()
            ->when($request->search, fn($q) =>
            $q->where('company_name', 'like', '%' . $request->search . '%')
                ->orWhere('nif', 'like', '%' . $request->search . '%'))
            ->paginate(10);

        return view('admin.companies.companies', compact('companies'));
    }

    public function deleteCompany($id)
    {
        Company::findOrFail($id)->delete();
        return back()->with('success', 'Company deleted successfully.');
    }
    public function editCompany($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'nif' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $company->update([
            'company_name' => $request->company_name,
            'nif' => $request->nif,
            'contact_email' => $request->contact_email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully.');
    }

    public function listCommercials(Request $request)
    {
        $commercials = Commercial::with('company')
            ->whereHas('company', function ($query) use ($request) {
                $query->where('company_name', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);

        return view('admin.commercials.commercials', compact('commercials'));

    }


}
