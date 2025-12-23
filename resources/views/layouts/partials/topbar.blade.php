<header class="h-16 bg-white border-b border-border flex items-center justify-between px-6">
    <!-- Page Title / Breadcrumb -->
    <div>
        <h1 class="text-xl font-semibold text-primary">
            @yield('page-title', 'Dashboard')
        </h1>
    </div>

    <!-- Right Side: User Profile -->
    <div class="flex items-center space-x-4">
    
        <!-- User Profile Dropdown -->
        <div class="relative flex flex-col items-center" x-data="{ open: false }">
            <div class="w-9 h-9 rounded-full bg-primary-100 flex items-center justify-center">
                <span class="text-primary-600 font-semibold text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </span>
            </div>
            <!-- User Name -->
            <div class="hidden md:block text-left">
                <p class="text-sm font-medium text-primary">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</header>
