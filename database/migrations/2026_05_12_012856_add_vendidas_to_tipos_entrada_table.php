<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('tipos_entrada', function (Blueprint $table) {
      // Se incrementa con cada compra — no se edita desde el CRUD
      $table->unsignedInteger('vendidas')->default(0)->after('disponibles');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('tipos_entrada', function (Blueprint $table) {
      $table->dropColumn('vendidas');
    });
  }
};
