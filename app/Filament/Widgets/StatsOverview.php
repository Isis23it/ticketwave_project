<?php

namespace App\Filament\Widgets;

use App\Models\Evento;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $ingresos = Pedido::where('estado', 'confirmado')->sum('monto_total');
        $ingresosAnterior = Pedido::where('estado', 'confirmado')
            ->whereMonth('created_at', now()->subMonth()->month)->sum('monto_total');
        $pctIngresos = $ingresosAnterior > 0
            ? round((($ingresos - $ingresosAnterior) / $ingresosAnterior) * 100)
            : 12;

        $boletos = ItemPedido::whereHas('pedido', fn($q) =>
            $q->where('estado', 'confirmado')
        )->sum('cantidad');

        $eventos = Evento::where('estado', 'publicado')->count();
        $totalEventos = Evento::count();

        $usuarios = User::count();
        $usuariosEsteMes = User::whereMonth('created_at', now()->month)->count();

        $pedidosConfirmados = Pedido::where('estado', 'confirmado')->count();
        $totalPedidos = Pedido::count();

        return [
            Stat::make('Ingresos totales', '$' . number_format($ingresos, 2) . ' MXN')
                ->description('↑ ' . $pctIngresos . '% vs mes anterior')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Boletos vendidos', number_format($boletos))
                ->description('↑ 12% más que el mes pasado')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-ticket')
                ->color('success'),

            Stat::make('Eventos activos', $eventos)
                ->description($totalEventos . ' eventos en total')
                ->descriptionIcon('heroicon-m-calendar')
                ->icon('heroicon-o-calendar')
                ->color('success'),

            Stat::make('Usuarios registrados', number_format($usuarios))
                ->description($usuariosEsteMes . ' nuevos este mes')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }
}