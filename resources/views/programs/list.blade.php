<!-- Section Gestion des Filières -->
<section class="mb-4">
    <h2 class="mb-3">Gestion des Filières</h2>
    <!-- Boutons d'ajout et de liste des filières -->
    <div class="mb-3">
        <a href="{{ route('admin.filieres.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter une Filière
        </a>
        <a href="{{ route('admin.filieres.list') }}" class="btn btn-primary">
            <i class="bi bi-list"></i> Liste des Filières
        </a>
    </div>

    <!-- Tableau des filières -->
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
                        <!-- Formulaire de suppression -->
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
