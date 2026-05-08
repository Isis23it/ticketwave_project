<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_entrada', function (Blueprint $table) {
            $table->id();

            // cascade: si se borra el evento, sus tipos de entrada ya no tienen sentido
            $table->foreignId('evento_id')
                  ->constrained('eventos')
                  ->onDelete('cascade');

            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('disponibles');

            // decimal(10,2) y no float — evita errores de redondeo en precios
            $table->decimal('precio', 10, 2);

            // null significa sin límite de boletos por compra
            $table->unsignedTinyInteger('limite_por_compra')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_entrada');
    }
};