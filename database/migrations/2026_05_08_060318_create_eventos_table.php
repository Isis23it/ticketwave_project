<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();

            // cascade: si se borra el usuario organizador, sus eventos también se eliminan
            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // cascade: si se borra el recinto, los eventos asociados también se eliminan
            $table->foreignId('recinto_id')
                  ->constrained('recintos')
                  ->onDelete('cascade');

            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();

            // enum para forzar valores controlados y evitar datos inválidos
            $table->enum('categoria', ['concierto', 'deporte', 'teatro', 'otro']);
            $table->string('imagen_url')->nullable();

            // enum: borrador hasta que el organizador lo publique
            $table->enum('estado', ['borrador', 'publicado', 'cancelado'])->default('borrador');

            $table->datetime('fecha_evento');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};