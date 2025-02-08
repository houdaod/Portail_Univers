<form action="{{ route('subscription.store') }}" method="POST">
    @csrf
    <div>
        <label for="start_date">Date de début :</label>
        <input type="date" name="start_date" id="start_date" required>
    </div>
    <div>
        <label for="end_date">Date de fin :</label>
        <input type="date" name="end_date" id="end_date" required>
    </div>
    <button type="submit">Souscrire</button>
</form>