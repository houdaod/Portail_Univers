<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureAdminIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié et un admin non approuvé
        if (Auth::check() && Auth::user()->role === 'admin' && !Auth::user()->approved) { 
            // Redirige l'utilisateur vers une page différente s'il n'est pas approuvé
            return redirect()->route('admin.noapprovedashboard')
                            ->with('error', 'Vous devez être approuvé par un administrateur.');
        }

        return $next($request);
    }

}
