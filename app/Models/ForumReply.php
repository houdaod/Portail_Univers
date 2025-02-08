<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    protected $fillable = ['content', 'user_id', 'forum_post_id'];

    // Une réponse appartient à un ForumPost
    public function forumPost()
    {
        return $this->belongsTo(ForumPost::class);
    }

    // Une réponse appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
