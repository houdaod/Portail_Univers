<!-- resources/views/forum/show.blade.php -->
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>

<h3>Réponses :</h3>
@foreach ($post->replies as $reply)
    <div>
        <p>{{ $reply->content }}</p>
        <small>Répondu par {{ $reply->user->name }}</small>
    </div>
@endforeach

<form action="{{ route('forum.reply.store', $post->id) }}" method="POST">
    @csrf
    <textarea name="content" placeholder="Écrire une réponse"></textarea>
    <button type="submit">Répondre</button>
</form>
