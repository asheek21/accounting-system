<x-app-layout>
    @section('page-title', 'Dashboard')

    <div class="space-y-8">
        <!-- Page Header -->
        <div>
            <h2 class="text-2xl font-bold text-primary">Dashboard</h2>
            <p class="text-secondary mt-1">Overview of your financial activities</p>
        </div>

        <!-- Overall Summary -->
        <div>
            <h3 class="text-lg font-semibold text-primary mb-4">Overall Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-stat-card 
                    title="Total Income"
                    value="${{ number_format($totalIncome, 2) }}"
                    color="success"
                    subtitle="All time"
                    :trend="$monthlyComparison['income']['percentage'] . ' from last month'"
                    :trend-direction="$monthlyComparison['income']['direction']"
                    :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6\'></path></svg>'"
                />

                <x-stat-card 
                    title="Total Expenses"
                    value="${{ number_format($totalExpense, 2) }}"
                    color="danger"
                    subtitle="All time"
                    :trend="$monthlyComparison['expense']['percentage'] . ' from last month'"
                    :trend-direction="$monthlyComparison['expense']['direction']"
                    :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6\'></path></svg>'"
                />

                <x-stat-card 
                    title="Net Balance"
                    value="${{ number_format($netBalance, 2) }}"
                    :color="$netBalance >= 0 ? 'success' : 'danger'"
                    subtitle="Income - Expenses"
                    :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg>'"
                />
            </div>
        </div>

        <!-- Account-wise Statistics -->
        @if($accountStats->isNotEmpty())
        <div>
            <h3 class="text-lg font-semibold text-primary mb-4">By Account</h3>
            <div class="space-y-6">
                @foreach($accountStats as $account)
                <div class="bg-white rounded-lg border border-border p-6">
                    <h4 class="text-md font-semibold text-primary mb-4">{{ $account['name'] }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-stat-card 
                            title="Income"
                            value="${{ number_format($account['income'], 2) }}"
                            color="success"
                        />

                        <x-stat-card 
                            title="Expenses"
                            value="${{ number_format($account['expense'], 2) }}"
                            color="danger"
                        />

                        <x-stat-card 
                            title="Balance"
                            value="${{ number_format($account['balance'], 2) }}"
                            :color="$account['balance'] >= 0 ? 'info' : 'warning'"
                        />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Category-wise Statistics -->
        @if($categoryStats->isNotEmpty())
        <div>
            <h3 class="text-lg font-semibold text-primary mb-4">By Category</h3>
            <div class="space-y-6">
                @foreach($categoryStats as $category)
                <div class="bg-white rounded-lg border border-border p-6">
                    <h4 class="text-md font-semibold text-primary mb-4">{{ $category['name'] }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-stat-card 
                            title="Income"
                            value="${{ number_format($category['income'], 2) }}"
                            color="success"
                        />

                        <x-stat-card 
                            title="Expenses"
                            value="${{ number_format($category['expense'], 2) }}"
                            color="danger"
                        />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recent Transactions -->
        @if($recentTransactions->isNotEmpty())
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-primary">Recent Transactions</h3>
                <a href="{{ route('transactions.index') }}" class="text-sm text-primary-600 hover:text-primary-700">
                    View All →
                </a>
            </div>
            <div class="bg-white rounded-lg border border-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-background-secondary">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase">Account</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase">Type</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-secondary uppercase">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($recentTransactions as $transaction)
                            <tr class="hover:bg-background-secondary transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary">
                                    {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-primary">
                                    {{ $transaction->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary">
                                    {{ $transaction->account->account_name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary">
                                    {{ $transaction->category->category_name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full uppercase {{ $transaction->transaction_type === 'income' ? 'bg-success-light text-success-dark' : 'bg-danger-light text-danger-dark' }}">
                                        {{ $transaction->transaction_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold {{ $transaction->transaction_type === 'income' ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($transaction->amount, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Empty State -->
        @if($accountStats->isEmpty() && $categoryStats->isEmpty() && $recentTransactions->isEmpty())
        <div class="bg-white rounded-lg border border-border p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <h3 class="text-lg font-semibold text-primary mb-2">No Data Yet</h3>
            <p class="text-secondary mb-6">Get started by adding your first account and transaction.</p>
            <div class="flex items-center justify-center space-x-4">
                <a href="{{ route('accounts.create') }}" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                    Add Account
                </a>
                <a href="{{ route('transactions.create') }}" class="px-4 py-2 border border-border rounded-lg hover:bg-background-secondary transition-colors">
                    Add Transaction
                </a>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
