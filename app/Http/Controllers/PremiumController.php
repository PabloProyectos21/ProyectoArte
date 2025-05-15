<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PremiumController extends Controller
{
    public function index()
    {
        return view('premium');

    }
    public function subscribe(Request $request)
    {
        $user = Auth::user();
        if($user->background_image ==null){
            $user->background_image='fondos/fondo1.png';
        }


        $user->is_premium = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'You are now a premium user!');
    }
    public function cancel()
    {
        $user = Auth::user();
        $user->is_premium = false;
        $user->save();

        return redirect()->route('premium')->with('message', 'Premium subscription cancelled.');
    }
}
