<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExpenseInfolist
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
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('total_amount')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('payment_method'),
                TextEntry::make('periodicity'),
                TextEntry::make('installments')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->date(),
            ]);
    }
}
