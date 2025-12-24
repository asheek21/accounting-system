<?php

namespace App\Actions;

use App\Enums\TransactionTypeEnum;
use App\Models\Account;

class GetAccountStatsAction
{
    public function execute(int $userId)
    {
        return Account::where('user_id', $userId)
            ->withSum([
                'transactions as income' => fn ($q) => $q->where('transaction_type', TransactionTypeEnum::income->value),
                'transactions as expense' => fn ($q) => $q->where('transaction_type', TransactionTypeEnum::expense->value),
            ], 'amount')
            ->get()
            ->map(fn ($account) => [
                'id' => $account->id,
                'name' => $account->account_name,
                'income' => $account->income ?? 0,
                'expense' => $account->expense ?? 0,
                'balance' => ($account->income ?? 0) - ($account->expense ?? 0),
            ]);
    }
}
