<h1>Confirmer la suppression</h1>
<p>Êtes-vous sûr de vouloir supprimer l'université {{ $university->name }} ? Cette action est irréversible.</p>

<form action="{{ route('universities.delete', $university) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Oui, supprimer</button>
    <a href="{{ route('universities.index') }}">Non, annuler</a>
</form>
