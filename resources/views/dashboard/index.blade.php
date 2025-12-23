<x-app-layout>
    @section('page-title', 'Dashboard')

    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Balance -->
            <div class="bg-white rounded-lg border border-border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary">Total Balance</p>
                        <h3 class="text-2xl font-bold text-primary mt-1">$12,345.67</h3>
                    </div>
                    <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-success">+12.5%</span>
                    <span class="text-tertiary ml-2">from last month</span>
                </div>
            </div>

            <!-- Total Accounts -->
            <div class="bg-white rounded-lg border border-border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary">Total Accounts</p>
                        <h3 class="text-2xl font-bold text-primary mt-1">8</h3>
                    </div>
                    <div class="w-12 h-12 bg-info-light rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-success">+2</span>
                    <span class="text-tertiary ml-2">new this month</span>
                </div>
            </div>

            <!-- Income -->
            <div class="bg-white rounded-lg border border-border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary">Income</p>
                        <h3 class="text-2xl font-bold text-primary mt-1">$5,678.90</h3>
                    </div>
                    <div class="w-12 h-12 bg-success-light rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-success">+8.2%</span>
                    <span class="text-tertiary ml-2">from last month</span>
                </div>
            </div>

            <!-- Expenses -->
            <div class="bg-white rounded-lg border border-border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary">Expenses</p>
                        <h3 class="text-2xl font-bold text-primary mt-1">$3,456.78</h3>
                    </div>
                    <div class="w-12 h-12 bg-warning-light rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-danger">+3.1%</span>
                    <span class="text-tertiary ml-2">from last month</span>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg border border-border">
            <div class="px-6 py-4 border-b border-border">
                <h2 class="text-lg font-semibold text-primary">Recent Transactions</h2>
            </div>
            <div class="p-6">
                <p class="text-secondary">Your recent transactions will appear here.</p>
            </div>
        </div>
    </div>
</x-app-layout>