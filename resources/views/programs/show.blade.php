<!-- Vue Show - Détails du Programme -->
<section class="mb-4">
    <h2 class="mb-3">{{ $program->name }}</h2>

    <div class="mb-3">
        <strong>Description : </strong>{{ $program->description }}
    </div>
    <div class="mb-3">
        <strong>Profil des entrants : </strong>{{ $program->entrants_profile }}
    </div>
    <div class="mb-3">
        <strong>Parcours : </strong>{{ $program->pathways }}
    </div>
    <div class="mb-3">
        <strong>Résultats attendus : </strong>{{ $program->outcomes }}
    </div>
    <div class="mb-3">
        <strong>Universités associées : </strong>
        <ul>
            @foreach ($program->universities as $university)
                <li>{{ $university->name }}</li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('admin.filieres.edit', $program->id) }}" class="btn btn-warning">
        Modifier
    </a>
    <a href="{{ route('admin.filieres.list') }}" class="btn btn-primary">
        Retour à la liste
    </a>
</section>
