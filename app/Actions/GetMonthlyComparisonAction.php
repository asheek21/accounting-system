<?php

namespace App\Actions;

use App\Enums\TransactionTypeEnum;
use App\Models\Transaction;

class GetMonthlyComparisonAction
{
    public function execute(int $userId): array
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        $currentIncome = $this->getMonthlyAmount($userId, TransactionTypeEnum::income, $currentMonth, $currentYear);
        $lastIncome = $this->getMonthlyAmount($userId, TransactionTypeEnum::income, $lastMonth, $lastMonthYear);

        $currentExpense = $this->getMonthlyAmount($userId, TransactionTypeEnum::expense, $currentMonth, $currentYear);
        $lastExpense = $this->getMonthlyAmount($userId, TransactionTypeEnum::expense, $lastMonth, $lastMonthYear);

        return [
            'income' => $this->calculateTrend($currentIncome, $lastIncome),
            'expense' => $this->calculateTrend($currentExpense, $lastExpense),
            'currentMonthIncome' => $currentIncome,
            'currentMonthExpense' => $currentExpense,
        ];
    }

    private function getMonthlyAmount(int $userId, TransactionTypeEnum $type, int $month, int $year): float
    {
        return Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('transaction_type', $type)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('amount');
    }

    private function calculateTrend(float $current, float $previous): array
    {
        if ($previous == 0) {
            return [
                'percentage' => $current > 0 ? '100%' : '0%',
                'direction' => $current > 0 ? 'up' : 'neutral',
            ];
        }

        $change = (($current - $previous) / $previous) * 100;
        $direction = $change > 0 ? 'up' : ($change < 0 ? 'down' : 'neutral');

        return [
            'percentage' => abs(round($change, 1)).'%',
            'direction' => $direction,
        ];
    }
}
