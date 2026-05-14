<?php

namespace App\Filament\Resources\Recintos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecintoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre del recinto')
                    ->required()
                    ->maxLength(255),

                TextInput::make('ciudad')
                    ->label('Ciudad')
                    ->required()
                    ->maxLength(255),

                TextInput::make('estado')
                    ->label('Estado')
                    ->required()
                    ->maxLength(255),

                TextInput::make('colonia')
                    ->label('Colonia')
                    ->required()
                    ->maxLength(255),

                TextInput::make('pais')
                    ->label('País')
                    ->required()
                    ->default('México')
                    ->maxLength(255),

                TextInput::make('codigo_postal')
                    ->label('Código postal')
                    ->required()
                    ->maxLength(10),

                TextInput::make('direccion')
                    ->label('Dirección')
                    ->required()
                    ->maxLength(255),

                TextInput::make('capacidad')
                    ->label('Capacidad')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                TextInput::make('latitud')
                    ->label('Latitud')
                    ->numeric(),

                TextInput::make('longitud')
                    ->label('Longitud')
                    ->numeric(),

                TextInput::make('imagen_url')
                    ->label('URL de imagen')
                    ->url(),

                Toggle::make('activo')
                    ->label('Activo')
                    ->default(true)
                    ->required(),
            ])
            ->columns(2);
    }
}