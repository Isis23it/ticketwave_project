<?php

namespace App\Filament\Resources\Eventos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('recinto.nombre')
                    ->label('Recinto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fecha_evento')
                    ->label('Fecha de evento')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('usuario.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrador' => 'warning',
                        'publicado' => 'success',
                        'cancelado' => 'danger',
                        default => 'gray',
                    }),

            ])

            ->defaultPaginationPageOption(10)

            ->filters([

                SelectFilter::make('estado')
                    ->label('Todos los estados')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'cancelado' => 'Cancelado',
                    ]),

            ])

            ->recordActions([

                EditAction::make(),

                DeleteAction::make()
                    ->requiresConfirmation(),

            ])

            ->toolbarActions([

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),

            ]);
    }
}