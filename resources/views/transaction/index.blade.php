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
            id="transactions-table"
            type="transaction"
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
                    'label' => 'Transaction Type',
                    'field' => 'transaction_type',
                ],
                [
                    'label' => 'Date',
                    'field' => 'date',
                ],
                [
                    'label' => 'Actions',
                    'field' => 'id',
                    'render' => '<div class=\'flex items-center space-x-2\'>
                                    <button onclick=\'deleteAccount({value})\' class=\'text-danger hover:text-danger-dark\'>Delete</button>
                                </div>',
                ],

            ]"
            :searchable="true"
            :per-page="10">
            Accounts List
        </x-data-table>
    </div>

    @push('scripts')
    <script>
        function deleteAccount(id) {
            if (confirm('Are you sure you want to delete this account?')) {
                // Handle delete logic
                fetch(`/transactions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert('Account deleted successfully');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete account');
                });
            }
        }
    </script>
    @endpush
</x-app-layout>