<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Universite;
use App\Models\Filiere;
use App\Models\Document;
use App\Models\Program;
use App\Models\University;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord des administrateurs.
     */
    public function index()
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur est bien connecté, admin, et approuvé
        if (!$user || $user->role != 'admin' || !$user->approved) {
            return redirect()->route('admin.noapprovedashboard');
        }

        // Récupère les totaux nécessaires
        $total_users = User::count();
        $total_universites = University::count();
        $total_filieres = Program::count();
        $total_documents = Document::count();

        // Retourne la vue du tableau de bord avec les données nécessaires
        return view('admin.dashboard', compact('total_users', 'total_universites', 'total_filieres', 'total_documents'));
    }

    /**
     * Affiche une page d'attente pour les administrateurs non approuvés.
     */
    public function noApprovedDashboard()
    {
        return view('admin.noapprovedashboard');
    }

    /**
     * Approuve un utilisateur admin.
     */
    public function approve(User $user)
    {
        // Vérifie si l'utilisateur est un admin non approuvé
        if ($user->role === 'admin' && !$user->approved) {
            $user->approved = true;
            $user->save();

            return redirect()->route('admin.users')->with('success', 'L\'utilisateur a été approuvé avec succès.');
        }

        // Si l'utilisateur n'est pas un admin ou déjà approuvé
        return redirect()->route('admin.users')->with('error', 'Cet utilisateur n\'est pas un administrateur non approuvé.');
    }
}
