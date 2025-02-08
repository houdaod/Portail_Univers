<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifie l'utilisateur
        $request->authenticate();

        // Regénère la session pour éviter le vol de session
        $request->session()->regenerate();

        // Vérifie si l'utilisateur est un admin
        if (Auth::user()->role === 'admin') {
            if (Auth::user()->approved) {
                // Si l'admin est approuvé, redirige vers le tableau de bord de l'admin
                return redirect()->route('admin.dashboard');
            } else {
                // Si l'admin n'est pas approuvé, redirige vers une autre page
                return redirect()->route('admin.noapprovedashboard');
            }
        }

        // Si l'utilisateur est un étudiant, redirige vers son tableau de bord
        return redirect()->route('student.dashboard');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
