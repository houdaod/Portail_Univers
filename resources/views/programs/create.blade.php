@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer un Nouveau Programme</h2>
        <form action="{{ route('admin.filieres.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom de la Filière</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="entrants_profile">Profil des Entrants</label>
                <input type="text" name="entrants_profile" id="entrants_profile" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="pathways">Parcours</label>
                <input type="text" name="pathways" id="pathways" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="outcomes">Résultats Attendus</label>
                <input type="text" name="outcomes" id="outcomes" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="universities">Universités Associées</label>
                <select name="universities[]" id="universities" class="form-control" multiple>
                    @foreach ($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="mt-3 btn btn-success">Créer</button>
        </form>
    </div>
@endsection
