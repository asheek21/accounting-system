<?php

namespace App\DataTables\Tables;

use App\DataTables\Contracts\DataTableInterface;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TransactionTable implements DataTableInterface
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
}
