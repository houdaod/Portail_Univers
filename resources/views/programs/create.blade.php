<form action="{{ route('programs.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom de la filière :</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="entrants_profile">Profil des entrants :</label>
        <input type="text" name="entrants_profile" id="entrants_profile">
    </div>
    <div>
        <label for="pathways">Parcours :</label>
        <input type="text" name="pathways" id="pathways">
    </div>
    <div>
        <label for="outcomes">Débouchés :</label>
        <input type="text" name="outcomes" id="outcomes">
    </div>
    <div>
        <label for="universities">Universités associées :</label>
        <select name="universities[]" id="universities" multiple required>
            @foreach ($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Créer</button>
</form>