<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importez la façade Auth

class ForumController extends Controller
{
    /**
     * Afficher la liste des posts du forum.
     */
    public function index()
    {
        // Charger les posts avec leurs utilisateurs et les réponses avec leurs utilisateurs
        $posts = ForumPost::with('user', 'replies.user')->get();
        return view('forum.index', compact('posts'));
    }

    /**
     * Afficher le formulaire pour créer un nouveau post.
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Enregistrer un nouveau post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        ForumPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.index');
    }

    /**
     * Afficher un post spécifique avec ses réponses.
     */
    public function show($id)
    {
        $post = ForumPost::with('replies.user')->findOrFail($id); // Charger un post avec ses réponses et les utilisateurs
        return view('forum.show', compact('post'));
    }

    /**
     * Afficher le formulaire pour éditer un post.
     */
    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);

        // Vérifie que l'utilisateur est le propriétaire du post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('forum.index')->with('error', 'Vous n\'avez pas la permission de modifier ce post.');
        }

        return view('forum.edit', compact('post'));
    }

    /**
     * Mettre à jour un post.
     */
    public function update(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);

        // Vérifie que l'utilisateur est le propriétaire du post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('forum.index')->with('error', 'Vous n\'avez pas la permission de modifier ce post.');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index');
    }

    /**
     * Supprimer un post.
     */
    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);

        // Supprimer d'abord les réponses associées
        $post->replies()->delete();

        // Puis supprimer le post lui-même
        $post->delete();

        return redirect()->route('forum.index');
    }

    /**
     * Enregistrer une réponse à un post.
     */
    public function storeReply(Request $request, $postId)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour répondre.');
        }

        $request->validate([
            'content' => 'required',
        ]);

        ForumReply::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'forum_post_id' => $postId,
        ]);

        return redirect()->route('forum.show', $postId);
    }
}