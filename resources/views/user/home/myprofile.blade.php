@extends('layouts.users')

@section('title', 'Manage Your Account')

@section('content')


<div class="container mx-auto p-4 sm:p-8 max-w-full">

 
    <div class="flex items-center justify-center bg-gray-50">
        <div class="w-full  bg-white p-6 sm:p-10 rounded-2xl border border-gray-200 flex flex-col md:flex-row gap-10">

            <!-- Left: Profile Image Upload -->
            <div class="flex flex-col items-center md:items-start w-full md:w-1/3">
                <div class="relative">
                    <img id="profile-photo-preview"
                        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/profile_picture/profile.png') }}"
                        alt="Profile Photo"
                        class="h-48 w-48 object-cover rounded-full border-8 border-gray-300 cursor-pointer"
                        onclick="triggerFileInput()">

                    <label for="profile_photo"
                        class="absolute bottom-2 right-3 bg-gray-300 p-1.5 rounded-full cursor-pointer shadow-md">
                        <img src="https://static.wixstatic.com/media/632b5a_5ba6f3f001ca4e61a7fd95228e1bffba~mv2.png"
                            alt="Upload Icon" class="w-6 h-6">
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" class="hidden"
                        onchange="previewImage(event)">
                </div>
                <p class="mt-3 text-center text-sm text-gray-500">Click image to upload a new photo</p>
            </div>

            <!-- Right: Forms and Buttons -->
            <div class="flex flex-col flex-1 gap-8">

                <!-- Tabs -->
                <div class="flex justify-center md:justify-start gap-4 border p-2 w-full rounded-2xl">
                    <button id="btnPersonal"
                        class="tab-btn hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl w-full">
                        Personal Info
                    </button>
                    <button id="btnPassword"
                        class="tab-btn hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl w-full">
                        Change Password
                    </button>


                </div>

                <!-- Personal Info Form -->
                <form id="formPersonal" action="{{ route('profile.updateInfo') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                            value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                            value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <x-button type="submit" icon="fa-solid fa-floppy-disk">Save Changes</x-button>

                </form>

                <!-- Change Password Form -->
                <form id="formPassword" action="{{ route('profile.updatePassword') }}" method="POST"
                    class="space-y-4 hidden">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="current_password" class="block text-sm font-medium">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                            required>
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium">New Password</label>
                        <input type="password" name="new_password" id="new_password"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                            required>
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium">Confirm New
                            Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                            required>
                    </div>
                    <x-button type="submit" icon="fa-solid fa-floppy-disk">Save Changes</x-button>

                </form>
            </div>
        </div>

        <!-- Hidden Crop Form -->
        <form id="crop-form" method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data"
            class="hidden">
            @csrf
            <input type="hidden" name="cropped_profile_photo" id="cropped_profile_photo">
        </form>
    </div>

    <!-- Modal for Cropping Image -->
    <div id="crop-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-[90%] max-w-[500px]">
            <h3 class="text-xl font-bold mb-4">Crop Your Profile Photo</h3>
            <div class="flex justify-center mb-4">
                <img id="image-to-crop" src="" alt="Image to Crop" class="max-w-full rounded-lg">
            </div>
            <div class="flex justify-center space-x-4">
                <button id="crop-btn" class="bg-green-500 text-white p-2 rounded-md flex items-center gap-2">
                    <i class="fa-solid fa-crop-simple"></i> Crop & Save
                </button>

                <button id="close-modal-btn" class="bg-red-500 text-white p-2 rounded-md flex items-center gap-2">
                    <i class="fa-solid fa-square-xmark"></i> Cancel
                </button>

            </div>
        </div>

    </div>
</div>
</main>
@endsection

@section('js')
<script>
let cropper;
const modal = document.getElementById('crop-modal');
const imageInput = document.getElementById('profile_photo');
const imagePreview = document.getElementById('profile-photo-preview');
const imageToCrop = document.getElementById('image-to-crop');
const cropBtn = document.getElementById('crop-btn');
const closeModalBtn = document.getElementById('close-modal-btn');
const croppedProfilePhotoInput = document.getElementById('cropped_profile_photo');

// Trigger file input
function triggerFileInput() {
    imageInput.click();
}

// Preview image
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        imageToCrop.src = e.target.result;
        modal.classList.remove('hidden');
        if (cropper) cropper.destroy();
        cropper = new Cropper(imageToCrop, {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 1,
        });
    };
    reader.readAsDataURL(file);
}

// Submit via AJAX
function submitCroppedImage(croppedImage) {
    const formData = new FormData();
    formData.append('cropped_profile_photo', croppedImage);
    formData.append('_token', '{{ csrf_token() }}');

    fetch("{{ route('profile.upload') }}", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message || 'Profile photo uploaded successfully.'
            }).then(() => {
                window.location.reload();
            });
            imagePreview.src = croppedImage;
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Upload Failed',
                text: 'An error occurred while uploading. Please try again.'
            });
        });
}

// Crop and submit
cropBtn.addEventListener('click', function() {
    const canvas = cropper.getCroppedCanvas();
    if (!canvas) return;

    const croppedImage = canvas.toDataURL('image/jpeg');
    modal.classList.add('hidden');
    cropper.destroy();
    submitCroppedImage(croppedImage);
});

// Close modal
closeModalBtn.addEventListener('click', function() {
    modal.classList.add('hidden');
    if (cropper) cropper.destroy();
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // Personal Info Form
    document.getElementById('formPersonal').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(async res => {
            const data = await res.json();

            if (res.status === 422) {
                const messages = Object.values(data.errors).flat();
                throw new Error(messages.join('\n')); 
            }

            if (!res.ok) throw new Error('Something went wrong.');

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message || 'Information Updated!',
                showConfirmButton: true,
            }).then(() => {
                // Reload page after successful update
                window.location.reload();
            });
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: err.message || 'Something went wrong',
                showConfirmButton: true,
            });
        });
    });

    // Password Update Form
    document.getElementById('formPassword').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();

            if (res.status === 422) {
                let messages = Object.values(data.errors).map(errArr => errArr[0]);
                throw new Error(messages.join('\n'));
            }

            if (!res.ok) throw new Error(data.message || 'Something went wrong.');

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message,
                showConfirmButton: true,
            }).then(() => {
                // Reload page after password update as well
                window.location.reload();
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Something went wrong.',
            });
        });
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnPersonal = document.getElementById('btnPersonal');
    const btnPassword = document.getElementById('btnPassword');
    const formPersonal = document.getElementById('formPersonal');
    const formPassword = document.getElementById('formPassword');

    btnPersonal.addEventListener('click', function() {
        formPersonal.classList.remove('hidden');
        formPassword.classList.add('hidden');

        // Active tab
        btnPersonal.classList.add('text-teal-600', 'bg-gray-100');
        btnPersonal.classList.remove('text-gray-800');

        // Inactive tab
        btnPassword.classList.add('text-gray-800');
        btnPassword.classList.remove('text-teal-600', 'bg-gray-100');
    });

    btnPassword.addEventListener('click', function() {
        formPassword.classList.remove('hidden');
        formPersonal.classList.add('hidden');

        // Active tab
        btnPassword.classList.add('text-teal-600', 'bg-gray-100');
        btnPassword.classList.remove('text-gray-800');

        // Inactive tab
        btnPersonal.classList.add('text-gray-800');
        btnPersonal.classList.remove('text-teal-600', 'bg-gray-100');
    });
});
</script>





@endsection