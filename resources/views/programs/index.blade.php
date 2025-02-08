@foreach ($programs as $program)
    <div>
        <h2>{{ $program->name }}</h2>
        <p>{{ $program->description }}</p>
        <p>Universités associées :</p>
        <ul>
            @foreach ($program->universities as $university)
                <li>{{ $university->name }}</li>
            @endforeach
        </ul>
        <a href="{{ route('programs.edit', $program) }}">Modifier</a>
        <form action="{{ route('programs.destroy', $program) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </div>
@endforeach