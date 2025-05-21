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
            // Eliminar imagen anterior si existe
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }
            // Crear carpeta si no existe
            $destination = public_path('profile_pictures');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $filename = uniqid() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move($destination, $filename);
            $user->profile_picture = 'profile_pictures/' . $filename;
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
        return Redirect::route('profile.edit')->with('status','background-updated');
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
