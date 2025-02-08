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
    public function store(Request $request): RedirectResponse
    {
        // Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,admin'], // Rôle obligatoire
            'approved' => ['nullable', 'boolean'], // Approuvé (par défaut, false)
        ]);

        // Si le rôle est "admin", ne pas l'approuver immédiatement
        $approved = $request->role == 'admin' ? false : true;

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Récupère le rôle
            'approved' => $approved, // Si le rôle est "admin", approuvé = false
        ]);

        // Envoi de l'événement de l'utilisateur enregistré
        event(new Registered($user));

        // Connexion de l'utilisateur
        Auth::login($user);

        // Redirection selon le rôle et statut d'approbation
        if ($user->role === 'admin') {
            if ($user->approved) {
                return redirect()->route('admin.dashboard'); // Admin approuvé
            } else {
                return redirect()->route('admin.noapprovedashboard'); // Admin non approuvé
            }
        }

        return redirect()->route('dashboard'); // Étudiant redirigé vers son tableau de bord
    }


}
