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
        return view('universities.list', compact('universities'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('universities.create');
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
            'address' => 'nullable|string',
            'website' => 'nullable|url',
            'region' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $university = new University();
        $university->name = $request->input('name');
        $university->description = $request->input('description');
        $university->address = $request->input('address');
        $university->website = $request->input('website');
        $university->region = $request->input('region');
        $university->phone = $request->input('phone');
        $university->save();

        return redirect()->route('universities.index')->with('success', 'Université ajoutée avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'website' => 'nullable|url',
            'region' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $university->name = $request->input('name');
        $university->description = $request->input('description');
        $university->address = $request->input('address');
        $university->website = $request->input('website');
        $university->region = $request->input('region');
        $university->phone = $request->input('phone');
        $university->save();

        return redirect()->route('universities.index')->with('success', 'Université mise à jour avec succès');
    }

    public function list()
    {
        $universities = University::all();
        return view('universities.list', compact('universities'));
    }

    public function manage(University $university)
    {
        return view('universities.manage', compact('university'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $universities = University::where('name', 'like', "%$query%")
            ->orWhere('region', 'like', "%$query%")
            ->get();

        return view('universities.search', compact('universities'));
    }

    public function confirmDelete(University $university)
    {
        return view('universities.confirmDelete', compact('university'));
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'Université supprimée avec succès');
    }

}


