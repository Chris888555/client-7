@extends('layouts.app')

@section('title', 'Video Analytics')

@section('content')

@include('includes.nav')

<div class="container w-full mt-0 mb-0 m-auto p-4 sm:p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Video Watch Analytics</h2>

    <p id="note" class="bg-yellow-100 border-l-4 border-yellow-500 text-gray-800 p-4 mb-4 text-sm flex items-center justify-between">
    <span>Track user watch progress and engagement throughout your sales funnel videos. Use these metrics to identify user behavior and optimize your funnel.</span>
    <button onclick="document.getElementById('note').classList.add('hidden')" class="text-gray-600 hover:text-gray-800 ml-4 text-xl">
        &times;
    </button>
</p>


    <!-- Success Message -->
    @if(session('success'))
    <div id="success-message" <div
        class="mt-6 mb-6 flex w-full  mx-auto  overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
        <div class="flex items-center justify-center w-12 bg-emerald-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    <script>
    // Hide the success message after 3 seconds
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
    }, 5000);
    </script>
    @endif


    <!-- Add a form for deletion -->
    <form id="delete-form" method="POST" action="{{ route('video-analytics.delete') }}">
        @csrf
        @method('DELETE')


        <div class="mb-4 flex items-center justify-between flex-wrap gap-4">
            <p class="text-xl text-gray-600 font-extrabold">All Records: {{ $videoAnalytics->total() }}</p>

            <button type="submit"
                class="bg-red-50 border border-red-200 text-red-500 px-4 py-2 rounded-md hover:bg-red-100 flex items-center gap-2">
                <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                </svg>
                Delete Selected
            </button>


        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 align-middle text-left whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3  ">
                            <input type="checkbox" id="select-all" class="form-checkbox">
                        </th>
                        <th class="px-6 py-3 ">User Cookie</th>
                        <th class="px-6 py-3">Progress (%)</th>
                        <th class="px-6 py-3">Max Watched (%)</th>
                        <th class="px-6 py-3">Started At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($videoAnalytics as $data)
                    <tr>
                        <td class="px-6 py-3">
                            <input type="checkbox" name="selected[]" value="{{ $data->id }}"
                                class="form-checkbox user-checkbox">
                        </td>
                        <td class="px-6 py-4">{{ $data->user_cookie }}</td>
                        <td class="px-6 py-4">{{ number_format($data->progress, 2) }}</td>
                        <td class="px-6 py-4 text-green-500">{{ number_format($data->max_watch_percentage, 2) }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $data->created_at->format('M-j-Y') }}
                            @if ($data->created_at->isToday())
                            <span
                                class="ml-4 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                New
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </form>

    <!-- Pagination links -->
    <div class="mt-4 flex justify-center items-center">
        {{ $videoAnalytics->links() }}
    </div>

</div>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
// Handle "Select All" functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Validate before submitting the form using SweetAlert
document.getElementById('delete-form').addEventListener('submit', function(e) {
    const selectedCheckboxes = document.querySelectorAll('.user-checkbox:checked');

    if (selectedCheckboxes.length === 0) {
        e.preventDefault(); // Stop form from submitting

        // SweetAlert2 warning
        Swal.fire({
            icon: 'warning',
            title: 'No record selected',
            text: 'Please select at least one record to delete.',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }
});
</script>


@endsection