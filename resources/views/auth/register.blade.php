@extends('layouts.guest')

@section('title', 'Register')

@section('content')

<div class="">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Register</h1>

    <form id="registerForm" method="POST" action="{{ route('register.post') }}">
        @csrf

        <label class="block mb-2 text-gray-700 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required
            class="w-full p-3 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
            id="name">

        <label class="block mb-2 text-gray-700 font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
            class="w-full p-3 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
            id="email">

        <label class="block mb-2 text-gray-700 font-semibold">Password</label>
        <div class="relative mb-6">
            <input type="password" name="password" required
                class="w-full p-3 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                id="password">
            <span toggle="#password"
                class="material-icons absolute right-3 top-3 cursor-pointer text-gray-500 toggle-password">visibility</span>
        </div>

        <label class="block mb-2 text-gray-700 font-semibold">Confirm Password</label>
        <div class="relative mb-6">
            <input type="password" name="password_confirmation" required
                class="w-full p-3 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                id="password_confirmation">
            <span toggle="#password_confirmation"
                class="material-icons absolute right-3 top-3 cursor-pointer text-gray-500 toggle-password">visibility</span>
        </div>


        <button type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-gray-600">
        Already have an account? <a href="{{ route('login') }}"
            class="text-green-600 font-semibold underline hover:text-green-700">Login</a>
    </p>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        $('input').removeClass('border-red-500');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
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
