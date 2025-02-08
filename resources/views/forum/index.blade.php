<!-- resources/views/forum/index.blade.php -->
@foreach ($posts as $post)
    <div>
        <h3>{{ $post->title }} (Posté par {{ $post->user->name }})</h3>
        <p>{{ $post->content }}</p>
        <a href="{{ route('forum.show', $post->id) }}">Voir les réponses</a>
    </div>
@endforeach
