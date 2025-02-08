<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur a le rôle demandé
        if ($request->user() && $request->user()->role !== $role) { 
            return redirect()->route('dashboard')->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder à cette page.');
        }

        return $next($request);
    }

}
