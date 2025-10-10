@extends('layouts.users')

@section('title', 'Prospect List')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

 

    <!-- Leads Table -->
    <div id="leadsTable" class="overflow-x-auto bg-white rounded-xl shadow-sm border">

   <!-- Bulk Action -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4">
            <h2 class="text-based font-semibold text-gray-700">My Leads</h2>
            <div class="flex items-center gap-2">
               <a href="{{ route('user.leads.export') }}"
                    class="flex items-center gap-2 w-auto self-start sm:self-auto bg-slate-800 text-white text-sm px-4 py-2 rounded-md hover:bg-slate-900 transition">
                    <i class="fa-solid fa-file-export"></i>
                    Export CSV
                </a>

                <button id="bulkDeleteBtn" 
                    class="flex items-center gap-2 w-auto self-start sm:self-auto bg-red-600 text-white text-sm px-4 py-2 rounded-md hover:bg-red-700 transition">
                    <i class="fa-solid fa-trash"></i>
                    Delete Selected
                </button>

            </div>
        </div>



      <table class="w-full min-w-full divide-y divide-gray-200 whitespace-nowrap">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-6 text-left">
                <input type="checkbox" id="checkAll">
            </th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">No.</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Name</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Email</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Phone</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Lead Background</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Capital</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Goal</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Commitment</th>
            <th class="px-4 py-6 text-left text-sm font-medium text-gray-600 uppercase">Date Submitted</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($leads as $index => $lead)
            <tr>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">
                    <input type="checkbox" class="leadCheckbox" value="{{ $lead->id }}">
                </td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $index + 1 }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">
                    {{ $lead->name }}
                    @if($lead->created_at->isToday())
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            NEW - Today
                        </span>
                    @endif
                </td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->email }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->phone }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->role ?? '—' }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->capital ?? '—' }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->goal ?? '—' }}</td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">
                    <span class="inline-block px-3 py-1 rounded-full bg-green-500 text-white">
                        {{ $lead->commitment ?? '—' }}
                    </span>
                </td>
                <td class="px-4 py-6 text-left text-sm font-medium text-gray-600">{{ $lead->created_at->format('M d, Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="px-4 py-6 text-center text-gray-500">
                    <x-no-data />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

        <x-paginations :paginator="$leads" />
    </div>

</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All
    document.getElementById('checkAll')?.addEventListener('change', function() {
        document.querySelectorAll('.leadCheckbox').forEach(cb => cb.checked = this.checked);
    });

    // Bulk Delete
    document.getElementById('bulkDeleteBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        let ids = [];
        document.querySelectorAll('.leadCheckbox:checked').forEach(cb => ids.push(cb.value));

        if(ids.length === 0){
            Swal.fire('Warning','Please select at least one lead.','warning');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete selected leads?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('user.leads.bulkDelete') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        Swal.fire('Deleted!', data.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
