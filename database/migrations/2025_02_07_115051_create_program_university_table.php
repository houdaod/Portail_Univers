<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Création de la table pivot pour la relation Many-to-Many
        Schema::create('program_university', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la table programs
            $table->foreignId('program_id')->constrained()->onDelete('cascade'); 
            // Clé étrangère vers la table universities
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            // Colonnes pour la gestion des timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression de la table pivot lors du rollback de la migration
        Schema::dropIfExists('program_university');
    }
};
