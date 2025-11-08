<?php

namespace App\Filament\Resources\Incomes\Tables;

use App\Models\Account;
use App\Models\Category;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IncomesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Receitas')
            ->description('Valores recebidos por meio de vendas, serviços, rendimentos ou outras fontes de ganho. Representam a entrada de recursos financeiros.')
            ->emptyStateHeading('Sem receitas ainda...')
            ->emptyStateDescription('Ainda não foi cadastrada nenhuma receita')
            ->emptyStateIcon(Heroicon::XCircle)
            ->emptyStateActions([
                Action::make('create')
                    ->label('Criar receita')
                    ->url('./incomes/create')
                    ->icon(Heroicon::Plus)
                    ->button(),
            ])
            ->deferLoading()
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->icon(Heroicon::ArrowTrendingUp)
                    ->iconColor('success')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor total')
                    ->prefix('R$ ')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('net_amount')
                    ->label('Valor líquido')
                    ->prefix('R$ ')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                TextColumn::make('periodicity')
                    ->label('Periodicidade')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'daily' => 'Diário',
                        'weekly' => 'Semanal',
                        'monthly' => 'Mensal',
                        'yearly' => 'Anual',
                    }),
                TextColumn::make('category')
                    ->label('Categoria')
                    ->badge()
                    ->color(fn($state) => $state->type == 'income' ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => ucfirst($state->name))
                    ->searchable(),
                TextColumn::make('account.name')
                    ->label('Conta')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
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
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
