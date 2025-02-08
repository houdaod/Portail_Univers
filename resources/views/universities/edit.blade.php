<form action="{{ route('universities.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom de l'université :</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="address">Adresse :</label>
        <input type="text" name="address" id="address">
    </div>
    <div>
        <label for="website">Site Web :</label>
        <input type="url" name="website" id="website">
    </div>
    <div>
        <label for="region">Région :</label>
        <input type="text" name="region" id="region">
    </div>
    <div>
        <label for="phone">Téléphone :</label>
        <input type="text" name="phone" id="phone">
    </div>
    <div>
        <label for="student_life">Vie Étudiante :</label>
        <textarea name="student_life" id="student_life"></textarea>
    </div>
    <div>
        <label for="achievements">Travaux Réalisés :</label>
        <textarea name="achievements" id="achievements"></textarea>
    </div>
    <button type="submit">Créer</button>
</form>