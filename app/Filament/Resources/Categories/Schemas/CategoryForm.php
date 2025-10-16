<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->required()
                    ->default('income')
                    ->native(false)
                    ->options([
                        'income' => 'Entrada',
                        'expense' => 'Saída',
                    ])
            ]);
    }
}
