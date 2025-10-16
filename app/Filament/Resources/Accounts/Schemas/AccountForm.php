<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        $mask = '';
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
            ]);
    }
}
