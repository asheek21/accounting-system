<x-app-layout>
    @section('page-title', 'Accounts')

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-primary">Accounts</h2>
                <p class="text-secondary mt-1">Manage your financial accounts</p>
            </div>
        </div>

        <!-- DataTable Component -->
        <x-data-table 
            id="category-table"
            type="category"
            :columns="[
                [
                    'label' => 'Id',
                    'field' => 'id',
                ],
                [
                    'label' => 'Category Name',
                    'field' => 'category_name',
                ]
            ]"
            :searchable="true"
            :per-page="10">
            Categories
        </x-data-table>
    </div>
</x-app-layout>