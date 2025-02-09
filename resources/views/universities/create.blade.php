@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <h2 class="mb-3">Ajouter une Université</h2>
        <form method="POST" action="{{ route('universities.store') }}">
            @csrf
            <div class="mb-3 form-group">
                <label for="name">Nom de l'université</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3 form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <div class="mb-3 form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3 form-group">
                <label for="website">Site Web</label>
                <input type="url" class="form-control" id="website" name="website">
            </div>
            <div class="mb-3 form-group">
                <label for="region">Région</label>
                <input type="text" class="form-control" id="region" name="region">
            </div>
            <div class="mb-3 form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3 form-group">
                <label for="student_life">Vie étudiante</label>
                <textarea class="form-control" id="student_life" name="student_life" rows="4"></textarea>
            </div>
            <div class="mb-3 form-group">
                <label for="achievements">Réalisations</label>
                <textarea class="form-control" id="achievements" name="achievements" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </section>
@endsection
