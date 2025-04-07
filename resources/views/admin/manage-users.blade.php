@if(!Auth::check())
<script>
window.location = "{{ route('admin.login') }}";
</script>
@endif


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Manage Users</title>

    <!-- Include Tailwind CSS via Vite -->
    @vite(['resources/css/app.css'])

    <!-- Include FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
    // This function updates the URL query without reloading the page
    function updateView(view) {
        window.location.search = '?view=' + view + '&search=' + document.getElementById('search-input').value;
    }
    </script>
</head>
<!-- Include Sidebar -->
@include('includes.nav')

<body class="bg-gray-50">

    <div class="container w-full mt-0 mb-0 m-auto p-4 sm:p-8">

        <h1 class="text-xl font-bold mb-6">Manage Users</h1>

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
                    class="px-4 py-2 border border-gray-200 bg-green-500 text-white rounded-md hover:bg-green-600 w-full sm:w-auto"
                    onclick="window.location='?view=approved&search={{ $search }}'">
                    Approved Users ( {{ $totalApprovedUsers }} )
                </button>
                <button
                    class="px-4 py-2  border border-blue-500 bg-blue-500 text-white rounded-md hover:bg-blue-600 w-full sm:w-auto"
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
            <p>No users found.</p>
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
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                        class="user-checkbox">
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
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 whitespace-nowrap">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                        </form>

                                        @if(!$user->approved)
                                        <form action="{{ route('users.approve', $user->id) }}" method="POST"
                                            class="inline">
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
        </div>
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


</body>

</html>