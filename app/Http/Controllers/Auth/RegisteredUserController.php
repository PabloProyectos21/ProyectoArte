<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:50',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_private' => ['required', 'boolean'],
        ]);

        // Guardar imagen de perfil si hay
        if ($request->hasFile('profile_picture')) {
            // Crear carpeta si no existe
            $destination = public_path('profile_pictures');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            // Nombre aleatorio único
            $filename = uniqid() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            // Mover archivo a /public/profile_pictures
            $request->file('profile_picture')->move($destination, $filename);
            // Guardar la ruta relativa en la BD
            $profilePicturePath = 'profile_pictures/' . $filename;
        } else {
            $profilePicturePath = null;
        }


        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath, // Guardamos solo la ruta relativa en storage
            'description' => $request->description,
            'is_private' => $request->is_private,
            'user_permission_level' => 'user',
            'is_premium' => 0,
            'background_image' => null,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }


}
