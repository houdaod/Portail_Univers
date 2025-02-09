<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\University;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Optimisation en récupérant les programmes avec leurs universités associées.
        $programs = Program::with('universities')->get();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupère toutes les universités pour l'assignation des programmes.
        $universities = University::all();
        return view('programs.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées
        $this->validateProgram($request);

        // Créer le programme
        $program = Program::create($request->only([
            'name', 'description', 'entrants_profile', 'pathways', 'outcomes'
        ]));

        // Attacher les universités sélectionnées au programme
        $program->universities()->attach($request->universities);

        return redirect()->route('programs.index')
                         ->with('success', 'Filière créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        // Récupère les universités existantes et le programme spécifique à modifier.
        $universities = University::all();
        return view('programs.edit', compact('program', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        // Validation des données envoyées
        $this->validateProgram($request);

        // Mettre à jour les informations du programme
        $program->update($request->only([
            'name', 'description', 'entrants_profile', 'pathways', 'outcomes'
        ]));

        // Synchroniser les universités sélectionnées avec le programme
        $program->universities()->sync($request->universities);

        return redirect()->route('programs.index')
                         ->with('success', 'Filière mise à jour avec succès.');
    }

    //lister
    public function list()
    {
        // Retrieve all programs from the database (adjust to your model)
        $programs = Program::all();  // Replace 'Program' with your model

        // Pass the programs to the view
        return view('programs.list', compact('programs'));
    }

    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouver le programme à supprimer
        $program = Program::findOrFail($id);
        
        // Supprimer le programme
        $program->delete();
        
        // Rediriger vers la liste des programmes avec un message de succès
        return redirect()->route('programs.index')->with('success', 'Filière supprimée avec succès.');
    }
    

    /**
     * Validates program creation or update request.
     */
    private function validateProgram(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'entrants_profile' => 'nullable|string',
            'pathways' => 'nullable|string',
            'outcomes' => 'nullable|string',
            'universities' => 'required|array', // Liste des universités associées
        ]);
    }
}
