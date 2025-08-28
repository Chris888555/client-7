@extends('layouts.guest')

@section('title', 'Register')

@section('content')


<style>
  .grecaptcha-badge {
    opacity: 0.3;
    transform: scale(0.9);
  }
</style>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white/5 backdrop-blur-md border border-white/30 rounded-xl p-8 w-full max-w-md shadow-lg">
        <h1 class="text-3xl font-extrabold mb-8 text-center text-white">Create Account</h1>

        <form id="registerForm" method="POST" action="{{ route('register.post') }}">
            @csrf

            <label class="block mb-2 text-white font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full p-3 border border-white/50 rounded-lg mb-6 bg-gray-100 text-gray-800 placeholder-gray-500
                       focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                id="name" placeholder="Enter your name">

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

            <label class="block mb-2 text-white font-semibold">Confirm Password</label>
            <div class="flex items-center mb-6 relative">
                <input type="password" name="password_confirmation" required
                    class="flex-grow p-3 pr-10 border border-white/50 rounded-lg bg-gray-100 text-gray-800 placeholder-gray-500
                           focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                    id="password_confirmation" placeholder="Confirm your password">
                <span toggle="#password_confirmation"
                    class="material-icons absolute right-3 top-3 cursor-pointer text-gray-500 toggle-password">visibility</span>
            </div>

          
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 
                       focus:outline-none focus:ring-2 focus:ring-white 
                       shadow-[0_0_10px_2px_rgba(255,255,255,0.5)] transition duration-300">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-white/80">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-gray-50 font-semibold underline hover:text-gray-50">Login</a>
        </p>
    </div>
</div>

  {{-- Invisible reCAPTCHA --}}
    {!! NoCaptcha::renderJs() !!}
    {!! NoCaptcha::display(['data-size' => 'invisible', 'data-callback' => 'onReCaptchaSuccess']) !!}

@endsection

@section('js')
<script>
function onReCaptchaSuccess(token) {
    let form = $('#registerForm');
    let data = form.serialize();

    $('input').removeClass('border-red-500');

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: data,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful!',
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
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let field in errors) {
                    errorMessages += errors[field][0] + '\n';
                    $(`[name="${field}"]`).addClass('border-red-500');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: errorMessages,
                    showConfirmButton: false, 
                    timer: 3000,
                    timerProgressBar: true
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong',
                    text: 'Please try again later.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        }
    });
}

$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        grecaptcha.execute(); // trigger invisible recaptcha
    });
});

$(document).on('click', '.toggle-password', function () {
    let input = $($(this).attr("toggle"));
    let type = input.attr("type") === "password" ? "text" : "password";
    input.attr("type", type);
    $(this).text(type === "password" ? "visibility" : "visibility_off");
});
</script>


@endsection
