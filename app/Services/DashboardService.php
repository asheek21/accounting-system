<?php

namespace App\Services;

use App\Actions\GetAccountStatsAction;
use App\Actions\GetCategoryStatsAction;
use App\Actions\GetMonthlyComparisonAction;
use App\Actions\GetRecentTransactionsAction;
use App\Enums\TransactionTypeEnum;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function __construct(
        protected GetAccountStatsAction $accountStatsAction,
        protected GetCategoryStatsAction $categoryStatsAction,
        protected GetRecentTransactionsAction $recentTransactionsAction,
        protected GetMonthlyComparisonAction $monthlyComparisonAction
    ) {}

    public function getDashboardData(): array
    {
        $userId = Auth::id();

        $totalIncome = $this->recentTransactionsAction->getTotalAmount($userId, TransactionTypeEnum::income);
        $totalExpense = $this->recentTransactionsAction->getTotalAmount($userId, TransactionTypeEnum::expense);
        $netBalance = $totalIncome - $totalExpense;

        return [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netBalance' => $netBalance,
            'accountStats' => $this->accountStatsAction->execute($userId),
            'categoryStats' => $this->categoryStatsAction->execute($userId),
            'recentTransactions' => $this->recentTransactionsAction->execute($userId),
            'monthlyComparison' => $this->monthlyComparisonAction->execute($userId),
        ];
    }
}
