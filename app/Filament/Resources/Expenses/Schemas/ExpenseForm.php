<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Icon;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Principais informações')
                    ->description('Principais informações relacionadas a despesa. Quanto mais informações preencher, melhor será para identificar no futuro.')
                    ->icon(Heroicon::OutlinedInformationCircle)
                    ->iconColor('primary')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
                        TextInput::make('total_amount')
                            ->label('Valor total')
                            ->prefix('R$')
                            ->required()
                            ->numeric(),
                        Select::make('payment_method')
                            ->label('Método de pagamento')
                            ->required()
                            ->default('unique')
                            ->live()
                            ->native(false)
                            ->options([
                                'unique' => 'Único',
                                'fixed' => 'Fixo',
                                'installment' => 'Parcelado'
                            ]),
                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->default('pending')
                            ->native(false)
                            ->options([
                                'pending' => 'Pendente',
                                'canceled' => 'Cancelado',
                                'partial' => 'Pago parcial',
                                'paid' => 'Pago',
                            ]),
                        Select::make('periodicity')
                            ->label('Periodicidade')
                            ->required()
                            ->default('monthly')
                            ->native(false)
                            ->options([
                                'daily' => 'Diário',
                                'weekly' => 'Semanal',
                                'monthly' => 'Mensal',
                                'yearly' => 'Anual',
                            ]),
                        TextInput::make('installments')
                            ->label('Parcelas')
                            ->required()
                            ->hidden(fn(Get $get) => $get('payment_method') !== 'installment')
                            ->maxValue(24)
                            ->numeric(),
                        DatePicker::make('start_date')
                            ->label('Data de início')
                            ->hidden(fn(Get $get) => $get('payment_method') !== 'installment')
                            ->required(),
                    ]),
                Section::make()
                    ->description('Informações sobre a categoria e a qual conta a despesa se refere.')
                    ->icon(Heroicon::ArrowsUpDown)
                    ->iconColor('primary')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('expense_id')
                            ->label('Pagador(es)')
                            ->placeholder('Selecione ao menos 1 pagador')
                            ->multiple()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn($record) => explode(' ', $record->name)[0])
                            ->relationship('payers', 'name')
                            ->required(),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->placeholder('Selecione uma categoria')
                            ->relationship('category', 'name', modifyQueryUsing: fn(Builder $query) => $query->where('type', 'expense'))
                            ->belowContent([
                                Text::make('Apenas despesas')
                                    ->size(TextSize::ExtraSmall)
                                    ->color('gray')
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('account_id')
                            ->label('Conta')
                            ->placeholder('Selecione uma conta')
                            ->relationship('account', 'name')
                            ->native(false)
                            ->required(),
                    ])
            ]);
    }
}
