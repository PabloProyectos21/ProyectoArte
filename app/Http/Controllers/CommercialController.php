<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use App\Models\Company;
use Illuminate\Http\Request;

class CommercialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $commercials = Commercial::with('company')
            ->when($search, function ($query, $search) {
                $query->whereHas('company', function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.commercials.commercials', compact('commercials'));

    }

    public function edit(Commercial $commercial)
    {
        $companies = Company::all();
        return view('admin.commercials.edit', compact('commercial', 'companies'));
    }

    public function update(Request $request, Commercial $commercial)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'media_url' => 'required|url',
            'publication_date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:publication_date',
            'image' => 'nullable|image|max:2048',
        ]);

        $commercial->update($request->only(['company_id', 'media_url', 'publication_date', 'expiration_date']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('commercials', 'public');
            $commercial->image = $path;
            $commercial->save();
        }

        return redirect()->route('admin.commercials')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Commercial $commercial)
    {
        $commercial->delete();
        return back()->with('success', 'Ad deleted successfully.');
    }

}
