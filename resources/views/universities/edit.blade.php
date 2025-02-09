@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <h2 class="mb-3">Modifier l'Université - {{ $universite->name }}</h2>
        <form method="POST" action="{{ route('admin.universites.update', $universite) }}">
            @csrf
            @method('PUT')
            <div class="mb-3 form-group">
                <label for="name">Nom de l'université</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $universite->name }}" required>
            </div>
            <div class="mb-3 form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ $universite->description }}</textarea>
            </div>
            <div class="mb-3 form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $universite->address }}">
            </div>
            <div class="mb-3 form-group">
                <label for="website">Site Web</label>
                <input type="url" class="form-control" id="website" name="website" value="{{ $universite->website }}">
            </div>
            <div class="mb-3 form-group">
                <label for="region">Région</label>
                <input type="text" class="form-control" id="region" name="region" value="{{ $universite->region }}">
            </div>
            <div class="mb-3 form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $universite->phone }}">
            </div>
            <div class="mb-3 form-group">
                <label for="student_life">Vie étudiante</label>
                <textarea class="form-control" id="student_life" name="student_life" rows="4">{{ $universite->student_life }}</textarea>
            </div>
            <div class="mb-3 form-group">
                <label for="achievements">Réalisations</label>
                <textarea class="form-control" id="achievements" name="achievements" rows="4">{{ $universite->achievements }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </section>
@endsection
