<aside class="w-64 bg-white border-r border-border flex flex-col">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-border">
        <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">A</span>
            </div>
            <span class="text-xl font-semibold text-primary">AccountHub</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard.index') }}" 
           class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600' : 'text-secondary hover:bg-background-secondary' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Accounts -->
        <a href="{{ route('account.index') }}" 
           class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('accounts.*') ? 'bg-primary-50 text-primary-600' : 'text-secondary hover:bg-background-secondary' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span class="font-medium">Accounts</span>
        </a>

        <!-- Transactions -->
        <a href="{{ route('transactions.index') }}" 
           class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('transactions.*') ? 'bg-primary-50 text-primary-600' : 'text-secondary hover:bg-background-secondary' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span class="font-medium">Transactions</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('category.index') }}" 
           class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-primary-50 text-primary-600' : 'text-secondary hover:bg-background-secondary' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="font-medium">Categories</span>
        </a>

        <!-- reports -->
          <a href="{{ route('reports.index') }}" 
           class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'bg-primary-50 text-primary-600' : 'text-secondary hover:bg-background-secondary' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span class="font-medium">Reports</span>
        </a>

        <div class="border-t border-border my-4"></div>
    </nav>
</aside>