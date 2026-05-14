<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de usuario de la plataforma.
 * Roles: admin (gestión total), organizador (crea eventos), comprador (compra boletos).
 * El campo activo permite desactivar una cuenta sin eliminarla.
 */
class User extends Authenticatable implements FilamentUser
{
  use HasFactory, Notifiable;

  /** @var array Campos editables */
  protected $fillable = [
    'name',
    'email',
    'rol',
    'password',
    'activo',
  ];

  /** @var array Campos ocultos en serialización */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /** @var array Conversión automática de tipos */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'activo' => 'boolean',
    ];
  }

  public function canAccessPanel(Panel $panel): bool
  {
    return $this->isAdmin();
  }

  // Métodos helper de roles
  public function isAdmin(): bool
  {
    return $this->rol === 'admin';
  }

  public function isOrganizador(): bool
  {
    return $this->rol === 'organizador';
  }

  public function isComprador(): bool
  {
    return $this->rol === 'comprador';
  }

  // Relaciones
  public function eventos()
  {
    return $this->hasMany(Evento::class, 'usuario_id');
  }

  public function pedidos()
  {
    return $this->hasMany(Pedido::class, 'usuario_id');
  }
}
