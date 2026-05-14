<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Filament\Exporters\UsuarioExporter;

class UsersTable
{
  /**
   * Tabla del listado de usuarios.
   * Columnas: nombre, rol, correo, estado activo, fecha de registro.
   */
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->label('Nombre')
          ->searchable()
          ->sortable(),

        TextColumn::make('rol')
          ->label('Rol')
          ->badge()
          ->color(fn(string $state): string => match ($state) {
            'admin'       => 'danger',
            'organizador' => 'warning',
            'comprador'   => 'success',
            default       => 'gray',
          })
          ->formatStateUsing(fn(string $state): string => match ($state) {
            'admin'       => 'Administrador',
            'organizador' => 'Organizador',
            'comprador'   => 'Comprador',
            default       => $state,
          })
          ->sortable(),

        TextColumn::make('email')
          ->label('Correo')
          ->searchable()
          ->sortable(),

        // Columna de estado con ícono verde/rojo
        IconColumn::make('activo')
          ->label('Estado')
          ->boolean()
          ->trueIcon(Heroicon::OutlinedCheckCircle)
          ->falseIcon(Heroicon::OutlinedXCircle)
          ->trueColor('success')
          ->falseColor('danger'),

        TextColumn::make('created_at')
          ->label('Fecha de registro')
          ->dateTime('d M Y H:i')
          ->sortable(),
      ])

      ->searchPlaceholder('Buscar usuarios')

      ->filters([
        // Filtrar por rol
        SelectFilter::make('rol')
          ->label('Rol')
          ->options([
            'admin'       => 'Administrador',
            'organizador' => 'Organizador',
            'comprador'   => 'Comprador',
          ]),

        // Filtrar por estado
        SelectFilter::make('activo')
          ->label('Estado')
          ->options([
            '1' => 'Activos',
            '0' => 'Inactivos',
          ]),
      ])

      ->filtersFormColumns(2)

      ->recordActions([
        EditAction::make(),
        DeleteAction::make()
          ->before(function (User $record, DeleteAction $action) {
            // No permitir eliminar al propio usuario autenticado
            if ($record->id === Auth::id()) {
              Notification::make()
                ->danger()
                ->title('No se puede eliminar')
                ->body('No puedes eliminar tu propia cuenta.')
                ->send();

              $action->cancel();
            }
          }),
      ])

      ->groupedBulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ])

      ->headerActions([
        \Filament\Actions\ExportAction::make()
          ->label('Exportar')
          ->exporter(\App\Filament\Exporters\UsuarioExporter::class),
      ])

      ->defaultSort('created_at', 'desc');
  }
}
