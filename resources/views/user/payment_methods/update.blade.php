@extends('layouts.users')

@section('title', 'Update Payment Method')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

 
     {{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Packages --}}
    <a href="{{ route('payment-method.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('payment-method.create') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Add Mop
    </a>

    {{-- List Packages --}}
    <a href="{{ route('payment-method.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('payment-method.list') 
            ? 'bg-teal-600 text-white hover:bg-teal-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Mop
    </a>
</div>

 {{-- ✅ Payment Methods Table --}}
<div id="paymentTable" class="mt-6">
    <div class="rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-0">

            {{-- ✅ Toolbar --}}
            <div class="flex justify-between items-center px-3 py-3 border-b border-gray-200">
                <!-- Left Side -->
                <h2 class="text-lg font-semibold text-gray-700">List</h2>

                <!-- Right Side -->
                <div class="flex gap-2 items-center">
                    <button id="bulkDeleteBtn" 
                        class="bg-red-600 text-white text-sm px-3 py-2 rounded-md hover:bg-red-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-trash"></i> Delete Selected
                    </button>
                </div>
            </div>


            {{-- ✅ Table Wrapper --}}
            <div class="overflow-x-auto max-h-[600px]">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase"><input type="checkbox" id="checkAll" class="rounded"></th>
                            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Method Name</th>
                            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Account Name</th>
                            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Account Number</th>
                            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($methods as $method)
                            <tr class="border-b border-gray-200" id="row-{{ $method->id }}">
                                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600"><input type="checkbox" class="rowCheckbox rounded" value="{{ $method->id }}"></td>
                                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $method->method_name }}</td>
                                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $method->account_name }}</td>
                                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $method->account_number }}</td>
                                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">
                                    <button class="edit-btn text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out w-full flex items-center justify-center gap-1"
                                        data-id="{{ $method->id }}"
                                        data-method_name="{{ $method->method_name }}"
                                        data-account_name="{{ $method->account_name }}"
                                        data-account_number="{{ $method->account_number }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Update
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                    <x-no-data />
                                </td>
                            </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

    {{-- Edit Form --}}
    <div id="editFormContainer" style="display: none;" class="mt-6 bg-white p-6 rounded-xl border">
       <form id="updatePaymentForm" method="POST" action="{{ route('payment-method.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" id="method_id" name="id">

            <x-input-text id="method_name" name="method_name" label="Method Name" placeholder="Enter method name"
                value="{{ old('method_name') }}" required />

            <x-input-text id="account_name" name="account_name" label="Account Name" placeholder="Enter account name"
                value="{{ old('account_name') }}" required />

            <x-input-text id="account_number" name="account_number" label="Account Number"
                placeholder="Enter account number" value="{{ old('account_number') }}" required />

            <div class="flex flex-row mt-4 gap-4">
                <button type="submit"
                    class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-blue-300 text-blue-700 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-800 transition rounded shadow-sm">
                    <i class="fas fa-save"></i> Update
                </button>
                <button type="button" id="cancelEdit"
                    class="w-full max-w-[200px] flex items-center justify-center gap-2 px-4 py-2 border border-dashed border-red-300 text-red-700 hover:border-red-400 hover:bg-red-50 hover:text-red-800 transition rounded shadow-sm">
                    <i class="fas fa-circle-xmark"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const table = document.getElementById('paymentTable');
    const form = document.getElementById('editFormContainer');
    const updateForm = document.getElementById('updatePaymentForm');

    // Edit
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('method_id').value = button.dataset.id;
            document.getElementById('method_name').value = button.dataset.method_name;
            document.getElementById('account_name').value = button.dataset.account_name;
            document.getElementById('account_number').value = button.dataset.account_number;

            table.style.display = 'none';
            form.style.display = 'block';
        });
    });

    // Cancel Edit
    document.getElementById('cancelEdit').addEventListener('click', () => {
        form.style.display = 'none';
        table.style.display = 'block';
    });

    // AJAX Update
    updateForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(updateForm);

        fetch(updateForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Updated!', data.success, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', data.error || 'Update failed.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Server error.', 'error');
            });
    });

    // Check All
    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('.rowCheckbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk Delete
    document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
        const selectedIds = [...document.querySelectorAll('.rowCheckbox:checked')].map(cb => cb.value);

        if (selectedIds.length === 0) {
            return Swal.fire('No selection', 'Please select at least one item to delete.', 'warning');
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Selected methods will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`{{ route('payment-method.delete') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: selectedIds
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            selectedIds.forEach(id => document.getElementById('row-' + id)
                                .remove());
                            Swal.fire('Deleted!', data.success, 'success');
                        } else {
                            Swal.fire('Error', data.error || 'Failed to delete.', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error', 'Server error.', 'error'));
            }
        });
    });
});
</script>
@endsection