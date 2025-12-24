<?php

namespace App\DataTables\Tables;

use App\DataTables\Contracts\DataTableInterface;
use App\DataTables\Contracts\ExportableColumnInterface;
use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ExpenseTable implements DataTableInterface, ExportableColumnInterface
{
    /**
     * Return a query builder for the Account model.
     */
    public function query(): Builder
    {
        return Transaction::query()
            ->whereHas('account', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('transaction_type', TransactionTypeEnum::expense)
            ->with(['category' => function ($q) {
                $q->select('id', 'category_name');
            }, 'account' => function ($q) {
                $q->select('id', 'account_name');
            }])
            ->select([
                'id',
                'category_id',
                'account_id',
                'amount',
                'date',
                'description',
                'transaction_type',
            ]);
    }

    public function searchableColumns(): array
    {
        return ['amount', 'date'];
    }

    public function filterableColumns(): array
    {
        return [
            'transaction_type' => 'exact',
            'category_id' => 'exact',
            'account_id' => 'exact',
            'date' => 'daterange',
        ];
    }

    public function columns(): array
    {
        return [
            'id' => 'ID',
            'category.category_name' => 'Category',
            'account.account_name' => 'Account',
            'amount' => 'Amount',
            'date' => 'Date',
            'description' => 'Description',
        ];
    }
}
