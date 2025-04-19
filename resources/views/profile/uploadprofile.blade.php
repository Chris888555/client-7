@extends('layouts.app')

@section('title', 'Manage Your Account')

@section('content')

@include('includes.nav')



<body class="bg-gray-100 flex items-center justify-center px-2  ">
    <div class="container m-auto p-4 sm:p-8 max-w-full">
      
 <h1 class="text-2xl md:text-3xl font-bold text-left">Manage Your Account</h1>
        <p class="text-gray-600 text-left mb-4">Update your profile photo and personal details.</p>



        @if ($errors->any())
    <div id="error-message"
        class="flex w-full overflow-hidden bg-red-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
        <div class="flex items-center justify-center w-12 bg-red-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM22.5 26.6666H17.5V21.6666H22.5V26.6666ZM22.5 18.3333H17.5V13.3333H22.5V18.3333Z" />
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-red-500 dark:text-red-400">Error</span>
                <ul class="list-disc list-inside text-sm text-gray-600 dark:text-gray-200">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 5000);
    </script>
@endif

    

       <!-- Profile Section -->
<div class="bg-white p-8 rounded-2xl border-2 border-gray-200 flex flex-col md:flex-row gap-8">
    
    <!-- Left: Profile Image Upload -->
    <div class="flex flex-col items-center md:items-start w-full md:w-1/3">
        <div class="relative">
                <img id="profile-photo-preview"
                    src="{{ asset('storage/' . ($user->profile_picture ? $user->profile_picture : 'profile_photos/' . $user->default_profile)) }}"
                    alt="Profile Photo"
                    class="h-24 w-24 object-cover rounded-full border-8 border-gray-300 cursor-pointer"
                    onclick="triggerFileInput()">

                <label for="profile_photo"
                    class="absolute bottom-0 right-[-13px]  text-white rounded-full p-2 cursor-pointer">
                    <img src="https://static.wixstatic.com/media/632b5a_5ba6f3f001ca4e61a7fd95228e1bffba~mv2.png"
                        alt="Upload Image Icon" class="w-[30px] h-[30px] ">
                </label>
                <input type="file" id="profile_photo" name="profile_photo" style="display: none;"
                    onchange="previewImage(event)">
            </div>
        <p class="mt-4 text-sm text-gray-500">Click the image to upload a new profile photo</p>
    </div>

    <!-- Hidden Form for Cropped Image Data -->
        <form id="crop-form" method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <input type="hidden" name="cropped_profile_photo" id="cropped_profile_photo">
        </form>

    <!-- Right: Update Form -->
    <div class="w-full md:w-2/3">
        <form action="{{ route('profile.update-details') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="text-left">
                <button type="submit"
                     class="rounded-lg bg-blue-700 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center">
    
     <!-- SVG Icon -->
        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
            <circle cx="12" cy="14" r="2" />
            <polyline points="14 4 14 8 8 8 8 4" />
        </svg>

                    Update Details
                </button>
            </div>
        </form>

        <!-- Change Password Section -->
<div class=" mt-8 ">
    
    <form action="{{ route('profile.change-password') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="mb-4">
            <label for="current_password" class="block font-semibold mb-1">Current Password</label>
            <input type="password" name="current_password" id="current_password"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label for="new_password" class="block font-semibold mb-1">New Password</label>
            <input type="password" name="new_password" id="new_password"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Confirm New Password -->
        <div class="mb-4">
            <label for="new_password_confirmation" class="block font-semibold mb-1">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="text-left">
            <button type="submit"
                 class="rounded-lg bg-blue-700 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center">
    
     <!-- SVG Icon -->
        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
            <circle cx="12" cy="14" r="2" />
            <polyline points="14 4 14 8 8 8 8 4" />
        </svg>

                Change Password
            </button>
        </div>
    </form>
</div>

    </div>
</div>




    <!-- Modal for Cropping Image -->
    <div id="crop-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-[90%] max-w-[500px]">
            <h3 class="text-xl font-bold mb-4">Crop Your Profile Photo</h3>
            <div class="flex justify-center mb-4">
                <img id="image-to-crop" src="" alt="Image to Crop" class="max-w-full rounded-lg">
            </div>
            <div class="flex justify-center space-x-4">
                <button id="crop-btn" class="bg-green-500 text-white p-2 rounded-md">Crop & Save</button>
                <button id="close-modal-btn" class="bg-red-500 text-white p-2 rounded-md">Cancel</button>
            </div>
    </div>

    </div>
    </main>
    <script>
    let cropper;
    const modal = document.getElementById('crop-modal');
    const imageInput = document.getElementById('profile_photo');
    const imagePreview = document.getElementById('profile-photo-preview');
    const imageToCrop = document.getElementById('image-to-crop');
    const cropBtn = document.getElementById('crop-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const cropForm = document.getElementById('crop-form');
    const croppedProfilePhotoInput = document.getElementById('cropped_profile_photo');

    // Trigger the file input when image or plus icon is clicked
    function triggerFileInput() {
        document.getElementById('profile_photo').click();
    }

    // Open modal and show selected image for cropping
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            imageToCrop.src = e.target.result;
            modal.classList.remove('hidden'); // Show the modal after image load
            cropper = new Cropper(imageToCrop, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
            });
        };
        reader.readAsDataURL(file);
    }

    // Crop and upload the image
    cropBtn.addEventListener('click', function() {
        const canvas = cropper.getCroppedCanvas();
        const croppedImage = canvas.toDataURL('image/jpeg');

        // Show the cropped image in the preview
        imagePreview.src = croppedImage;

        // Set the cropped image to the hidden input for submission
        croppedProfilePhotoInput.value = croppedImage;

        // Submit the form
        cropForm.submit();

        // Close the modal
        modal.classList.add('hidden');
    });

    // Close the modal without cropping
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
        }
    });
    </script>

@endsection