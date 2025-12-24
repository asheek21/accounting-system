<?php

namespace App\DataTables\Providers;

use App\DataTables\DataTableRegistry;
use App\DataTables\Tables\AccountTable;
use App\DataTables\Tables\CategoryTable;
use App\DataTables\Tables\ExpenseTable;
use App\DataTables\Tables\IncomeTable;
use App\DataTables\Tables\TransactionTable;
use Illuminate\Support\ServiceProvider;

class DataTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $registry = new DataTableRegistry;

        $registry->register('account', AccountTable::class);
        $registry->register('category', CategoryTable::class);
        $registry->register('transaction', TransactionTable::class);
        $registry->register('income', IncomeTable::class);
        $registry->register('expense', ExpenseTable::class);

        $this->app->instance(DataTableRegistry::class, $registry);
    }
}
