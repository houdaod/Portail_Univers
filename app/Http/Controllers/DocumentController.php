<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Program;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    //
    public function index(Program $program)
    {
        $documents = $program->documents()->get();
        return view('documents.index', compact('documents', 'program'));
    }
    public function download(Document $document)
    {
        return response()->download(storage_path('app/' . $document->file_path));
    }

    public function create(Program $program)
    {
        return view('documents.create', compact('program'));
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
