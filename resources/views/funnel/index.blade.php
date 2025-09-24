@extends('layouts.users')

@section('title', 'My Funnel')

@section('content')

<div class="container m-auto p-4 sm:p-8 max-w-full space-y-8">


 <!-- Meta Pixel Helper -->
    <button 
        id="openMetaModal"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Setup Meta Pixel Code
    </button>

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
                placeholder="Paste your Meta Pixel code here...">{{ $funnel->meta_pixel_code }}</textarea>

        <div class="flex justify-end gap-3 mt-4">
        <button id="closeMetaModal" class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
        <button id="saveMetaPixel" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
        </div>
    </div>
    </div>




    <div class="w-full bg-white  rounded-3xl border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="flex justify-between items-center px-6 py-4 bg-blue-600 text-white">
            <h2 class="text-xl font-semibold">Update Page Buttons</h2>
            <a href="{{ route('funnel.editButtons') }}" 
               class="bg-white text-gray-500 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
               Edit 
            </a>
        </div>

        <!-- Card Body -->
        <div class="px-6 py-6 space-y-6 relative">
          <!-- Trust Indicator -->
            <div class="flex items-center justify-center gap-3 text-gray-700 font-medium mt-8">
                <span class="material-symbols-outlined text-purple-500 text-3xl sm:text-4xl">auto_mode</span>
                <span class="text-sm sm:text-lg md:text-xl">Smart Funnels Trusted by <span class="font-semibold">1M+ Users</span></span>
            </div>


            <!-- Funnel Title -->
           <h3 class="text-xl font-bold text-center text-gray-800 mt-6">
            Grab Your Funnel & Turn Visitors Into Paying Customers!
            </h3>



            @if($funnel)
                <!-- Buttons responsive wrapper -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">

                    <!-- Funnel Link Input -->
                    <input id="funnelLink" type="text" value="{{ url($funnel->page_link) }}" readonly
                           class="flex-1 border border-gray-300 rounded-2xl px-4 py-3 cursor-pointer focus:outline-none "
                           onclick="this.select();">

                    <!-- Copy Button -->
                    <button id="copyButton" type="button"
                        class="w-full sm:w-auto px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl
                               shadow-md hover:shadow-lg
                               flex items-center gap-2 justify-center font-semibold">
                        <i class="fa-solid fa-copy"></i>
                        Copy Link
                    </button>

                    <!-- Update Link Button -->
                    <button id="updateLinkBtn" type="button"
                        class="w-full sm:w-auto px-5 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-2xl
                               shadow-md flex items-center gap-2 justify-center font-semibold">
                        <i class="fa-solid fa-pencil"></i>
                        Update Link
                    </button>
                </div>
            @else
                <!-- Activate Funnel Button -->
                <form id="activateFunnelForm" method="POST" action="{{ route('funnel.activate') }}">
                    @csrf
                   <button type="submit"
                        class="w-full max-w-md md:max-w-lg py-4 bg-green-600 hover:bg-green-700
                            text-white font-semibold rounded-2xl shadow-lg transition-all duration-300 
                            flex items-center justify-center gap-3 mx-auto">
                    <span class="material-symbols-outlined text-white">smart_toy</span>
                    Activate My AI Funnel
                </button>

                </form>
            @endif

            <!-- Footer -->
            <p class="text-xs text-gray-400 text-center mt-4">Powered by GLC · No credit card needed · Instant setup</p>

        </div>
    </div>
</div>



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
