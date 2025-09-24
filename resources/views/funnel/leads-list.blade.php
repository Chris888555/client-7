@extends('layouts.users')

@section('title', 'My Leads')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    <div class="flex justify-end mb-4">
        <a href="{{ route('user.leads.export') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
           <span class="material-symbols-outlined">download</span>
           Export CSV
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow-sm border">
        <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">No.</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Email</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Phone</th>
                    <th class="px-4 py-6 text-left text-xs font-medium text-gray-600 uppercase">Date Submitted</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($leads as $index => $lead)
                    <tr>
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            {{ $lead->name }}
                            @if($lead->created_at->isToday())
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    NEW - Today
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $lead->email }}</td>
                        <td class="px-4 py-3">{{ $lead->phone }}</td>
                        <td class="px-4 py-3">{{ $lead->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
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
