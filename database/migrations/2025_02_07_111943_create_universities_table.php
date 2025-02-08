<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable(); // Description : Koudougou
            $table->string('address')->nullable(); // Adresse : BP 190
            $table->string('website')->nullable(); // Site Web : Visitez le site
            $table->string('region')->nullable(); // Région
            $table->string('phone')->nullable(); // Téléphone
            $table->text('student_life')->nullable(); // Vie Étudiante
            $table->text('achievements')->nullable(); // Travaux Réalisés
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
