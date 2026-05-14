<?php

namespace App\Filament\Resources\Eventos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(100)
                    ->helperText('Máximo 100 caracteres · visible para el comprador'),

                Select::make('recinto_id')
                    ->label('Recinto')
                    ->relationship('recinto', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('El recinto quedará vinculado a este evento'),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(6)
                    ->columnSpanFull()
                    ->helperText('Opcional · Se muestra en la página pública del evento'),

                DateTimePicker::make('fecha_evento')
                    ->label('Fecha del evento')
                    ->required(),

                Select::make('categoria')
                    ->label('Categoría')
                    ->options([
                        'concierto' => 'Concierto',
                        'deporte' => 'Deporte',
                        'teatro' => 'Teatro',
                        'festival' => 'Festival',
                        'otro' => 'Otro',
                    ])
                    ->default('concierto')
                    ->required(),

                TextInput::make('imagen_url')
                    ->label('URL de imagen')
                    ->url()
                    ->helperText('Opcional · Imagen visible en la landing y detalle del evento'),

                Hidden::make('usuario_id')
                    ->default(auth()->id()),

                Hidden::make('estado')
                    ->default('borrador'),
            ])
            ->columns(2);
    }
}