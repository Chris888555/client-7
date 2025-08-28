@extends('layouts.admin')

@section('title', 'Event Poster')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <div class=" mx-auto my-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded shadow">
    <h4 class="font-bold text-yellow-800 mb-2">Note</h4>
    <p class="text-yellow-700 text-sm">
        If you want to hide this announcement on the landing page, please delete the poster.
    </p>
</div>
    {{-- CREATE FORM --}}
    <form id="posterForm" action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Poster Upload -->
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Upload Event Poster</label>
            <div class="flex items-center justify-center w-full">
                <label for="poster"
                    class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded-xl cursor-pointer 
                           bg-gray-50 hover:border-green-400 transition p-6 text-center border-gray-300">

                    <!-- Icon + Text -->
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mb-1">Click to upload or drag poster here</p>
                        <small class="text-gray-400">Only JPG or PNG (max 2MB)</small>
                    </div>

                    <!-- File input -->
                    <input id="poster" name="poster" type="file" accept="image/*" class="hidden" />

                    <!-- File path inside the border -->
                    <p id="posterFileName" class="mt-2 text-sm text-green-600 font-semibold"></p>
                </label>
            </div>
            <span id="errorPoster" class="text-red-600 text-sm"></span>
        </div>

        {{-- Submit --}}
        <button type="submit" id="submitBtn" 
            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
            <i class="fas fa-save"></i> Save Image
        </button>
    </form>

<!-- Table -->
<div class="mt-10 overflow-x-auto bg-white rounded-xl shadow-sm border">
    <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Poster</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $item)
                <tr>
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/'.$item->poster) }}" class="h-20 rounded" />
                    </td>
                    <td class="px-4 py-3 flex gap-2">
                        <!-- Update Button -->
                        <button type="button" 
                            onclick="openUpdateModal({{ $item->id }}, '{{ asset('storage/'.$item->poster) }}')" 
                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 flex items-center gap-2">
                            <i class="fas fa-pen"></i> Update
                        </button>

                        <!-- Delete Button -->
                        <button type="button"
                            onclick="deletePoster({{ $item->id }})"
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 flex items-center gap-2">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-4 py-6 text-center text-gray-500">
                     <x-no-data />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<!-- UPDATE MODAL -->
<div id="updateModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
      <h2 class="text-xl font-bold mb-4">Update Poster</h2>
      <form id="updateForm" action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" id="update_id">

          <div class="mb-4">
              <img id="currentPoster" src="" class="h-32 mx-auto rounded mb-2">
              <input type="file" name="poster" id="updatePoster" accept="image/*" class="block w-full text-sm text-gray-600 border rounded p-2">
          </div>

          <div class="flex justify-end gap-2">
              <button type="button" onclick="closeUpdateModal()" 
                  class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
              <button type="submit" 
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
          </div>
      </form>
  </div>
  
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// --- Create Form ---
document.getElementById('poster').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const fileNameEl = document.getElementById('posterFileName');
    fileNameEl.textContent = file ? file.name : "";
});

document.getElementById("posterForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire({ icon: 'success', title: 'Success', text: data.message })
            .then(() => location.reload());
        }
    });
});

// --- Update Modal ---
function openUpdateModal(id, imageUrl) {
    document.getElementById("update_id").value = id;
    document.getElementById("currentPoster").src = imageUrl;
    document.getElementById("updateModal").classList.remove("hidden");
}
function closeUpdateModal() {
    document.getElementById("updateModal").classList.add("hidden");
}

// --- Update Form ---
document.getElementById("updateForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire({ icon: 'success', title: 'Updated', text: data.message })
            .then(() => location.reload());
        }
    });
});

// Delete function
function deletePoster(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the poster!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/announcement/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', data.message, 'success').then(() => location.reload());
                }
            });
        }
    });
}

</script>
@endsection
