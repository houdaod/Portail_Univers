<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    // Un ForumPost peut avoir plusieurs réponses
    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }

    // Un ForumPost appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
