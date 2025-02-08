<form action="{{ route('universities.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom de l'université :</label>
        <input type="text" name="name" id="name" required>
    </div>
    <!-- Ajoute les autres champs ici -->
    <button type="submit">Créer</button>
</form>