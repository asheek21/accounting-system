<?php

namespace App\DataTables\Tables;

use App\DataTables\Contracts\DataTableInterface;
use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CategoryTable implements DataTableInterface
{
    /**
     * Return a query builder for the Account model.
     */
    public function query(): Builder
    {
        return Category::query()
            ->where('user_id', Auth::id())
            ->select([
                'id',
                'category_name',
            ]);
    }

    public function searchableColumns(): array
    {
        return ['category_name'];
    }
}
