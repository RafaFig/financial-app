<?php

namespace App\Filament\Resources\Incomes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\FusedGroup;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Principais informações')
                    ->description('Principais informações acerca da despesa.')
                    ->icon(Heroicon::InformationCircle)
                    ->columns(2)
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
                        TextInput::make('amount')
                            ->label('Valor total')
                            ->prefix('R$')
                            ->required()
                            ->numeric(),
                        TextInput::make('net_amount')
                            ->label('Valor líquido')
                            ->prefix('R$')
                            ->required()
                            ->numeric(),
                        Select::make('periodicity')
                            ->label('Periodicidade')
                            ->required()
                            ->default('monthly')
                            ->options([
                                'daily' => 'Diário',
                                'weekly' => 'Semanal',
                                'monthly' => 'Mensal',
                                'yearly' => 'Anual',
                            ])
                            ->native(false)
                    ]),
                Section::make('Relacionamentos')
                    ->description('Informações sobre a categoria e a qual conta a receita se refere')
                    ->icon(Heroicon::ArrowsUpDown)
                    ->columns(1)
                    ->schema([
                        Select::make('account_id')
                            ->label('Conta')
                            ->relationship('account', 'name')
                            ->native(false)
                            ->required(),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->native(false)
                            ->required(),
                    ])
            ])
            ->columns(3);
    }
}
