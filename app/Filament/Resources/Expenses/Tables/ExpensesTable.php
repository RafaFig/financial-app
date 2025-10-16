<?php

namespace App\Filament\Resources\Expenses\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Despesas')
            ->description('Valores destinados ao pagamento de custos e obrigações, como contas, compras, serviços ou investimentos. Representam a saída de recursos financeiros.')
            ->emptyStateHeading('Sem despesas ainda...')
            ->emptyStateDescription('Ainda não foi cadastrada nenhuma despesas')
            ->emptyStateIcon(Heroicon::XCircle)
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar despesa')
                    ->url('./expenses/create')
                    ->icon(Heroicon::Plus)
                    ->button(),
            ])
            ->deferLoading()
            ->columns([
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('account.name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('payment_method')
                    ->searchable(),
                TextColumn::make('periodicity')
                    ->searchable(),
                TextColumn::make('installments')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Data de criação')
                    ->dateTime()
                    ->since('America/Sao_Paulo')
                    ->isoDateTimeTooltip(timezone: 'America/Sao_Paulo')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Última atualização')
                    ->dateTime()
                    ->since('America/Sao_Paulo')
                    ->isoDateTimeTooltip(timezone: 'America/Sao_Paulo')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'canceled' => 'Cancelado',
                        'paid' => 'Pago',
                        'partial' => 'Pago parcial',
                    ])
//                    ->query(fn(Builder $query) => $query->whereNotIn('status', ['paid', 'canceled']))
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
