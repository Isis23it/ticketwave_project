<?php

namespace App\Filament\Exporters;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UsuarioExporter extends Exporter
{
  protected static ?string $model = User::class;

  public static function getColumns(): array
  {
    return [
      ExportColumn::make('id')->label('ID'),
      ExportColumn::make('name')->label('Nombre'),
      ExportColumn::make('email')->label('Correo'),
      ExportColumn::make('rol')->label('Rol'),
      ExportColumn::make('activo')->label('Activo'),
      ExportColumn::make('created_at')->label('Fecha de registro'),
    ];
  }

  public static function getCompletedNotificationBody(Export $export): string
  {
    $count = number_format($export->successful_rows);
    return "Se exportaron {$count} usuarios correctamente.";
  }
}
