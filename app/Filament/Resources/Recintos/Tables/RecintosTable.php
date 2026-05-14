<?php

namespace App\Filament\Resources\Recintos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RecintosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('direccion')
                    ->label('Dirección')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('ciudad')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('capacidad')
                    ->label('Capacidad')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean(),
            ])

            ->defaultPaginationPageOption(10)

            ->filters([
                SelectFilter::make('activo')
                    ->label('Estado')
                    ->options([
                        true => 'Activos',
                        false => 'Inactivos',
                    ]),
            ])

            ->recordActions([
                EditAction::make(),

                DeleteAction::make()
                    ->requiresConfirmation()
                    ->before(function ($record) {
                        if ($record->eventos()->exists()) {
                            Notification::make()
                                ->title('No se puede eliminar el recinto')
                                ->body('Este recinto tiene eventos asociados.')
                                ->danger()
                                ->send();

                            return false;
                        }
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}