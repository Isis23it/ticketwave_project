<?php

namespace App\Filament\Widgets;

use App\Models\Evento;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class EventosRecientes extends BaseWidget
{
    protected static ?string $heading = 'Eventos recientes';
    protected int|string|array $columnSpan = 2;
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Evento::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('nombre')
                    ->label('Evento')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Evento $record) => $record->recinto?->nombre ?? '—'),

                TextColumn::make('fecha_evento')
                    ->label('Fecha')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('warning'),

                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->badge()
                    ->color('success'),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'publicado'  => 'success',
                        'borrador'   => 'warning',
                        'cancelado'  => 'danger',
                        default      => 'gray',
                    }),
            ])
            ->filters([])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}