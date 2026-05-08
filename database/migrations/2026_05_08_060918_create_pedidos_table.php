<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // cascade: si se borra el usuario, sus pedidos también se eliminan
            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // enum para controlar el ciclo de vida del pedido
            $table->enum('estado', ['pendiente', 'confirmado', 'cancelado'])->default('pendiente');

            // decimal(10,2) y no float — evita errores de redondeo en montos
            $table->decimal('monto_total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};