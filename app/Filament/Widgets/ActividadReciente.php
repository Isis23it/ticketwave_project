<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\Widget;

class ActividadReciente extends Widget
{
    protected static ?string $heading = 'Actividad reciente';
    protected string $view = 'filament.widgets.actividad-reciente';
    protected int|string|array $columnSpan = 1;
    protected static ?int $sort = 3;

    public function getPedidos()
    {
        return Pedido::with('usuario')
            ->latest()
            ->take(6)
            ->get();
    }
}