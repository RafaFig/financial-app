<?php

namespace App\Filament\Resources\Payers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PayerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
