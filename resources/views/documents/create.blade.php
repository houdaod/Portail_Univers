<h1>Ajouter un document pour la filière {{ $program->name }}</h1>

<form action="{{ route('documents.store', $program) }}" method="POST" enctype="multipart/form-data">
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
            <option value="subscription">Abonnement</option>
        </select>
    </div>
    <button type="submit">Ajouter</button>
</form>
