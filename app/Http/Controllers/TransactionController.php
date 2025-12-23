<?php

namespace App\Http\Controllers;

use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $accounts = Account::pluck('account_name', 'id')->toArray();
        $categories = Category::pluck('category_name', 'id')->toArray();
        $transactionTypeEnums = TransactionTypeEnum::cases();
        $transactionTypes = [];

        foreach ($transactionTypeEnums as $enum) {
            $transactionTypes[$enum->value] = $enum->label();
        }

        return view('transaction.index', compact('accounts', 'categories', 'transactionTypes'));
    }

    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
