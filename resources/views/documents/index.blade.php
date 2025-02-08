<h1>Documents pour la filière {{ $program->name }}</h1>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documents as $document)
            <tr>
                <td>{{ $document->title }}</td>
                <td>{{ ucfirst($document->type) }}</td>
                <td>
                    <a href="{{ route('documents.download', $document) }}">Télécharger</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
