<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Aquí podrías definir rutas API en el futuro
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
