@extends('layouts.admin')

@section('title', 'Manage Funnel ')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">
   
      <x-page-header-text title="Manage funnel to all users" />

        <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('list.showtable') }}"
            class="w-full text-center hover:bg-gray-100 bg-gray-100 text-teal-600  px-5 py-2 rounded-xl  transition cursor-pointer">
        Users List
        </a>

        <a href="{{ route('manage.showtable') }}"
            class="w-full text-center  hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl transition cursor-pointer">
            Funnel Blocks
        </a>
    </div>

  <div class="flex flex-col sm:flex-row items-center  gap-4 mb-4 mt-6">

    {{-- Search Form --}}
    <form method="GET" action="{{ route('list.showtable') }}" class="flex items-center gap-2 py-2 text-sm w-full sm:w-auto ">
    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name"
           class="focus:outline-none border rounded p-2 w-full sm:w-64"
           oninput="this.form.submit()">
    </form>


    {{-- Editable Action --}}
    <div class="flex items-center gap-2 w-full sm:w-auto">
        <select id="is_editable_action" class="border rounded px-4 py-2 text-sm focus:outline-none w-full sm:w-auto">
            <option value="">Select Action</option>
            <option value="1">Editable (Yes)</option>
            <option value="0">Non-Editable (No)</option>
        </select>
        <button id="applyEditable" class="bg-gray-600 text-white px-4 py-2 rounded text-sm">Apply</button>
    </div>

</div>



<!-- Funnel Info Table -->
<div class="overflow-x-auto mb-6 bg-white rounded-xl shadow-sm border">
    <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
        <thead class="bg-gray-100">
    <tr>
        <th class="px-4 py-3 text-left"><input type="checkbox" id="select-all"></th>
        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Page Link</th>
        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Is Editable</th>
        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Created At</th>
    </tr>
</thead>
<tbody>
    @if ($funnels->isEmpty())
    <tr>
        <td colspan="100%" class="px-4 py-6 text-center text-gray-500">
            <x-no-materials />
        </td>
    </tr>
    @endif

    @foreach ($funnels as $funnel)
    <tr class="border-t">
        <td class="px-4 py-3 text-sm">
            <input type="checkbox" class="funnel-checkbox" value="{{ $funnel->id }}">
        </td>
        <td class="px-4 py-3 text-sm">
            {{ $funnel->user->name ?? $funnel->username }}
        </td>
        <td class="px-4 py-3 text-sm">{{ $funnel->page_link }}</td>
        <td class="px-4 py-3 text-sm capitalize">{{ $funnel->status }}</td>
        <td class="px-4 py-3 text-sm">{{ $funnel->is_editable ? 'Yes' : 'No' }}</td>
       <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($funnel->created_at)->format('M - d - Y') }}</td>

    </tr>
    @endforeach
</tbody>

    </table>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('select-all').addEventListener('change', function () {
    let checkboxes = document.querySelectorAll('.funnel-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('applyEditable').addEventListener('click', function (e) {
    e.preventDefault();

    let selected = Array.from(document.querySelectorAll('.funnel-checkbox:checked')).map(cb => cb.value);
    let editable = document.getElementById('is_editable_action').value;

    if (!editable || selected.length === 0) {
        Swal.fire('Error', 'Select users you want to change is editable or not.', 'error');
        return;
    }

    fetch("{{ route('admin.funnels.update-editable') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            ids: selected,
            is_editable: editable
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success', data.message, 'success').then(() => location.reload());
        } else {
            Swal.fire('Error', data.message || 'Something went wrong.', 'error');
        }
    });
});
</script>
@endsection
