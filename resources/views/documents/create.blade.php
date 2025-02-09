<h1 class="mb-6 text-2xl font-semibold">Ajouter un document pour la filière {{ $program->name ?? 'Program not found' }}</h1>

<form action="{{ route('documents.store', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    
    <!-- Sélection de l'université -->
    <div>
        <label for="university" class="block text-sm font-medium text-gray-700">Université :</label>
        <select name="university" id="university" class="block w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <option value="">Choisir une université</option>
            @foreach($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
            @endforeach
        </select>
    </div>
    
    <!-- Sélection de la filière -->
    <div>
        <label for="program" class="block text-sm font-medium text-gray-700">Filière :</label>
        <select name="program" id="program" class="block w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <option value="">Choisir une filière</option>
            @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Champ Titre -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Titre :</label>
        <input type="text" name="title" id="title" class="block w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>

    <!-- Champ Fichier -->
    <div>
        <label for="file" class="block text-sm font-medium text-gray-700">Fichier :</label>
        <input type="file" name="file" id="file" class="block w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>

    <!-- Sélection du type de document -->
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700">Type :</label>
        <select name="type" id="type" class="block w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <option value="public">Public</option>
            <option value="subscription">Abonnement</option>
        </select>
    </div>

    <!-- Bouton de soumission -->
    <button type="submit" class="w-full px-4 py-2 mt-6 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Ajouter</button>
</form>
