@extends('layouts.app')

@section('title', 'Downloadable')

@section('content')

@include('includes.nav')


<script>
// This function updates the URL query without reloading the page
function updateView(view) {
    window.location.search = '?view=' + view + '&search=' + document.getElementById('search-input').value;
}
</script>

<main class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left">Manage Users</h1>
    <p class="text-gray-600 text-left mb-4">Approve users, delete accounts, assign roles, and revert pending users with
        ease.</p>


    <div class="flex flex-wrap items-center gap-4 mb-6">
        <!-- Search Form -->
        <form action="{{ route('admin.manage-users') }}" method="GET"
            class="flex items-center w-full sm:w-auto mb-4 sm:mb-0">
            <input type="text" name="search" placeholder="Search by name or email"
                class="rounded-r-none border-r-0 px-4 py-2 border rounded-md w-96 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-light-blue-500 focus:border-light-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-light-blue-500 dark:focus:border-light-blue-500"
                value="{{ $search }}">
            <input type="hidden" name="view" value="{{ $view }}"> <!-- Ensure 'view' is passed as a hidden field -->
            <button type="submit"
                class="border border-blue-500 rounded-l-none px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Search
            </button>
        </form>

        <!-- Buttons to switch between approved and pending users -->
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <button
                class="px-4 py-2 border border-gray-200 bg-green-500 text-white rounded-md hover:bg-green-600 w-full sm:w-auto shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center"
                onclick="window.location='?view=approved&search={{ $search }}'">
                Approved Users ( {{ $totalApprovedUsers }} )
            </button>
            <button
                class="px-4 py-2  border border-blue-500 bg-blue-500 text-white rounded-md hover:bg-blue-600 w-full sm:w-auto shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center"
                onclick="window.location='?view=pending&search={{ $search }}'">
                Pending Users ( {{ $totalPendingUsers }} )
            </button>
        </div>
    </div>

    <form id="bulk-action-form" action="{{ route('users.bulkAction') }}" method="POST" style="display: none;">
        @csrf
        <div class="flex items-center space-x-4">
            <select name="action" id="bulk-action-dropdown"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-56 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" class="text-gray-700">Select Action</option>

                @if($view === 'approved')
                <option value="make_admin" class="text-gray-700">Make Admin</option>
                <option value="revert_admin" class="text-gray-700">Revert Admin</option>
                <option value="revert_pending" class="text-gray-700">Revert Pending</option>
                <option value="delete" class="text-gray-700">Delete</option>
                @elseif($view === 'pending')
                <option value="approve" class="text-gray-700">Approve</option>
                <option value="delete" class="text-gray-700">Delete</option>
                @endif
            </select>
            <button type="submit" id="apply-action" class="px-6 py-2 bg-blue-500 text-white rounded-md ml-2"
                disabled>Apply</button>
        </div>
    </form>



    <!-- Display the current view (approved or pending) -->
    <div class="mb-6">

        @if($users->isEmpty())
        <div class="w-full flex items-center flex-wrap justify-center gap-10 border boder-gray-300 rounded-lg p-4">
            <div class="grid gap-4 w-60">
                <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="128" height="124" viewBox="0 0 128 124"
                    fill="none">
                    <g filter="url(#filter0_d_14133_718)">
                        <path
                            d="M4 61.0062C4 27.7823 30.9309 1 64.0062 1C97.0319 1 124 27.7699 124 61.0062C124 75.1034 119.144 88.0734 110.993 98.3057C99.7572 112.49 82.5878 121 64.0062 121C45.3007 121 28.2304 112.428 17.0071 98.3057C8.85599 88.0734 4 75.1034 4 61.0062Z"
                            fill="#F9FAFB" />
                    </g>
                    <path
                        d="M110.158 58.4715H110.658V57.9715V36.9888C110.658 32.749 107.226 29.317 102.986 29.317H51.9419C49.6719 29.317 47.5643 28.165 46.3435 26.2531L46.342 26.2509L43.7409 22.2253L43.7404 22.2246C42.3233 20.0394 39.8991 18.7142 37.2887 18.7142H20.8147C16.5749 18.7142 13.1429 22.1462 13.1429 26.386V57.9715V58.4715H13.6429H110.158Z"
                        fill="#EEF2FF" stroke="#A5B4FC" />
                    <path
                        d="M49 20.2142C49 19.6619 49.4477 19.2142 50 19.2142H106.071C108.281 19.2142 110.071 21.0051 110.071 23.2142V25.6428H53C50.7909 25.6428 49 23.8519 49 21.6428V20.2142Z"
                        fill="#A5B4FC" />
                    <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 36.1429 23.5)"
                        fill="#4F46E5" />
                    <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 29.7144 23.5)"
                        fill="#4F46E5" />
                    <circle cx="1.07143" cy="1.07143" r="1.07143" transform="matrix(-1 0 0 1 23.2858 23.5)"
                        fill="#4F46E5" />
                    <path
                        d="M112.363 95.459L112.362 95.4601C111.119 100.551 106.571 104.14 101.323 104.14H21.8766C16.6416 104.14 12.0808 100.551 10.8498 95.4592C10.8497 95.4591 10.8497 95.459 10.8497 95.459L1.65901 57.507C0.0470794 50.8383 5.09094 44.4286 11.9426 44.4286H111.257C118.108 44.4286 123.166 50.8371 121.541 57.5069L112.363 95.459Z"
                        fill="white" stroke="#E5E7EB" />
                    <path
                        d="M65.7893 82.4286C64.9041 82.4286 64.17 81.6945 64.17 80.7877C64.17 77.1605 58.686 77.1605 58.686 80.7877C58.686 81.6945 57.9519 82.4286 57.0451 82.4286C56.1599 82.4286 55.4258 81.6945 55.4258 80.7877C55.4258 72.8424 67.4302 72.8639 67.4302 80.7877C67.4302 81.6945 66.6961 82.4286 65.7893 82.4286Z"
                        fill="#4F46E5" />
                    <path
                        d="M79.7153 68.5462H72.9358C72.029 68.5462 71.2949 67.8121 71.2949 66.9053C71.2949 66.0201 72.029 65.286 72.9358 65.286H79.7153C80.6221 65.286 81.3562 66.0201 81.3562 66.9053C81.3562 67.8121 80.6221 68.5462 79.7153 68.5462Z"
                        fill="#4F46E5" />
                    <path
                        d="M49.9204 68.546H43.1409C42.2341 68.546 41.5 67.8119 41.5 66.9051C41.5 66.0198 42.2341 65.2858 43.1409 65.2858H49.9204C50.8056 65.2858 51.5396 66.0198 51.5396 66.9051C51.5396 67.8119 50.8056 68.546 49.9204 68.546Z"
                        fill="#4F46E5" />
                    <circle cx="107.929" cy="91.0001" r="18.7143" fill="#EEF2FF" stroke="#E5E7EB" />
                    <path
                        d="M115.161 98.2322L113.152 96.2233M113.554 90.1965C113.554 86.6461 110.676 83.7679 107.125 83.7679C103.575 83.7679 100.697 86.6461 100.697 90.1965C100.697 93.7469 103.575 96.6251 107.125 96.6251C108.893 96.6251 110.495 95.9111 111.657 94.7557C112.829 93.5913 113.554 91.9786 113.554 90.1965Z"
                        stroke="#4F46E5" stroke-width="1.6" stroke-linecap="round" />
                    <defs>
                        <filter id="filter0_d_14133_718" x="2" y="0" width="124" height="124"
                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                            <feOffset dy="1" />
                            <feGaussianBlur stdDeviation="1" />
                            <feComposite in2="hardAlpha" operator="out" />
                            <feColorMatrix type="matrix"
                                values="0 0 0 0 0.0627451 0 0 0 0 0.0941176 0 0 0 0 0.156863 0 0 0 0.05 0" />
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_14133_718" />
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_14133_718"
                                result="shape" />
                        </filter>
                    </defs>
                </svg>
                <div>
                    <h2 class="text-center text-black text-base font-semibold leading-relaxed pb-1">There’s no users
                        found</h2>

                </div>
            </div>
        </div>
        @else

        <div class="overflow-x-auto">
            <div class="mt-6 bg-white overflow-auto">
                <table class="w-full border-collapse border bg-white border-gray-300">
                    <thead class="bg-gray-100">
                        <tr class="bg-[#3e377b] text-white ">
                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">
                                <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)">
                            </th>

                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">Name</th>
                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">Email</th>
                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">Status</th>
                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-100">
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox">
                            </td>


                            <td class="px-4 py-2 border-b whitespace-nowrap">{{ $user->name }}</td>

                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                @if($user->approved)
                                @if($user->is_admin)
                                <span class="font-semibold text-blue-500 ">Admin</span>
                                @else
                                <span class="text-green-500 font-semibold">User</span>
                                @endif
                                @else
                                <span class="text-yellow-500 font-semibold">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b">
                                <div class="flex items-center space-x-4 justify-start">
                                    @if($user->approved)
                                    @if(!$user->is_admin)
                                    <form action="{{ route('users.promoteToAdmin', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-green-500 hover:text-green-700 whitespace-nowrap">
                                            <i class="fas fa-user-cog "></i> Make Admin
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.revertToRegular', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-orange-500 hover:text-orange-700 whitespace-nowrap">
                                            <i class="fas fa-undo"></i> Revert Admin
                                        </button>
                                    </form>
                                    @endif


                                    <!-- New Revert to Pending Button -->
                                    <form action="{{ route('users.revertToPending', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-yellow-500 hover:text-yellow-700 whitespace-nowrap">
                                            <i class="fas fa-undo"></i> Revert Pending
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 whitespace-nowrap">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>

                                    @if(!$user->approved)
                                    <form action="{{ route('users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-green-500 hover:text-green-700 whitespace-nowrap">
                                            <i class="fas fa-user-check"></i> Approve
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                <div class="flex justify-start">
                    {{ $users->appends(['view' => $view, 'search' => request()->get('search')])->links() }}
                </div>
            </div>
            @endif
        </div>
</main>
<script>
const bulkActionForm = document.getElementById('bulk-action-form');
const bulkActionDropdown = document.getElementById('bulk-action-dropdown');
const userCheckboxes = document.querySelectorAll('.user-checkbox');
const applyActionButton = document.getElementById('apply-action');
const selectAllCheckbox = document.getElementById('select-all');

// Function to check/uncheck all checkboxes
function toggleSelectAll(selectAll) {
    userCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    toggleBulkActionButton();
}

// Listen to changes in checkbox selection
userCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        toggleBulkActionButton();
    });
});

// Function to toggle the bulk action button and dropdown status, and show the form if there are selected users
function toggleBulkActionButton() {
    const selectedUsers = Array.from(userCheckboxes).filter(checkbox => checkbox.checked);
    applyActionButton.disabled = selectedUsers.length === 0; // Disable button if no users are selected
    bulkActionDropdown.disabled = selectedUsers.length === 0; // Disable dropdown if no users are selected

    if (selectedUsers.length > 0) {
        const selectedIds = selectedUsers.map(checkbox => checkbox.value);
        addUserIdsToForm(selectedIds); // Add selected user IDs to the form
        bulkActionForm.style.display = 'block'; // Show the form
    } else {
        removeUserIdsFromForm(); // Remove user IDs if no user is selected
        bulkActionForm.style.display = 'none'; // Hide the form if no user is selected
    }
}

// Add selected user IDs to the form data
function addUserIdsToForm(userIds) {
    let input = document.querySelector('input[name="user_ids"]');
    if (!input) {
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'user_ids';
        bulkActionForm.appendChild(input);
    }
    input.value = userIds.join(',');
}

// Remove user IDs from the form if no users are selected
function removeUserIdsFromForm() {
    let input = document.querySelector('input[name="user_ids"]');
    if (input) {
        input.value = ''; // Clear the hidden input field
    }
}

// Handle form submission
bulkActionForm.addEventListener('submit', function(event) {
    const selectedUsers = Array.from(userCheckboxes).filter(checkbox => checkbox.checked);
    if (selectedUsers.length === 0) {
        alert('Please select at least one user.');
        event.preventDefault();
    }
});
</script>


@endsection