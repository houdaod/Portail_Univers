<!-- resources/views/user/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue, {{ $user->name }}</h1>
    <p>Email : {{ $user->email }}</p>

    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf <!-- Token CSRF pour la sécurité -->
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>