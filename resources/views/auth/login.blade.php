@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    
    <div class="bg-white/5 backdrop-blur-md border border-white/30 rounded-xl p-8 w-full max-w-md shadow-lg">
        <h1 class="text-3xl font-extrabold mb-8 text-center text-white">Login</h1>

        <form id="loginForm" method="POST" action="{{ route('login.post') }}">
            @csrf

            <label class="block mb-2 text-white font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full p-3 border border-white/50 rounded-lg mb-6 bg-gray-100 text-gray-800 placeholder-gray-500
                       focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                id="email" placeholder="Enter your email">

            <label class="block mb-2 text-white font-semibold">Password</label>
            <div class="flex items-center mb-6 relative">
                <input type="password" name="password" required
                    class="flex-grow p-3 pr-10 border border-white/50 rounded-lg bg-gray-100 text-gray-800 placeholder-gray-500
                           focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                    id="password" placeholder="Enter your password">
                <span toggle="#password"
                    class="material-icons absolute right-3 top-3 cursor-pointer text-gray-500 toggle-password">visibility</span>
            </div>

            <div class="flex items-center justify-between mb-4 text-white">
                <label for="remember" class="flex items-center select-none cursor-pointer font-medium">
                    <input type="checkbox" id="remember" name="remember" 
                        class="mr-3 h-4 w-4 text-blue-600 focus:outline-none border-white/50 rounded transition duration-200">
                    Remember Me
                </label>
                <a href="{{ route('forgot-password.form') }}" 
                   class="text-gray-50 hover:text-gray-50 hover:underline font-semibold transition-colors duration-200">
                   Forgot Password?
                </a>
            </div>

           <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 
                   focus:outline-none focus:ring-2 focus:ring-white 
                   shadow-[0_0_10px_2px_rgba(255,255,255,0.5)] transition duration-300">
            Login
        </button>

        </form>

        <p class="mt-6 text-center text-white/80">
            Don’t have an account yet? 
            <a href="{{ route('register') }}" class="text-gray-50 font-semibold underline hover:text-gray-50">Register</a>
        </p>
    </div>
</div>
@endsection




@section('js')
<script>
$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        text: 'Redirecting...',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didClose: () => {
                            window.location.href = response.redirect;
                        }
                    });
                }
            },
            error: function (xhr) {
                let message = "Something went wrong. Try again.";
                if (xhr.status === 401 || xhr.status === 403) {
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: message
                });
            }
        });
    });

    $(document).on('click', '.toggle-password', function () {
        let input = $($(this).attr("toggle"));
        let type = input.attr("type") === "password" ? "text" : "password";
        input.attr("type", type);
        $(this).text(type === "password" ? "visibility" : "visibility_off");
    });
});
</script>
@endsection
