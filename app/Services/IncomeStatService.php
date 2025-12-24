<?php

namespace App\Services;

use App\Enums\TransactionTypeEnum;
use App\Models\Transaction;
use App\traits\DateFilterTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomeStatService
{
    use DateFilterTrait;

    public function execute(Request $request): array
    {
        try {
            $query = Transaction::query()
                ->whereHas('account', function ($q) {
                    $q->where('user_id', Auth::id());
                })
                ->where('transaction_type', TransactionTypeEnum::income);

            // Apply date filter
            $this->applyDateFilter($query, $request);

            if ($request->filled('account_id')) {
                $query->where('account_id', $request->account_id);
            }
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $totalIncome = $query->sum('amount');
            $transactionCount = $query->count();

            /** @var Collection<int, object{id:int, category_name:string, total:float}> $rows */
            $rows = Transaction::query()
                ->whereHas('account', function ($q) {
                    $q->where('user_id', Auth::id());
                })
                ->where('transaction_type', TransactionTypeEnum::income)
                ->when($request->filled('date_from'), function ($q) use ($request) {
                    $q->whereDate('date', '>=', $request->date_from);
                })
                ->when($request->filled('date_to'), function ($q) use ($request) {
                    $q->whereDate('date', '<=', $request->date_to);
                })
                ->when($request->filled('account_id'), function ($q) use ($request) {
                    $q->where('account_id', $request->account_id);
                })
                ->join('categories', 'categories.id', '=', 'transactions.category_id')
                ->select(
                    'categories.id',
                    'categories.category_name',
                    DB::raw('SUM(transactions.amount) as total')
                )
                ->groupBy('categories.id', 'categories.category_name')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            $topCategories = $rows
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->category_name ?? 'Uncategorized',
                        'total' => $item->total,
                    ];
                });

            return [
                'total_income' => number_format($totalIncome, 2),
                'transaction_count' => $transactionCount,
                'top_categories' => $topCategories,
            ];

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
