<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
        */

        public function up()
        {
            Schema::create('programs', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Nom de la filière
                $table->text('description')->nullable(); // Description de la filière
                $table->string('entrants_profile')->nullable(); // Profil des entrants
                $table->string('pathways')->nullable(); // Parcours
                $table->string('outcomes')->nullable(); // Débouchés
                $table->timestamps();
            });
        }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};


