<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente'  => 'Pendiente',
                        'confirmado' => 'Confirmado',
                        'cancelado'  => 'Cancelado',
                    ])
                    ->required(),
            ]);
    }
}