<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !User::user()->hasSubscription()) {
            return redirect()->route('home')->with('error', 'Accès réservé aux abonnés.');
        }        

        return $next($request);
    }
}

