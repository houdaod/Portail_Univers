<h1>Ajouter un nouveau document</h1>
<form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div>
        <label for="file">Fichier :</label>
        <input type="file" name="file" id="file" required>
    </div>

    <div>
        <label for="type">Type :</label>
        <select name="type" id="type" required>
            <option value="public">Public</option>
            <option value="subscription">Réservé</option>
        </select>
    </div>

    <div>
        <label for="program_id">Filière :</label>
        <select name="program_id" id="program_id" required>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Ajouter</button>
</form>
