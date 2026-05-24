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
    Schema::create('image_personaje', function (Blueprint $table) {
        $table->id();
        // Conecta con la tabla personajes
        $table->foreignId('personaje_id')->constrained('personajes')->onDelete('cascade');
        // Conecta con la tabla images
        $table->foreignId('image_id')->constrained('images')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_personaje');
    }
};
