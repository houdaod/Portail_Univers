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
        <a href="{{ route('documents.create') }}" class="mb-3 btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un Document
        </a>
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
                        <a href="{{ route('documents.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Ajouter
                        </a>
                    </td>
                    <td>Document exemple</td>
                    <td>
                        <a href="{{ route('documents.index') }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-list"></i> Lister
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Section Gestion des Universités -->
    <section class="mb-4">
        <h2 class="mb-3">Gestion des Universités</h2>
        <a href="{{ route('admin.universites.create') }}" class="mb-3 btn btn-info">
            <i class="bi bi-plus-circle"></i> Ajouter une Université
        </a>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Université</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="{{ route('admin.universites.manage') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-gear"></i> Gérer
                        </a>
                    </td>
                    <td>Université exemple</td>
                    <td>
                        <a href="{{ route('admin.universites.list') }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-list"></i> Lister
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Section Gestion des Filières -->
    <section class="mb-4">
        <h2 class="mb-3">Gestion des Filières</h2>
        <a href="{{ route('admin.filieres.create') }}" class="mb-3 btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter une Filière
        </a>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Filière</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="{{ route('admin.filieres.manage') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-gear"></i> Gérer
                        </a>
                    </td>
                    <td>Filière exemple</td>
                    <td>
                        <a href="{{ route('admin.filieres.list') }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-list"></i> Lister
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Section Gestion des Utilisateurs -->

    <!-- Bouton de déconnexion -->
    <div class="mt-5 text-center">
        <a href="{{ route('logout') }}" class="btn btn-danger">
            <i class="bi bi-box-arrow-left"></i> Se déconnecter
        </a>
    </div>
</div>
@endsection