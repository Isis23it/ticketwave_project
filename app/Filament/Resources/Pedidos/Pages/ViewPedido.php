<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;

class ViewPedido extends ViewRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cambiar_estado')
                ->label('Cambiar Estado')
                ->form([
                    Select::make('estado')
                        ->label('Estado')
                        ->options([
                            'pendiente'  => 'Pendiente',
                            'confirmado' => 'Confirmado',
                            'cancelado'  => 'Cancelado',
                        ])
                        ->default(fn () => $this->record->estado)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $this->record->update(['estado' => $data['estado']]);
                    $this->redirect(request()->header('Referer'));
                }),
        ];
    }
}