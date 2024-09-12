<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\authenticate_infoMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'type_compte' => 'required|string|max:255',
            'departement' => 'nullable|string|max:255',
        ]);

        $password = str::random(8); // Générer un mot de passe aléatoire

        $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->type_compte = $request->type_compte;
            $user->departement = $request->departement;

            event(new Registered($user));
        // Envoyer l'email de bienvenue
        Mail::to($user->email)->send(new authenticate_infoMail($user, $password));

        $user->save();

        

        
        
        return redirect()->route('Service_Infantile.list_child');

    }    
}
