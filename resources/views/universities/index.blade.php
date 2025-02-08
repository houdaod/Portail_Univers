@foreach ($universities as $university)
    <div>
        <h2>{{ $university->name }}</h2>
        <p>{{ $university->description }}</p>
        <a href="{{ route('universities.edit', $university) }}">Modifier</a>
        <form action="{{ route('universities.destroy', $university) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </div>
@endforeach