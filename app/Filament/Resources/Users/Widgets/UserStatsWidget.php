<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Widget con métricas rápidas del listado de usuarios.
 */
class UserStatsWidget extends StatsOverviewWidget
{
  protected function getStats(): array
  {
    return [
      Stat::make('Total', User::count())
        ->color('gray'),

      Stat::make('Administradores', User::where('rol', 'admin')->count())
        ->color('danger'),

      Stat::make('Organizadores', User::where('rol', 'organizador')->count())
        ->color('warning'),

      Stat::make('Compradores', User::where('rol', 'comprador')->count())
        ->color('success'),
    ];
  }
}
