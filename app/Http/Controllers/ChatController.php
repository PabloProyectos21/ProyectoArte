<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Muestra todos los chats del usuario autenticado
    public function index()
    {
        $chats = Auth::user()->chats()->with('users')->get();
        return view('chats.index', compact('chats'));
    }
    // app/Http/Controllers/ChatController.php



    // Muestra los mensajes de un chat
    public function show($chatId)
    {
        $chat = Chat::with(['users', 'messages.sender'])->findOrFail($chatId);

        // Verifica que el usuario es miembro del chat
        if (!$chat->users->contains(Auth::id())) {
            abort(403);
        }

        return view('chats.show', compact('chat'));
    }

    // Envía un nuevo mensaje
    public function sendMessage(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);

        // Verifica que el usuario es miembro del chat
        if (!$chat->users->contains(Auth::id())) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = new Message([
            'sender_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);
        $chat->messages()->save($message);

        return redirect()->route('chats.show', $chatId);
    }

    // (Opcional) Crea un nuevo chat entre dos usuarios
    public function store(Request $request)
    {
        // Validar username destinatario (¡esto previene errores!)
        $request->validate([
            'username' => ['required', 'exists:users,username', 'not_in:' . auth()->user()->username],
        ]);

        $user1 = auth()->user();
        $user2 = \App\Models\User::where('username', $request->username)->firstOrFail();

        // Buscar si ya existe un chat entre ambos
        $chat = \App\Models\Chat::whereHas('participants', function ($q) use ($user1) {
            $q->where('user_id', $user1->id);
        })
            ->whereHas('participants', function ($q) use ($user2) {
                $q->where('user_id', $user2->id);
            })
            ->withCount('participants')
            ->having('participants_count', 2)
            ->first();

        if (!$chat) {
            // Nombre de chat: los usernames, ordenados
            $names = [$user1->username, $user2->username];
            sort($names); // ordena alfabéticamente
            $chatName = implode(', ', $names);

            $chat = \App\Models\Chat::create([
                'name' => $chatName
            ]);
            $chat->participants()->attach([$user1->id, $user2->id]);
        }

        return redirect()->route('chats.show', $chat->id);
    }

}

