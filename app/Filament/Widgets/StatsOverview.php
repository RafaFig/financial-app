<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $expenses = self::getExpensesFromLoggedUser();
        $currentMonthlyAmount = $expenses->sum('monthly_amount');
        $formattedTotal = number_format($currentMonthlyAmount, 2, '.', '');

        return [
            Stat::make('Despesas', "R$ {$formattedTotal}")
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->chartColor('danger')
                ->color('danger')
                ->description("Valor a ser pago no mês atual."),
            Stat::make('Bounce rate', '21%')
                ->description('7% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }

    private static function getExpensesFromLoggedUser(): Collection
    {
        return Expense::query()
            ->whereHas('payers', fn($query) => $query->where('users.id', Auth::id()))
            ->whereNotIn('status', ['cancelled', 'paid'])
            ->get();
    }

    private static function getExpenseTotalMonthly()
    {

    }
}
