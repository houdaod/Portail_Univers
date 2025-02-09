<h1>Détails de l'Université: {{ $university->name }}</h1>
<p><strong>Description:</strong> {{ $university->description }}</p>
<p><strong>Adresse:</strong> {{ $university->address }}</p>
<p><strong>Site Web:</strong> <a href="{{ $university->website }}" target="_blank">{{ $university->website }}</a></p>
<p><strong>Région:</strong> {{ $university->region }}</p>
<p><strong>Téléphone:</strong> {{ $university->phone }}</p>
<a href="{{ route('universities.index') }}">Retour à la liste</a>
