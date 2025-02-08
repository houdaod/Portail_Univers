<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Créer un admin manuellement
        User::create([
            'name' => 'Admin0',
            'email' => 'ho4oued@gmail.com',
            'password' => Hash::make('houda4444&'), // Mot de passe sécurisé
            'role' => 'admin', // Assurez-vous que votre modèle User a un champ 'role'
            'approved' => true, // Marquer cet admin comme approuvé
        ]);
    }
}

