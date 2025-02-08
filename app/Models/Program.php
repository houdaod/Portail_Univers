<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'description',
        'entrants_profile',
        'pathways',
        'outcomes',
    ];

    // Relation Many-to-Many avec University
    
    public function universities()
    {
        return $this->belongsToMany(University::class, 'program_university');
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}


