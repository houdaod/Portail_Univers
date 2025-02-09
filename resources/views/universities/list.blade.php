@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <h2 class="mb-3">Liste des Universités</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom de l'Université</th>
                    <th>Adresse</th>
                    <th>Site Web</th>
                    <th>Région</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($universities as $universite)
                    <tr>
                        <td>{{ $universite->name }}</td>
                        <td>{{ $universite->address ?? 'Non spécifiée' }}</td>
                        <td>{{ $universite->website ?? 'Non spécifié' }}</td>
                        <td>{{ $universite->region ?? 'Non spécifiée' }}</td>
                        <td>
                            <a href="{{ route('universities.edit', $universite) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('universities.delete', $universite) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
