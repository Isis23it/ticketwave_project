<?php

namespace App\Filament\Widgets;

use App\Models\Evento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventosStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Eventos Totales', Evento::count()),

            Stat::make(
                'Disponibles',
                Evento::where('estado', 'publicado')->count()
            ),

            Stat::make(
                'Agotados',
                Evento::where('estado', 'cancelado')->count()
            ),
        ];
    }
}