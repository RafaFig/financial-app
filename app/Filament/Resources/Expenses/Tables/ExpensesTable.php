<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Models\Expense;
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
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->searchable(),
                TextColumn::make('account.name')
                    ->label('Conta')
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Valor total')
                    ->prefix('R$ ')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'canceled' => 'Cancelado',
                        'partial' => 'Pago parcial',
                        'paid' => 'Pago',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'danger',
                        'canceled' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                    })
                    ->badge()
                    ->searchable(),
                TextColumn::make('payment_method')
                    ->label('Frequência')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'unique' => 'Único',
                        'fixed' => 'Fixo',
                        'installment' => 'Parcelado'
                    })
                    ->searchable(),
                TextColumn::make('periodicity')
                    ->label('Periodicidade')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'daily' => 'Diária',
                        'weekly' => 'Semanal',
                        'monthly' => 'Mensal',
                        'yearly' => 'Anual',
                    })
                    ->searchable(),
                TextColumn::make('installments')
                    ->label('Parcelas')
                    ->numeric()
                    ->state(function (Expense $expense) {
                        $amountMonthly = $expense->total_amount / $expense->installments;
                        return "{$expense->installments}x de R$ {$amountMonthly}";
                    })
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Data de início')
                    ->dateTime()
                    ->since('America/Sao_Paulo')
                    ->isoDateTimeTooltip(timezone: 'America/Sao_Paulo')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
