<?php

namespace App\Actions;

use App\Enums\TransactionTypeEnum;
use App\Models\Category;

class GetCategoryStatsAction
{
    public function execute(int $userId)
    {
        return Category::where('user_id', $userId)
            ->withSum([
                'transactions as income' => fn ($q) => $q->where('transaction_type', TransactionTypeEnum::income->value),
                'transactions as expense' => fn ($q) => $q->where('transaction_type', TransactionTypeEnum::expense->value),
            ], 'amount')
            ->get()
            ->map(fn ($category) => [
                'id' => $category->id,
                'name' => $category->category_name,
                'income' => $category->income ?? 0,
                'expense' => $category->expense ?? 0,
            ]);
    }
}
