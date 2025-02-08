<h1>{{ $university->name }}</h1>
<p><strong>Description :</strong> {{ $university->description }}</p>
<p><strong>Adresse :</strong> {{ $university->address }}</p>
<p><strong>Site Web :</strong> <a href="{{ $university->website }}" target="_blank">{{ $university->website }}</a></p>
<p><strong>Région :</strong> {{ $university->region }}</p>
<p><strong>Téléphone :</strong> {{ $university->phone }}</p>
<p><strong>Vie Étudiante :</strong> {{ $university->student_life }}</p>
<p><strong>Travaux Réalisés :</strong> {{ $university->achievements }}</p>