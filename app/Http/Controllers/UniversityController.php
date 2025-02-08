<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::all();
        return view('universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(Request $request)
    {
        //
    }*/

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'region' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'student_life' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        University::create($request->all());

        return redirect()->route('universities.index')
                        ->with('success', 'Université créée avec succès.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'region' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'student_life' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        $university->update($request->all());

        return redirect()->route('universities.index')
                        ->with('success', 'Université mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities.index')
                        ->with('success', 'Université supprimée avec succès.');
    }
}


