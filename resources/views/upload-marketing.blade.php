<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <title>Upload Marketing Content</title>



</head>
<!-- Include Sidebar -->
@include('includes.nav')

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
      <div class="container w-full mt-0 mb-0 m-auto p-4 sm:p-8">
        <h1 class="text-xl font-bold text-left mb-6 text-gray-800">Upload Marketing Content</h1>

        <!-- Success Message -->
        @if(session('success'))
        <div id="success-message" <div
            class="mt-10 flex w-full  mx-auto  overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
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

        <div class="flex flex-col sm:flex-row items-center mb-8 gap-4">
            <!-- Left: Upload Form -->
            <div class="w-full sm:w-1/2 bg-white  p-8 rounded-2xl border-2 border-gray-200 shadow h-full sm:h-[600px]">
                <form action="{{ route('store.marketing') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label for="caption" class="block mb-4 text-sm font-medium text-gray-700">Caption:</label>
                        <textarea name="caption" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="4"></textarea>
                    </div>

                    <div
                        class="border-2 border-dashed border-gray-300 bg-white rounded-lg p-6 flex flex-col items-center justify-center text-center">
                        <svg class="text-indigo-500 w-12 h-12 mb-3" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V12M12 16V8m5 8V4M4 20h16" />
                        </svg>
                        <p class="text-sm text-gray-600">Upload an image (PNG, JPG, JPEG, GIF) - Max: 15MB</p>

                        <label
                            class="mt-4 w-40 text-white py-2 px-4 rounded-lg shadow-md cursor-pointer bg-gradient-to-br from-indigo-600 to-purple-500 transition-all duration-300 hover:brightness-110">
                            <input type="file" name="image" id="fileInput" accept="image/*" hidden required />
                            Choose File
                        </label>

                        <!-- File Path Display -->
                        <p id="filePath" class="mt-2 text-sm font-medium text-blue-600"></p>

                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-[70%] m-auto flex items-center justify-center gap-2 px-6 py-2 text-white rounded-lg shadow-md bg-green-600 transition-all duration-300 transform hover:scale-105 hover:brightness-110">
                            <svg class="h-5 w-5 text-white transition-all" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Upload Content
                        </button>


                    </div>
                </form>
            </div>

            <!-- Right: Uploaded Images -->

            <div class="w-full sm:w-[70%]">
                <!-- Scrollable List -->
                <div class="max-h-[600px] overflow-y-auto ">
                    <ul class="space-y-4">
                        @foreach($marketingContents as $content)
                        <li class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                            <!-- Image -->
                            <img src="{{ asset('storage/' . $content->image) }}"
                                class="w-16 h-16 object-cover rounded-lg">

                            <!-- Caption -->
                            <p class="text-gray-800 font-semibold flex-1">{{ Str::limit($content->caption, 50) }}</p>

                            <!-- Delete Button -->
                            <form action="{{ route('delete.marketing', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-2 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 text-sm">
                                    <svg class="h-5 w-5 text-white group-hover:text-gray-200 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>

                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <script>
        // Select the input field and the element to show the file path
        const fileInput = document.getElementById('fileInput');
        const filePathDisplay = document.getElementById('filePath');

        // Add event listener for when a file is selected
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];

            if (file) {
                // Show the file path below the upload button in blue color
                filePathDisplay.textContent = `File selected: ${file.name}`;
            } else {
                filePathDisplay.textContent = ''; // Clear if no file is selected
            }
        });
        </script>


</body>

</html>