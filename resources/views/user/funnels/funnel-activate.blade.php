@extends('layouts.users')

@section('title', 'Sales Funnel')


@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    @if(!$funnel || strtolower($funnel->status) !== 'active')
    {{-- Activate Funnel Card --}}
    <div class="relative mt-2 p-8 bg-white rounded-3xl border border-gray-200 transition-all">

        <div class="absolute top-4 right-4 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
            PRO Add-on
        </div>

        <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-600 font-medium">
            <span class="material-symbols-outlined text-green-500">group</span>
            <span>700+ Users Trust This</span>
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800 mt-4 mb-2">Activate Your Funnel For – FREE</h2>
        <p class="text-gray-600 text-sm text-center mb-6">
            Unlock powerful business tools to grow and scale—no cost to start.
        </p>

        <ul class="text-gray-700 text-sm space-y-3 mb-6">
            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-600">analytics</span>
                Free Video Analytics</li>
            <li class="flex items-center gap-2"><span
                    class="material-symbols-outlined text-green-600">track_changes</span> Free Page View Tracking</li>
            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-600">slideshow</span>
                Free Powerful Sales Presentation</li>
            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-600">domain</span>
                Free subdomain</li>
        </ul>

        <form id="activateFunnelForm">
            @csrf
            <button type="submit"
                class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-white">rocket_launch</span>
                Activate Your Free Funnel
            </button>
        </form>

        <p class="text-xs text-gray-500 text-center mt-4">No credit card needed · Instant activation</p>
    </div>
    @else


    {{-- Funnel Activated View --}}
<div class="bg-white border border-gray-200 rounded-3xl p-8  mx-auto">

    <h2 class="text-xl sm:text-2xl font-semibold text-gray-600 mb-4">
        Your Funnel is Live!
    </h2>

    <p class="text-sm sm:text-base text-gray-500 mb-6">
        Share your funnel link to start generating leads.
    </p>

    <!-- Funnel Link Input -->
    <div class="mb-6">
        <input id="funnelLink" type="text" readonly value="{{ url($funnel->page_link) }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center items-center gap-3 w-full p-4 rounded-2xl bg-gradient-to-tr from-gray-50 to-white border max-w-[460px] mx-auto">

        <!-- Copy -->
        <button onclick="copyFunnelLink()"
            class="w-full sm:w-auto px-5 py-2.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-xl text-sm font-semibold transition">
            <i class="fas fa-copy mr-2"></i> Copy Link
        </button>

        <!-- View -->
        <a id="viewFunnelLink" href="{{ url($funnel->page_link) }}" target="_blank"
        class="w-full sm:w-auto px-5 py-2.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-xl text-sm font-semibold transition flex justify-center items-center text-center">
        <i class="fas fa-eye mr-2"></i> View Funnel
        </a>

        <!-- Edit -->
        <button onclick="openEditModal()"
            class="w-full sm:w-auto px-5 py-2.5 bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-300 rounded-xl text-sm font-semibold transition">
            <i class="fas fa-edit mr-2"></i> Edit Link
        </button>
    </div>
</div>


    <!-- Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4">Edit Funnel Link</h2>
        <form id="updatedLinkForm">
            @csrf
            <div class="mb-4 text-left">
                <label for="page_link" class="block text-sm text-gray-600 mb-1">Page Link:</label>
                <input type="text" name="page_link" id="page_link" value="{{ $funnel->page_link }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200" required>
                <div class="mt-2">
                    <button type="button" onclick="generatePageLink()"
                        class="text-xs text-blue-600">↻ Generate Random Page Link</button>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 text-sm bg-gray-100 text-red-600 rounded">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-gray-100 text-green-600  rounded">Save</button>
            </div>
        </form>
    </div>
</div>

   <script>
function generatePageLink() {
    const random = Math.random().toString(36).substring(2, 8);
    document.getElementById('page_link').value = 'funnel-' + random;
}
</script>


    @endif

</div>
@endsection

@section('js')
<!-- SweetAlert2 CDN -->

<script>
// AJAX Activate Funnel
document.getElementById('activateFunnelForm')?.addEventListener('submit', function(e) {
    e.preventDefault();

    fetch("{{ route('funnels.activate') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (response.ok) {
                Swal.fire({
                    title: 'Activated!',
                    text: 'Your funnel is now active.',
                    icon: 'success',
                    confirmButtonColor: '#6366f1',
                    timerProgressBar: true,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Error', 'Failed to activate funnel.', 'error');
            }
        })
        .catch(() => {
            Swal.fire('Error', 'Something went wrong.', 'error');
        });
});



function copyFunnelLink() {
    const copyText = document.getElementById("funnelLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Funnel link copied to clipboard.',
        timer: 1500,
        showConfirmButton: false,
    });
}

function openEditModal() {
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// AJAX SUBMISSION
document.getElementById('updatedLinkForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const pageLink = document.getElementById('page_link').value;
    const token = document.querySelector('input[name="_token"]').value;

    fetch("{{ $funnel ? route('funnel.updateLink', $funnel->id) : '#' }}", {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({
                page_link: pageLink
            }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('funnelLink').value = data.new_link;
                document.getElementById('viewFunnelLink').setAttribute('href', data.new_link);
                closeEditModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Funnel link updated successfully!',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Update failed. Try again.',
                });
            }
        })

        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Request Error',
                text: 'Something went wrong.',
            });
        });
});
</script>


<style>
  .spin-slow {
    animation: spin 3s linear infinite;
  }

  @keyframes spin {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>

<!-- Gear Icon Button -->
<div id="gearToggle"
     class="fixed bottom-5 right-5 bg-black text-white w-14 h-14 flex items-center justify-center rounded-full cursor-pointer shadow-lg z-50">
  <i class="fas fa-cog text-2xl spin-slow"></i>
</div>

<!-- Gear Card -->
<div id="gearCard"
     class="hidden fixed bottom-20 right-5 w-64 bg-white p-4 rounded-xl shadow-xl z-40">
  <h4 class="text-lg font-semibold mb-2">Settings</h4>
  <p class="text-sm text-gray-600 mb-3">Manage your sales funnel system.</p>

  <!-- Edit Funnel Blocks Link -->
  <a href="{{ route('funnels.showtable') }}" 
     class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
    Go Edit Funnel Blocks
  </a>
</div>

<script>
  const gearToggle = document.getElementById('gearToggle');
  const gearCard = document.getElementById('gearCard');
  const isEditable = @json($funnel->is_editable ?? true); // default true if null

  gearToggle.addEventListener('click', (e) => {
    e.stopPropagation();

    if (!isEditable) {
      Swal.fire({
        icon: 'warning',
        title: 'Editing Disabled',
        text: 'The admin has disabled editing for this funnel.',
        confirmButtonText: 'OK'
      });
      return;
    }

    gearCard.classList.toggle('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!gearCard.contains(e.target) && !gearToggle.contains(e.target)) {
      gearCard.classList.add('hidden');
    }
  });
</script>



@endsection