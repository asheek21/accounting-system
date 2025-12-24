<?php

namespace App\Actions;

use App\Enums\TransactionTypeEnum;
use App\Models\Transaction;

class GetRecentTransactionsAction
{
    public function execute(int $userId)
    {
        return Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->with(['account', 'category'])
            ->orderByDesc('date')
            ->limit(10)
            ->get();
    }

    public function getTotalAmount(int $userId, TransactionTypeEnum $type): float
    {
        return Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('transaction_type', $type)
            ->sum('amount');
    }
}
