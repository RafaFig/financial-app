<?php

namespace App\Filament\Resources\Incomes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IncomeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('account.name')
                    ->label('Account'),
                TextEntry::make('installment_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('net_amount')
                    ->numeric(),
                TextEntry::make('periodicity'),
            ]);
    }
}
