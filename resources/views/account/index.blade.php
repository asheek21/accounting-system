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
            id="accounts-table"
            type="account"
            :columns="[
                [
                    'label' => 'Id',
                    'field' => 'id',
                ],
                [
                    'label' => 'Account Name',
                    'field' => 'account_name',
                ]
            ]"
            :searchable="true"
            :per-page="10">
            Accounts List
        </x-data-table>
    </div>
</x-app-layout>