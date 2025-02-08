<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function dashboard()
    {
        //Récupération des données de l'utilisateur
        $user = Auth::user(); // Utilise directement la façade Auth


        // Retourner une vue avec ces données
        return view('user.dashboard', compact('user'));
    }

}
