<?php
namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Notification;
use App\Models\Program;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord des administrateurs.
     */
    public function index(Request $request)
{
    // Vérifie si l'utilisateur est authentifié et a un rôle d'admin
    $user = Auth::user();
    if (!$user || $user->role != 'admin' || !$user->approved) {
        return redirect()->route('admin.noapprovedashboard');
    }

     // Récupérer les universités depuis la base de données
     $universites = University::all();

    // Récupère les programmes
    $programs = Program::all();  // Récupère tous les programmes

    // Récupère les utilisateurs avec pagination et filtrage
    $users = User::when($request->search, function ($query, $search) {
        return $query->where('name', 'like', "%$search%");
    })->when($request->role, function ($query, $role) {
        return $query->where('role', $role);
    })->paginate(10);

    // Récupère les notifications
    $notifications = Notification::all();

    // Récupère les totaux nécessaires pour le tableau de bord
    $total_users = User::count();
    $total_universites = University::count();
    $total_filieres = Program::count();
    $total_documents = Document::count();

    // Retourne la vue avec les données nécessaires
    return view('admin.dashboard', compact(
        'total_users', 
        'total_universites', 
        'total_filieres', 
        'total_documents', 
        'users', 
        'notifications', 
        'universites',
        'programs'  // Ajoute la variable programs ici
    ));
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

    /**
     * Exporte les utilisateurs au format CSV.
     */
    public function exportUsers()
    {
        // Get all users from the database
        $users = User::all();

        // Open a file in memory
        $csvFile = fopen('php://output', 'w');

        // Set headers for the CSV file
        fputcsv($csvFile, ['ID', 'Name', 'Email', 'Created At']);

        // Loop through each user and write to the CSV file
        foreach ($users as $user) {
            fputcsv($csvFile, [
                $user->id,
                $user->name,
                $user->email,
                $user->created_at,
            ]);
        }

        // Set headers to prompt for a file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Close the file after writing
        fclose($csvFile);

        // Return the response to download the CSV
        return response()->stream(
            function () use ($csvFile) {
                fclose($csvFile);
            },
            200,
            ['Content-Type' => 'text/csv']
        );
    }
}
