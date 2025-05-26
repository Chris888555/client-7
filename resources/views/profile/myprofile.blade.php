@extends('layouts.users')

@section('title', 'Manage Your Account')

@section('content')


<div class="container m-auto p-4 sm:p-8 max-w-full">

      <x-page-header-text 
    title="Manage Your Account"
    subtitle="Update your profile photo and personal details."
/>


        <!-- Profile Section -->
        <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 flex flex-col md:flex-row gap-8">

            <!-- Left: Profile Image Upload -->
            <div class="flex flex-col items-center md:items-start w-full md:w-1/3">
                <div class="relative">
                    <img id="profile-photo-preview"
                    src="{{ auth()->user()->picture ?? asset('assets/profile_picture/profile.png') }}"
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
            <form id="crop-form" method="POST" action="{{ route('myprofile.upload') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="cropped_profile_photo" id="cropped_profile_photo">
            </form>


            
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