<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Program;
use App\Models\University;
use Illuminate\Http\Request;

class DocumentController extends Controller
{


    public function index($programId = null)
    {
        // Define the program variable if needed
        if ($programId) {
            $program = Program::find($programId);  // Ensure you have the Program model available
            $documents = Document::where('program_id', $programId)->get();
        } else {
            $program = null;  // If no program is selected
            $documents = Document::all();
        }
        
        return view('documents.index', compact('documents', 'program'));
    }
    


    public function download(Document $document)
    {
        return response()->download(storage_path('app/' . $document->file_path));
    }

    public function create($programId = null)
    {
        if ($programId) {
            $program = Program::findOrFail($programId);
        } else {
            $program = null;
        }

        $programs = Program::all(); // Récupère tous les programmes
        $universities = University::all();

        return view('documents.create', compact('program', 'programs', 'universities'));
    }



    public function store(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file',
            'type' => 'required|in:public,subscription',
        ]);

        $filePath = $request->file('file')->store('documents');

        $program->documents()->create([
            'title' => $request->title,
            'file_path' => $filePath,
            'type' => $request->type,
        ]);

        return redirect()->route('documents.index', $program)
                        ->with('success', 'Document ajouté avec succès.');
    }
    


}
