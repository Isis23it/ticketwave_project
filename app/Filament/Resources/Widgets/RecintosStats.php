<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Recinto;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RecintosStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Recintos Totales', Recinto::count()),
        ];
    }
}