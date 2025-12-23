<?php

namespace App\DataTables\Tables;

use App\DataTables\Contracts\DataTableInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AccountTable implements DataTableInterface
{
    /**
     * Return a query builder for the Account model.
     */
    public function query(): Builder
    {
        return Account::query()
            ->where('user_id', Auth::id())
            ->select([
                'id',
                'account_name',
            ]);
    }

    public function searchableColumns(): array
    {
        return ['account_name'];
    }

    public function filterableColumns(): array
    {
        return [];
    }
}
