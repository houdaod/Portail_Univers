<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Program $program)
    {
        $publicDocuments = $program->documents()->where('type', 'public')->get();
        $subscriptionDocuments = $program->documents()->where('type', 'subscription')->get();
        return view('library.index', compact('program', 'publicDocuments', 'subscriptionDocuments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('library.create', compact('programs'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
            'type' => 'required|in:public,subscription',
        ]);

        $filePath = $request->file('file')->store('documents');

        // Création du document lié au programme
        Document::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'type' => $request->type,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('library.index', $request->program_id)
                        ->with('success', 'Document ajouté avec succès.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Document $document)
    {
        // Suppression du fichier s'il existe dans le stockage
        if ($document->file_path && Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        // Suppression du document de la base de données
        $document->delete();

        // Redirection avec message de succès
        return redirect()->route('library.index', ['program' => $document->program_id])
                        ->with('success', 'Document supprimé avec succès.');
    }

}
