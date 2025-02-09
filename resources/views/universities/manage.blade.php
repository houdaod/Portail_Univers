@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <h2 class="mb-3">Gérer l'Université - {{ $universite->name }}</h2>
        <p>Vous pouvez gérer les informations suivantes pour cette université.</p>

        <div class="mb-3">
            <h4>Description</h4>
            <p>{{ $universite->description ?? 'Aucune description disponible' }}</p>
        </div>

        <div class="mb-3">
            <h4>Vie Étudiante</h4>
            <p>{{ $universite->student_life ?? 'Aucune information sur la vie étudiante' }}</p>
        </div>

        <div class="mb-3">
            <h4>Réalisations</h4>
            <p>{{ $universite->achievements ?? 'Aucune réalisation spécifiée' }}</p>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.universites.edit', $universite) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifier les Informations
            </a>
        </div>
    </section>
@endsection
