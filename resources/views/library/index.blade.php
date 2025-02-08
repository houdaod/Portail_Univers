<h1>Documents pour la filière : {{ $program->name }}</h1>

<h2>Documents publics</h2>
@foreach ($publicDocuments as $document)
    <div>
        <h3>{{ $document->title }}</h3>
        <a href="{{ Storage::url($document->file_path) }}" target="_blank">Télécharger</a>
    </div>
@endforeach

<h2>Documents réservés aux abonnés</h2>
@foreach ($subscriptionDocuments as $document)
    <div>
        <h3>{{ $document->title }}</h3>
        @if (auth()->user() && auth()->user()->hasActiveSubscription())
            <a href="{{ Storage::url($document->file_path) }}" target="_blank">Télécharger</a>
        @else
            <p>Abonnez-vous pour accéder à ce document.</p>
        @endif
    </div>
@endforeach

