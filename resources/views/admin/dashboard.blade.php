@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Titre de la page -->
    <h1 class="mb-4 text-center">Bienvenue, Administrateur</h1>

    <!-- Cartes de statistiques -->
    <div class="mb-4 row">
        <!-- Carte Utilisateurs -->
        <div class="col-md-3">
            <div class="mb-3 text-center text-white card bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text display-6">{{ $total_users }}</p>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>

        <!-- Carte Universités -->
        <div class="col-md-3">
            <div class="mb-3 text-center text-white card bg-success">
                <div class="card-body">
                    <h5 class="card-title">Universités</h5>
                    <p class="card-text display-6">{{ $total_universites }}</p>
                    <i class="bi bi-building fs-1"></i>
                </div>
            </div>
        </div>

        <!-- Carte Filières -->
        <div class="col-md-3">
            <div class="mb-3 text-center text-white card bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Filières</h5>
                    <p class="card-text display-6">{{ $total_filieres }}</p>
                    <i class="bi bi-journal fs-1"></i>
                </div>
            </div>
        </div>

        <!-- Carte Documents -->
        <div class="col-md-3">
            <div class="mb-3 text-center text-white card bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Documents</h5>
                    <p class="card-text display-6">{{ $total_documents }}</p>
                    <i class="bi bi-file-earmark-text fs-1"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Gestion des Documents -->
    <section class="mb-4">
        <h2 class="mb-3">Gestion des Documents</h2>
        @foreach ($programs as $program)
            <a href="{{ route('documents.create', ['programId' => $program->id]) }}" class="mb-3 btn btn-info">
                <i class="bi bi-plus-circle"></i> Créer un document pour {{ $program->name }}
            </a>
        @endforeach


        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Document</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <!-- Lien de création -->
                        <a href="{{ route('documents.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Ajouter
                        </a>
                    </td>
                    <td>Document exemple</td>
                    <td>
                        
                        @foreach ($programs as $program)
                        <a href="{{ route('documents.index', ['program' => $program->id]) }}"btn btn-warning btn-sm">
                            <i class="bi bi-list"></i>Voir les documents pour {{ $program->name }}</a>
                        @endforeach

                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Section Gestion des Universités -->
    <section class="mb-4">
        <h2 class="mb-3">Gestion des Universités</h2>
        
        <!-- Bouton pour ajouter une université -->
        <a href="{{ route('universities.create') }}" class="mb-3 btn btn-info">
            <i class="bi bi-plus-circle"></i> Ajouter une Université
        </a>
    
        <!-- Recherche d'université -->
        <form action="{{ route('universities.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une université" value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </div>
        </form>
    
        <!-- Tableau des universités -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Université</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($universites as $universite)
                    <tr>
                        <td>
                            <a href="{{ route('universities.show', $universite->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                            <a href="{{ route('universities.manage', $universite->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-gear"></i> Gérer
                            </a>
                        </td>
                        <td>{{ $universite->name }}</td>
                        <td>
                            <a href="{{ route('universities.list', $universite->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-list"></i> Lister
                            </a>
                            <!-- Confirmation avant suppression -->
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $universite->id }}">
                                <i class="bi bi-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Pagination (si applicable) -->

    
    </section>
    
    <!-- Modal de confirmation de suppression -->
    @foreach($universites as $universite)
        <div class="modal fade" id="confirmDeleteModal{{ $universite->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cette université ?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('universities.delete', $universite->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    

   <!-- Section Gestion des Filières -->
<!-- Section Gestion des Filières -->
<section class="mb-4">
    <h2 class="mb-3">Gestion des Filières</h2>
    <a href="{{ route('admin.filieres.create') }}" class="mb-3 btn btn-success">
        <i class="bi bi-plus-circle"></i> Ajouter une Filière
    </a>
    <a href="{{ route('admin.filieres.list') }}" class="mb-3 btn btn-primary">
        <i class="bi bi-list"></i> Liste des Filières
    </a>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Action</th>
                <th>Filière</th>
                <th>Description</th>
                <th>Profil des entrants</th>
                <th>Parcours</th>
                <th>Résultats attendus</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr>
                    <td>
                        <a href="{{ route('admin.filieres.show', $program->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Voir
                        </a>
                        <a href="{{ route('admin.filieres.manage', $program->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-gear"></i> Gérer
                        </a>
                    </td>
                    <td>{{ $program->name }}</td>
                    <td>{{ Str::limit($program->description, 50) }}</td>
                    <td>{{ $program->entrants_profile }}</td>
                    <td>{{ $program->pathways }}</td>
                    <td>{{ $program->outcomes }}</td>
                    <td>
                        <a href="{{ route('admin.filieres.edit', $program->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('admin.filieres.destroy', $program->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>



    
    <!-- Bouton de déconnexion -->
    <div class="mt-5 text-center">
        <a href="{{ route('logout') }}" class="btn btn-danger">
            <i class="bi bi-box-arrow-left"></i> Se déconnecter
        </a>
    </div>
</div>

@endsection
