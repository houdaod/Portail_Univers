<form action="{{ route('programs.update', $program) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nom de la filière :</label>
        <input type="text" name="name" id="name" value="{{ $program->name }}" required>
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description">{{ $program->description }}</textarea>
    </div>
    <div>
        <label for="entrants_profile">Profil des entrants :</label>
        <input type="text" name="entrants_profile" id="entrants_profile" value="{{ $program->entrants_profile }}">
    </div>
    <div>
        <label for="pathways">Parcours :</label>
        <input type="text" name="pathways" id="pathways" value="{{ $program->pathways }}">
    </div>
    <div>
        <label for="outcomes">Débouchés :</label>
        <input type="text" name="outcomes" id="outcomes" value="{{ $program->outcomes }}">
    </div>
    <div>
        <label for="universities">Universités associées :</label>
        <select name="universities[]" id="universities" multiple required>
            @foreach ($universities as $university)
                <option value="{{ $university->id }}" {{ in_array($university->id, $program->universities->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $university->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Mettre à jour</button>
</form>