<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
/*    public function up(): void
    {
        Schema::create('program_university', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
*/
    public function up()
    {
        Schema::create('program_university', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade'); // Référence à Program
            $table->foreignId('university_id')->constrained()->onDelete('cascade'); // Référence à University
            $table->timestamps();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_university');
    }
};
