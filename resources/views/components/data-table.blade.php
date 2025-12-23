<div x-data="dataTable({
    id: '{{ $id }}',
    type: '{{ $type }}',
    perPage: {{ $perPage }},
    searchable: {{ $searchable }}
})" 
     x-init="init()"
     class="bg-white rounded-lg border border-border">
    
    <!-- Table Header with Search -->
    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <h3 class="text-lg font-semibold text-primary">{{ $slot }}</h3>
            <span x-show="loading" class="text-sm text-secondary">Loading...</span>
        </div>
        
        @if($searchable)
        <div class="relative">
            <input 
                type="text" 
                x-model="search"
                @input.debounce.300ms="fetchData()"
                placeholder="Search..."
                class="pl-10 pr-4 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"
            >
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        @endif
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-background-secondary">
                <tr>
                    @foreach($columns as $column)
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">
                        {{ $column['label'] }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                <!-- Loading State -->
                <template x-if="loading && data.length === 0">
                    <tr>
                        <td colspan="{{ count($columns) }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <svg class="animate-spin h-8 w-8 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-sm text-secondary">Loading data...</p>
                            </div>
                        </td>
                    </tr>
                </template>

                <!-- Empty State -->
                <template x-if="!loading && data.length === 0">
                    <tr>
                        <td colspan="{{ count($columns) }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-sm text-secondary">{{ $emptyMessage }}</p>
                            </div>
                        </td>
                    </tr>
                </template>

                <!-- Data Rows -->
                <template x-for="(row, index) in data" :key="index">
                    <tr class="hover:bg-background-secondary transition-colors">
                        @foreach($columns as $column)
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if(isset($column['render']))
                                <div x-html="renderColumn(row, '{{ $column['field'] }}', {{ json_encode($column['render']) }})"></div>
                            @else
                                <span x-text="getNestedValue(row, '{{ $column['field'] }}')"></span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-border flex items-center justify-between">
        <div class="text-sm text-secondary">
            Showing <span x-text="pagination.from"></span> to <span x-text="pagination.to"></span> of <span x-text="pagination.total"></span> results
        </div>
        
        <div class="flex items-center space-x-2">
            <button 
                @click="changePage(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                :class="pagination.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-background-secondary'"
                class="px-3 py-1 rounded-lg border border-border text-sm text-secondary transition-colors">
                Previous
            </button>
            
            <template x-for="page in visiblePages" :key="page">
                <button 
                    @click="changePage(page)"
                    :class="page === pagination.current_page ? 'bg-primary-500 text-white' : 'text-secondary hover:bg-background-secondary'"
                    class="px-3 py-1 rounded-lg border border-border text-sm transition-colors"
                    x-text="page">
                </button>
            </template>
            
            <button 
                @click="changePage(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                :class="pagination.current_page === pagination.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-background-secondary'"
                class="px-3 py-1 rounded-lg border border-border text-sm text-secondary transition-colors">
                Next
            </button>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
function dataTable(config) {
    return {
        id: config.id,
        type: config.type,
        perPage: config.perPage,
        searchable: config.searchable,
        data: [],
        loading: false,
        search: '',
        pagination: {
            current_page: 1,
            last_page: 1,
            per_page: config.perPage,
            total: 0,
            from: 0,
            to: 0
        },
        
        init() {
            this.fetchData();
        },
        
        async fetchData() {
            this.loading = true;
            
            try {
                const params = new URLSearchParams({
                    page: this.pagination.current_page,
                    per_page: this.perPage,
                    type: this.type,
                    ...(this.searchable && this.search && { search: this.search })
                });
                
                const response = await fetch(`/data-table?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const result = await response.json();
                
                this.data = result.data;
                this.pagination = {
                    current_page: result.current_page,
                    last_page: result.last_page,
                    per_page: result.per_page,
                    total: result.total,
                    from: result.from,
                    to: result.to
                };
            } catch (error) {
                console.error('Error fetching data:', error);
                this.data = [];
            } finally {
                this.loading = false;
            }
        },
        
        changePage(page) {
            if (page < 1 || page > this.pagination.last_page) return;
            this.pagination.current_page = page;
            this.fetchData();
        },
        
        get visiblePages() {
            const current = this.pagination.current_page;
            const last = this.pagination.last_page;
            const delta = 2;
            const range = [];
            
            for (let i = Math.max(2, current - delta); i <= Math.min(last - 1, current + delta); i++) {
                range.push(i);
            }
            
            if (current - delta > 2) {
                range.unshift('...');
            }
            if (current + delta < last - 1) {
                range.push('...');
            }
            
            range.unshift(1);
            if (last !== 1) {
                range.push(last);
            }
            
            return range;
        },
        
        getNestedValue(obj, path) {
            return path.split('.').reduce((acc, part) => acc && acc[part], obj);
        },
        
        renderColumn(row, field, renderFn) {
            const value = this.getNestedValue(row, field);
            if (typeof renderFn === 'string') {
                return renderFn.replace('{value}', value).replace('{row}', JSON.stringify(row));
            }
            return value;
        }
    }
}
</script>
@endpush
@endonce