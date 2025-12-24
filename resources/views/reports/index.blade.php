<x-app-layout>
    @section('page-title', 'Reports')

    <div x-data="reportManager()" x-init="init()" class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-primary">Financial Reports</h2>
                <p class="text-secondary mt-1">Analyze your income and expenses</p>
            </div>
        </div>

        <!-- Global Filters -->
        <div class="bg-white rounded-lg border border-border p-4">
            <h3 class="text-sm font-semibold text-primary mb-4">Report Filters</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">Date From</label>
                    <input 
                        type="date"
                        x-model="globalFilters.date_from"
                        @change="updateFilters()"
                        class="w-full border border-border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">Date To</label>
                    <input 
                        type="date"
                        x-model="globalFilters.date_to"
                        @change="updateFilters()"
                        class="w-full border border-border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">Account</label>
                    <select 
                        x-model="globalFilters.account_id"
                        @change="updateFilters()"
                        class="w-full border border-border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
                        <option value="">All Accounts</option>
                        @foreach($accounts as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary mb-2">Category</label>
                    <select 
                        x-model="globalFilters.category_id"
                        @change="updateFilters()"
                        class="w-full border border-border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4 flex space-x-2">
                <button 
                    @click="setCurrentMonth()"
                    class="px-3 py-1 text-sm border border-border rounded-lg hover:bg-background-secondary transition-colors">
                    Current Month
                </button>
                <button 
                    @click="setLastMonth()"
                    class="px-3 py-1 text-sm border border-border rounded-lg hover:bg-background-secondary transition-colors">
                    Last Month
                </button>
                <button 
                    @click="setCurrentYear()"
                    class="px-3 py-1 text-sm border border-border rounded-lg hover:bg-background-secondary transition-colors">
                    Current Year
                </button>
                <button 
                    @click="resetFilters()"
                    class="px-3 py-1 text-sm text-danger border border-danger rounded-lg hover:bg-danger-light transition-colors">
                    Reset
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-border">
            <nav class="-mb-px flex space-x-8">
                <button 
                    @click="activeTab = 'income'"
                    :class="activeTab === 'income' ? 'border-primary-500 text-primary-600' : 'border-transparent text-secondary hover:text-primary hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Income Report
                </button>
                <button 
                    @click="activeTab = 'expense'"
                    :class="activeTab === 'expense' ? 'border-primary-500 text-primary-600' : 'border-transparent text-secondary hover:text-primary hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Expense Report
                </button>
            </nav>
        </div>

        <!-- Income Tab -->
        <div x-show="activeTab === 'income'" x-transition class="space-y-6">

            <!-- Tab Header with Export Button -->
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-primary">Income Summary</h3>
                <button 
                    @click="exportIncomeReport()"
                    class="flex items-center space-x-2 px-4 py-2 bg-success text-white rounded-lg hover:bg-success-dark transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export Income Report</span>
                </button>
            </div>

            <!-- Income Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg border border-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-secondary">Total Income</p>
                            <h3 class="text-2xl font-bold text-primary mt-1">$<span x-text="incomeStats.total_income">0.00</span></h3>
                        </div>
                        <div class="w-12 h-12 bg-success-light rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-secondary">Transactions</p>
                            <h3 class="text-2xl font-bold text-primary mt-1" x-text="incomeStats.transaction_count">0</h3>
                        </div>
                        <div class="w-12 h-12 bg-info-light rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Top Categories -->
            <div class="bg-white rounded-lg border border-border p-6">
                <h3 class="text-lg font-semibold text-primary mb-4">Top Income Categories</h3>
                <div class="space-y-3">
                    <template x-for="category in incomeStats.top_categories" :key="category.id">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-secondary" x-text="category.name"></span>
                            <span class="text-sm font-semibold text-success">$<span x-text="parseFloat(category.total).toFixed(2)"></span></span>
                        </div>
                    </template>
                    <template x-if="incomeStats.top_categories.length === 0">
                        <p class="text-sm text-tertiary">No data available</p>
                    </template>
                </div>
            </div>

            <!-- Income DataTable -->
            <x-data-table 
                id="income-table"
                type="income"
                :columns="[
                    [
                        'label' => 'Id',
                        'field' => 'id',
                    ],
                    [
                        'label' => 'Category',
                        'field' => 'category.category_name',
                    ],
                    [
                        'label' => 'Account Name',
                        'field' => 'account.account_name',
                    ],
                    [
                        'label' => 'Amount',
                        'field' => 'amount',
                    ],
                    [
                        'label' => 'Date',
                        'field' => 'date',
                    ],
                ]"
                :filters="[
                    ['type' => 'select', 'name' => 'account_id', 'label' => 'Account', 'placeholder' => 'All Accounts', 'options' => $accounts],
                    ['type' => 'select', 'name' => 'category_id', 'label' => 'Category', 'placeholder' => 'All Categories', 'options' => $categories],
                    ['type' => 'select', 'name' => 'status', 'label' => 'Status', 'placeholder' => 'All', 'options' => ['pending' => 'Pending', 'completed' => 'Completed']],
                    ['type' => 'daterange', 'name' => 'date', 'label' => 'Date Range'],
                ]"
                :searchable="true"
                :exportable="true"
                :per-page="15">
                Income Transactions
            </x-data-table>
        </div>

        <!-- Expense Tab -->
        <div x-show="activeTab === 'expense'" x-transition class="space-y-6">
            <!-- Tab Header with Export Button -->
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-primary">Income Summary</h3>
                <button 
                    @click="exportExpenseReport()"
                    class="flex items-center space-x-2 px-4 py-2 bg-success text-white rounded-lg hover:bg-success-dark transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export Expense Report</span>
                </button>
            </div>
            
            <!-- Expense Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg border border-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-secondary">Total Expenses</p>
                            <h3 class="text-2xl font-bold text-primary mt-1">$<span x-text="expenseStats.total_expense">0.00</span></h3>
                        </div>
                        <div class="w-12 h-12 bg-danger-light rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-secondary">Transactions</p>
                            <h3 class="text-2xl font-bold text-primary mt-1" x-text="expenseStats.transaction_count">0</h3>
                        </div>
                        <div class="w-12 h-12 bg-warning-light rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="bg-white rounded-lg border border-border p-6">
                <h3 class="text-lg font-semibold text-primary mb-4">Top Expense Categories</h3>
                <div class="space-y-3">
                    <template x-for="category in expenseStats.top_categories" :key="category.id">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-secondary" x-text="category.name"></span>
                            <span class="text-sm font-semibold text-danger">$<span x-text="parseFloat(category.total).toFixed(2)"></span></span>
                        </div>
                    </template>
                    <template x-if="expenseStats.top_categories.length === 0">
                        <p class="text-sm text-tertiary">No data available</p>
                    </template>
                </div>
            </div>

            <!-- Expense DataTable -->
            <x-data-table 
                id="expense-table"
                type="expense"
                :columns="[
                    [
                        'label' => 'Id',
                        'field' => 'id',
                    ],
                    [
                        'label' => 'Category',
                        'field' => 'category.category_name',
                    ],
                    [
                        'label' => 'Account Name',
                        'field' => 'account.account_name',
                    ],
                    [
                        'label' => 'Amount',
                        'field' => 'amount',
                    ],
                    [
                        'label' => 'Date',
                        'field' => 'date',
                    ],
                ]"
                :filters="[
                    ['type' => 'select', 'name' => 'account_id', 'label' => 'Account', 'placeholder' => 'All Accounts', 'options' => $accounts],
                    ['type' => 'select', 'name' => 'category_id', 'label' => 'Category', 'placeholder' => 'All Categories', 'options' => $categories],
                    ['type' => 'select', 'name' => 'status', 'label' => 'Status', 'placeholder' => 'All', 'options' => ['pending' => 'Pending', 'completed' => 'Completed']],
                    ['type' => 'daterange', 'name' => 'date', 'label' => 'Date Range'],
                ]"
                :searchable="true"
                :exportable="true"
                :per-page="15">
                Expense Transactions
            </x-data-table>
        </div>
    </div>

    @push('scripts')
    <script>
        function reportManager() {
            return {
                activeTab: 'income',
                globalFilters: {
                    date_from: '',
                    date_to: '',
                    account_id: '',
                    category_id: ''
                },
                incomeStats: {
                    total_income: '0.00',
                    transaction_count: 0,
                    top_categories: []
                },
                expenseStats: {
                    total_expense: '0.00',
                    transaction_count: 0,
                    top_categories: []
                },

                init() {
                    this.setCurrentMonth();
                },

                async fetchIncomeStats() {
                    const params = new URLSearchParams({
                        date_from: this.globalFilters.date_from,
                        date_to: this.globalFilters.date_to,
                        account_id: this.globalFilters.account_id,
                        category_id: this.globalFilters.category_id,
                    });

                    try {
                        const response = await fetch(`{{ route('reports.income.stats') }}?${params}`);
                        this.incomeStats = await response.json();
                    } catch (error) {
                        console.error('Error fetching income stats:', error);
                    }
                },

                async fetchExpenseStats() {
                    const params = new URLSearchParams({
                        date_from: this.globalFilters.date_from,
                        date_to: this.globalFilters.date_to,
                        account_id: this.globalFilters.account_id,
                        category_id: this.globalFilters.category_id,
                    });

                    try {
                        const response = await fetch(`{{ route('reports.expense.stats') }}?${params}`);
                        this.expenseStats = await response.json();
                    } catch (error) {
                        console.error('Error fetching expense stats:', error);
                    }
                },

                updateFilters() {
                    this.fetchIncomeStats();
                    this.fetchExpenseStats();
                },

                setCurrentMonth() {
                    const now = new Date();
                    const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
                    const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);
                    
                    this.globalFilters.date_from = firstDay.toISOString().split('T')[0];
                    this.globalFilters.date_to = lastDay.toISOString().split('T')[0];
                    this.updateFilters();
                },

                setLastMonth() {
                    const now = new Date();
                    const firstDay = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                    const lastDay = new Date(now.getFullYear(), now.getMonth(), 0);
                    
                    this.globalFilters.date_from = firstDay.toISOString().split('T')[0];
                    this.globalFilters.date_to = lastDay.toISOString().split('T')[0];
                    this.updateFilters();
                },

                setCurrentYear() {
                    const now = new Date();
                    this.globalFilters.date_from = `${now.getFullYear()}-01-01`;
                    this.globalFilters.date_to = `${now.getFullYear()}-12-31`;
                    this.updateFilters();
                },

                resetFilters() {
                    this.globalFilters = {
                        date_from: '',
                        date_to: '',
                        account_id: '',
                        category_id: ''
                    };
                    this.updateFilters();
                },

                exportIncomeReport() {
                    const params = new URLSearchParams({
                        date_from: this.globalFilters.date_from,
                        date_to: this.globalFilters.date_to,
                        account_id: this.globalFilters.account_id,
                        category_id: this.globalFilters.category_id,
                        type: 'income',
                    });
                    window.location.href = `{{ route('reports.income.export') }}?${params}`;
                },

                exportExpenseReport() {
                    const params = new URLSearchParams({
                        date_from: this.globalFilters.date_from,
                        date_to: this.globalFilters.date_to,
                        account_id: this.globalFilters.account_id,
                        category_id: this.globalFilters.category_id,
                        type: 'expense',
                    });
                    window.location.href = `{{ route('reports.expense.export') }}?${params}`;
                }
            }
        }
    </script>
    @endpush
</x-app-layout>