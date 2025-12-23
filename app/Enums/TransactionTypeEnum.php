<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case expense = 'expense';
    case income = 'income';
}
