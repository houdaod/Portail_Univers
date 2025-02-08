<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description', // Description : Koudougou
        'address', // Adresse : BP 190
        'website', // Site Web : Visitez le site
        'region', // Région
        'phone', // Téléphone
        'student_life', // Vie Étudiante
        'achievements', // Travaux Réalisés
    ];

    // Relation Many-to-Many avec Program
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_university');
    }
}