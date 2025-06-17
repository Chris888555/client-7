@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="">
    <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Login</h1>

    <form id="loginForm" method="POST" action="{{ route('login.post') }}">
        @csrf

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

        <button type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
            Login
        </button>
    </form>

    <p class="mt-6 text-center text-gray-600">
        Don’t have an account yet? <a href="{{ route('register') }}"
            class="text-green-600 font-semibold underline hover:text-green-700">Register</a>
    </p>
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
