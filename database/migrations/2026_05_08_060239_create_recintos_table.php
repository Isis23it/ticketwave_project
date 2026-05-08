<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recintos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('ciudad', 100);
            $table->string('estado', 100);
            $table->string('colonia', 100);
            $table->string('pais', 100)->default('México');
            $table->string('codigo_postal', 10);
            $table->string('direccion', 255);

            // int y no decimal — la capacidad siempre es un número entero de personas
            $table->unsignedInteger('capacidad');

            // decimal(10,7) para precisión suficiente en coordenadas GPS
            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();

            $table->string('imagen_url')->nullable();

            // activo en lugar de soft delete — permite ocultar sin borrar el historial
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recintos');
    }
};