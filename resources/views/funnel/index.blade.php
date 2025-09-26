@extends('layouts.users')

@section('title', 'My Funnel')

@section('content')


<style>
/* Continuous spin */
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.spin-gear {
  animation: spin 2s linear infinite; /* umiikot nonstop */
}
</style>

<div class="container m-auto p-4 sm:p-8 max-w-full space-y-8">

    <!-- Modal -->
    <div id="metaModal" 
        class="fixed inset-0 z-50 bg-black bg-opacity-70 hidden items-center justify-center">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative z-60">
            <h2 class="text-xl font-semibold mb-4">Add or Update Meta Pixel Code</h2>
            <p class="mb-4 text-gray-600 text-sm leading-relaxed">
                ⚠️ This setting is recommended only if you are familiar with 
                <span class="font-medium">Meta Pixel</span> and how it connects to your 
                <span class="font-medium">Facebook Ads</span>.  
                With proper setup, you can track important events like 
                <span class="italic">Page View</span>, <span class="italic">View Content</span>, — 
                helping optimize your ad campaigns and measure results more accurately.  
                If unsure, please consult your ads manager before making changes.
            </p>

            <textarea id="metaPixelInput" 
                class="w-full border rounded-md p-3 h-40"
                placeholder="Paste your Meta Pixel code here...">{{ $funnel->meta_pixel_code ?? '' }}</textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button id="closeMetaModal" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Cancel</button>
                <button id="saveMetaPixel" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Save</button>
            </div>
        </div>
    </div>

    <div class="w-full bg-white rounded-3xl border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="flex justify-between items-center px-6 py-4 bg-teal-800 text-white">
            <h2 class="text-xl font-semibold">My Sales Funnel</h2>

           <!-- Gear Dropdown -->
                <div class="relative inline-block text-left">
                    <button id="gearMenuBtn" type="button"
                        class="bg-white text-gray-600 w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-gear spin-gear"></i>
                    </button>
                

                <!-- Dropdown Menu -->
                <div id="gearDropdown"
                    class="hidden absolute right-0 mt-2 w-44 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                    <div class="py-1">
                        <a href="{{ route('funnel.editButtons') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-pen me-2"></i> Edit Buttons
                        </a>
                        <button id="openMetaModal"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-brands fa-meta me-2"></i> Setup Meta Pixel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <!-- Promo -->
            <div class="mb-6">
                <p class="text-sm text-gray-600 mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                    <span class="text-green-600 font-semibold">Trusted by 1M+ Users</span>
                </p>
                <p class="text-lg font-medium text-gray-800">
                    Launch Your Funnel in Minutes — <span class="text-navy font-semibold">No Tech Skills Needed!</span>
                </p>
            </div>

            @if($funnel)
                <!-- Buttons responsive wrapper -->
                <div class="flex flex-col sm:flex-row gap-2 mb-6">
                    <!-- Funnel Link Input -->
                    <div class="relative flex-1">
                        <i class="fa-solid fa-link absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="funnelLink" type="text" value="{{ url($funnel->page_link) }}" readonly
                            onclick="window.open(this.value, '_blank'); this.select();"
                            class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-navy transition cursor-pointer">
                    </div>

                    <!-- Copy Button -->
                    <button id="copyButton" type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm transition flex items-center gap-2">
                        <i class="fa-solid fa-copy"></i> Copy Link
                    </button>

                    <!-- Update Link Button -->
                    <button id="updateLinkBtn" type="button"
                        class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 text-sm transition flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right"></i> Update Link
                    </button>
                </div>
            @else
                <!-- Activate Funnel Button -->
                <form id="activateFunnelForm" method="POST" action="{{ route('funnel.activate') }}">
                    @csrf
                    <button type="submit"
                        class="w-full max-w-md md:max-w-lg py-4 bg-teal-600 hover:bg-teal-700
                            text-white font-semibold rounded-2xl shadow-lg transition-all duration-300 
                            flex items-center justify-center gap-3 mx-auto">
                        <span class="material-symbols-outlined text-white">smart_toy</span>
                        Activate My AI Funnel
                    </button>
                </form>
            @endif

            <!-- Footer -->
            <p class="text-xs text-gray-400 text-center mt-4">Powered by AI · No credit card needed · Instant setup</p>
        </div>
    </div>
</div>




<script>
document.addEventListener("DOMContentLoaded", () => {
    const gearBtn = document.getElementById("gearMenuBtn");
    const dropdown = document.getElementById("gearDropdown");

    gearBtn.addEventListener("click", () => {
        dropdown.classList.toggle("hidden");
    });

    // Close kapag nag-click sa labas
    window.addEventListener("click", function(e) {
        if (!gearBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add("hidden");
        }
    });

    // Meta Modal logic
    const openMetaModal = document.getElementById("openMetaModal");
    const closeMetaModal = document.getElementById("closeMetaModal");
    const metaModal = document.getElementById("metaModal");

    if(openMetaModal){
        openMetaModal.addEventListener("click", () => {
            metaModal.classList.remove("hidden");
            dropdown.classList.add("hidden");
        });
    }

    if(closeMetaModal){
        closeMetaModal.addEventListener("click", () => {
            metaModal.classList.add("hidden");
        });
    }
});
</script>


<!-- Meta Pixel Js -->
<script>
document.getElementById('openMetaModal').addEventListener('click', () => {
  document.getElementById('metaModal').classList.remove('hidden');
  document.getElementById('metaModal').classList.add('flex');
});

document.getElementById('closeMetaModal').addEventListener('click', () => {
  document.getElementById('metaModal').classList.add('hidden');
});

// Save via AJAX
document.getElementById('saveMetaPixel').addEventListener('click', () => {
  let code = document.getElementById('metaPixelInput').value;

  fetch("{{ route('funnel.update.meta') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({ meta_pixel_code: code })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      Swal.fire("Success", data.message, "success");
      document.getElementById('metaModal').classList.add('hidden');
    } else {
      Swal.fire("Error", "Something went wrong!", "error");
    }
  });
});
</script>


<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Copy link button
    const copyBtn = document.getElementById('copyButton');
    const funnelLink = document.getElementById('funnelLink');

    if(copyBtn) {
        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(funnelLink.value).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Funnel link copied to clipboard',
                    timer: 1500,
                    showConfirmButton: false,
                });
            });
        });
    }

    // Activate Funnel via AJAX
    const activateForm = document.getElementById('activateFunnelForm');
    if(activateForm) {
        activateForm.addEventListener('submit', function(e){
            e.preventDefault();
            const url = this.action;
            const formData = new FormData(this);

            Swal.fire({
                title: 'Activating Funnel...',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false
            });

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                Swal.close();
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Funnel Activated!',
                        text: 'Your AI funnel is ready.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Something went wrong', 'error');
                }
            })
            .catch(err => {
                Swal.close();
                Swal.fire('Error', 'Something went wrong', 'error');
            });
        });
    }

   // Update Link button
const updateBtn = document.getElementById('updateLinkBtn');
if(updateBtn) {
    updateBtn.addEventListener('click', () => {
        Swal.fire({
            title: 'Update Funnel Link',
            input: 'text',
            inputLabel: 'Enter new page link (only letters, numbers, and ( - or dash ) allowed)',
            inputValue: '{{ $funnel->page_link ?? "" }}',
            showCancelButton: true,
            confirmButtonText: 'Update',
            preConfirm: (newLink) => {
                if(!newLink) {
                    Swal.showValidationMessage('Link cannot be empty');
                    return false;
                }
                // ✅ Allow only letters, numbers, and dash
                const regex = /^[a-zA-Z0-9-]+$/;
                if(!regex.test(newLink)) {
                    Swal.showValidationMessage('Only letters, numbers, and (- or dash) are allowed. Special characters like @ # . and soon are not allowed.');
                    return false;
                }
                return newLink;
            },
            didOpen: () => {
                const input = Swal.getInput();
                if(input) input.select();
            }
        }).then((result) => {
            if(result.isConfirmed) {
                const newLink = result.value;
                fetch('{{ route("funnel.updateLink") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ page_link: newLink })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Funnel link updated successfully',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message || 'Something went wrong', 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Something went wrong', 'error');
                });
            }
        });
    });
}

</script>

    </div>
</div>


@endsection
