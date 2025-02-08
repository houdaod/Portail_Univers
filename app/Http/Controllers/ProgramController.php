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
        $programs = Program::with('universities')->get();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('programs.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'entrants_profile' => 'nullable|string',
            'pathways' => 'nullable|string',
            'outcomes' => 'nullable|string',
            'universities' => 'required|array', // Liste des universités associées
        ]);

        $program = Program::create($request->only([
            'name', 'description', 'entrants_profile', 'pathways', 'outcomes'
        ]));

        $program->universities()->attach($request->universities);

        return redirect()->route('programs.index')
                        ->with('success', 'Filière créée avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $universities = University::all();
        return view('programs.edit', compact('program', 'universities'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'entrants_profile' => 'nullable|string',
            'pathways' => 'nullable|string',
            'outcomes' => 'nullable|string',
            'universities' => 'required|array', // Liste des universités associées
        ]);

        $program->update($request->only([
            'name', 'description', 'entrants_profile', 'pathways', 'outcomes'
        ]));

        $program->universities()->sync($request->universities);

        return redirect()->route('programs.index')
                        ->with('success', 'Filière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->universities()->detach();
        $program->delete();
        return redirect()->route('programs.index')
                        ->with('success', 'Filière supprimée avec succès.');
    }
}
