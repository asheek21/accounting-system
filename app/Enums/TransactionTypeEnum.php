<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case expense = 'expense';
    case income = 'income';

    public function label(): string
    {
        return match ($this) {
            self::expense => 'Expense',
            self::income => 'Income',
        };
    }
}
