<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PedidoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('usuario.name')
                    ->label('Usuario'),
                TextEntry::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente'  => 'warning',
                        'confirmado' => 'success',
                        'cancelado'  => 'danger',
                        default      => 'gray',
                    }),
                TextEntry::make('monto_total')
                    ->label('Monto Total')
                    ->money('MXN'),
                TextEntry::make('pago.metodo_pago')
                    ->label('Método de Pago')
                    ->default('-'),
                TextEntry::make('pago.estado')
                    ->label('Estado del Pago')
                    ->badge()
                    ->default('-'),
                TextEntry::make('created_at')
                    ->label('Fecha del Pedido')
                    ->dateTime('d/m/Y H:i'),
                RepeatableEntry::make('items')
                    ->label('Items del Pedido')
                    ->schema([
                        TextEntry::make('tipoEntrada.nombre')
                            ->label('Tipo de Entrada'),
                        TextEntry::make('cantidad')
                            ->label('Cantidad'),
                        TextEntry::make('precio_unitario')
                            ->label('Precio Unitario')
                            ->money('MXN'),
                    ]),
            ]);
    }
}