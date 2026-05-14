<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class UserForm
{
  /**
   * Formulario de edición de usuarios.
   * Sección 1: Información personal (Nombre, Email)
   * Sección 2: Acceso y permisos (Rol, Activo, Contraseña)
   * No permite crear usuarios — solo editar los existentes.
   */
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        // ── Sección 1: Información personal ─────────────────
        Section::make('Información personal')
          ->schema([

            TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(100)
              ->columnSpan(1),

            TextInput::make('email')
              ->label('Correo electrónico')
              ->email()
              ->required()
              ->maxLength(150)
              ->unique(
                table: 'users',
                column: 'email',
                // ignorar el registro actual en edición
                ignorable: fn($record) => $record,
              )
              ->columnSpan(1),

          ])
          ->columns(2),

        // ── Sección 2: Acceso y permisos ─────────────────────
        Section::make('Acceso y permisos')
          ->schema([

            Select::make('rol')
              ->label('Rol')
              ->options([
                'admin'        => 'Administrador',
                'organizador'  => 'Organizador',
                'comprador'    => 'Comprador',
              ])
              ->required()
              ->columnSpan(1),

            // Toggle de cuenta activa/inactiva
            Toggle::make('activo')
              ->label('Cuenta activa')
              ->helperText('Desactivar impide que el usuario inicie sesión')
              ->default(true)
              ->columnSpan(1),

            // Contraseña opcional en edición
            TextInput::make('password')
              ->label('Nueva contraseña')
              ->helperText('Dejar vacío para no cambiarla')
              ->password()
              ->minLength(8)
              ->nullable()
              ->dehydrated(fn($state) => filled($state))
              ->dehydrateStateUsing(fn($state) => bcrypt($state))
              ->columnSpan(2),

          ])
          ->columns(2),
      ]);
  }
}
