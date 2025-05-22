<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Imagen de perfil
        if ($request->hasFile('profile_picture')) {
            // Eliminar imagen anterior si existe en storage
            if ($user->profile_picture && \Storage::disk('public')->exists($user->profile_picture)) {
                \Storage::disk('public')->delete($user->profile_picture);
            }
            // Subir nueva imagen a storage/app/public/profile_pictures
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Imagen de fondo
        if ($request->hasFile('background_image')) {
            if ($user->background_image && \Storage::disk('public')->exists($user->background_image)) {
                \Storage::disk('public')->delete($user->background_image);
            }
            $user->background_image = $request->file('background_image')->store('backgrounds', 'public');
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        return Redirect::route('profile.edit')->with('status', 'background-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
