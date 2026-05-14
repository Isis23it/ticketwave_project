<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo que representa un tipo de boleto disponible en un evento.
 * Ej: General, VIP, Palco — cada uno con precio y cupo propio.
 * El campo vendidas se incrementa automáticamente en el checkout,
 * nunca se edita directamente desde el CRUD.
 */

class TipoEntrada extends Model
{
  protected $table = 'tipos_entrada';

  protected $fillable = [
    'evento_id',
    'nombre',
    'descripcion',
    'disponibles',
    'precio',
    'disponibles',
    'limite_por_compra',
  ];

  /** @var array Conversión automática de tipos */
  protected $casts = [
    'precio' => 'decimal:2',
  ];

  public function evento(): BelongsTo
  {
    return $this->belongsTo(Evento::class);
  }

  /**
   * Items de pedido que referencian este tipo de entrada.
   * La FK onDelete restrict impide borrar si hay boletos vendidos.
   */
  public function itemsPedido(): HasMany
  {
    return $this->hasMany(ItemPedido::class);
  }

  /**
   * Boletos que aún se pueden vender.
   * Uso: $tipo->restantes
   */
  public function getRestantesAttribute(): int
  {
    return $this->disponibles - $this->vendidas;
  }

  /**
   * Indica si aún hay boletos disponibles para comprar.
   * Uso: $tipo->tiene_disponibles → true/false
   */
  public function getTieneDisponiblesAttribute(): bool
  {
    return $this->getRestantesAttribute() > 0;
  }
}
