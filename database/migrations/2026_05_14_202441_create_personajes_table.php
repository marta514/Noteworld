<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mundo_id')->constrained('mundos')->onDelete('cascade');
            $table->string('nombre');
            $table->text('biografia')->nullable();
            $table->string('edad')->nullable(); // String para permitir "Desconocida"
            $table->string('genero')->nullable();
            $table->string('especie')->nullable();
            $table->text('apariencia_fisica')->nullable(); // Corregido de aperiencia_fisica
            $table->text('personalidad')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personajes');
    }
};