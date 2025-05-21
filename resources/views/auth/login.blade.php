@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl p-6 sm:p-10">
    <div class="text-center mb-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-500">Welcome Back!</h1>
        <p class="text-sm text-gray-500 mt-2">Log in to your NutriInnovations Account</p>
    </div>

    {{-- Show general error message --}}
    @if ($errors->any())
    <div class="mb-4 text-sm text-red-600 text-center">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

        <div class="mb-6">
            <label for="email" class="block text-sm font-semibold text-gray-500 mb-1">Username</label>
            <input type="text" name="username" id="username" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300"
                value="{{ old('email') }}">
        </div>

        <div class="mb-6 relative">
            <label for="password" class="block text-sm font-semibold text-gray-500 mb-1">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300 pr-10">
            <span id="togglePassword" class="absolute right-3 top-9 cursor-pointer text-gray-400">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>

        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded" {{ old('remember') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-500">Remember Me</span>
            </label>
            <a href="/mlm/forgot-password" class="text-sm text-gray-500 hover:underline">Forgot Password?</a>
        </div>

        <button type="click" id="btnLogin" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg transition duration-200"> Login </button>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('userjs/alert.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            const isPassword = password.type === 'password';
            password.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        });
    });
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnLogin").click(function(e){
            e.preventDefault();
            var form = $(this);
            $.post('/auth/login',{
                username: $("#username").val(),
                password: $("#password").val()
            }, function(data){
                if(data.status){
                    success_auto_to("Redirecting...", data.link);
                }else{
                    error(data.msg)
                }
            }, 'json');
        });

    });
</script>
@endsection