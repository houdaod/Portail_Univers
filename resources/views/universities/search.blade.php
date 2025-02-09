<h1>Recherche d'Université</h1>
<form action="{{ route('universities.search') }}" method="GET">
    <input type="text" name="query" placeholder="Rechercher par nom ou région" required>
    <button type="submit">Rechercher</button>
</form>

@if($universities->isEmpty())
    <p>Aucune université trouvée.</p>
@else
    <ul>
        @foreach($universities as $university)
            <li><a href="{{ route('universities.show', $university) }}">{{ $university->name }}</a></li>
        @endforeach
    </ul>
@endif
