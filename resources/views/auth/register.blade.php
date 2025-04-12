@extends('layouts.app')

@section('title', 'Register')
<!-- Custom title for this page -->

@section('content')
<main class=" h-screen flex items-center justify-center px-4 overflow-y-auto">

    <div
        class="bg-white w-[95%] sm:w-[600px] md:w-[700px] lg:w-[500px] p-8 rounded-lg shadow-[0_3px_10px_rgb(0,0,0,0.2)]">
        <section>
            <h3 class="font-bold text-2xl text-gray-800 text-left">Create an Account</h3>
            <p class="text-gray-600 pt-2 text-left">Sign up to get started.</p>
        </section>


        <!-- Success Message -->
        @if(session('success'))
        <div id="success-message"
            class="mt-4 flex w-full overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 ">
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
        // Hide the alert message after 10 seconds
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 10000);
        </script>
        @endif



        <!-- Alert Message -->
        @if ($errors->any())
        <div id="alert-message"
            class="mt-4 flex w-full overflow-hidden bg-yellow-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-yellow-800">
            <div class="flex items-center justify-center w-12 bg-yellow-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-yellow-500 dark:text-yellow-400">Alert</span>
                    <p class="text-sm text-gray-600 dark:text-gray-200">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        <script>
        // Hide the alert message after 10 seconds
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 10000);
        </script>
        @endif



        <!-- Alert Message -->
        @if(Session::has('message'))
        <div id="alert-message"
            class="mt-4 flex w-full overflow-hidden bg-yellow-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-yellow-800">
            <div class="flex items-center justify-center w-12 bg-yellow-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-yellow-500 dark:text-yellow-400">Alert</span>
                    <p class="text-sm text-gray-600 dark:text-gray-200"> {{ Session::get('message') }}</p>
                </div>
            </div>
        </div>

        <script>
        // Hide the alert message after 10 seconds
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 10000);
        </script>
        @endif


        <section class="mt-10">
            <form class="flex flex-col" method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="name">Full Name</label>
                    <input type="text" id="name" name="name" required
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3"
                        value="{{ old('name') }}">
                </div>

                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="email" id="email" name="email" required
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3"
                        value="{{ old('email') }}">
                </div>

                <!-- Referral Code (Hidden) -->
                <input type="hidden" name="referral_code" value="{{ $referralCode }}">


                <div class="mb-6 pt-3 rounded bg-gray-200 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3 pr-10">
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                        onclick="togglePassword('password', 'eyeIcon1')">
                        <i id="eyeIcon1" class="fas fa-eye text-gray-600"></i>
                    </span>
                </div>

                <div class="mb-6 pt-3 rounded bg-gray-200 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password_confirmation">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3 pr-10">
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                        onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                        <i id="eyeIcon2" class="fas fa-eye text-gray-600"></i>
                    </span>
                </div>

                <button
                    class="bg-gradient-to-br from-indigo-600 to-purple-500 text-white font-bold py-4 rounded shadow-lg hover:shadow-xl transition duration-200 hover:from-indigo-700 hover:to-purple-600"
                    type="submit">
                    Sign Up
                </button>
            </form>
        </section>

        <div class="text-center mt-6">
            <a href="{{ url('auth/google') }}" class="w-full">
                <button
                    class="w-full px-4 py-3 border flex gap-3 items-center justify-center border-slate-200 dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                    <img class="w-8 h-8" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy"
                        alt="Google logo" />
                    <span class="font-semibold">Sign up with Google</span>
                </button>
            </a>
        </div>


        <div class="text-center mt-6">
            <p class="text-gray-800">Already have an account? <a href="{{ route('login') }}"
                    class="font-bold hover:underline">Sign in</a>.</p>
        </div>
    </div>
</main>

<script>
function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
</body>

</html>