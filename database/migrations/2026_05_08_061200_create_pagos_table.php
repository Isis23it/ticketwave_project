<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            // cascade: si se borra el pedido, su pago también se elimina
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->onDelete('cascade');

            $table->string('metodo_pago', 50);

            // enum para controlar los estados válidos de un pago
            $table->enum('estado', ['pendiente', 'completado', 'fallido', 'reembolsado'])->default('pendiente');

            // decimal(10,2) — monto exacto cobrado en esta transacción
            $table->decimal('monto', 10, 2);

            // id externo del procesador de pagos (Stripe, PayPal, etc.)
            $table->string('id_transaccion')->nullable();

            $table->datetime('pagado_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};