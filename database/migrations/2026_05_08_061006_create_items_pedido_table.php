<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items_pedido', function (Blueprint $table) {
            $table->id();

            // cascade: si se borra el pedido, sus items también se eliminan
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->onDelete('cascade');

            // restrict: no se puede borrar un tipo de entrada si tiene items de pedido asociados
            $table->foreignId('tipo_entrada_id')
                  ->constrained('tipos_entrada')
                  ->onDelete('restrict');

            $table->unsignedInteger('cantidad');

            // se guarda el precio al momento de la compra — puede cambiar después
            $table->decimal('precio_unitario', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items_pedido');
    }
};