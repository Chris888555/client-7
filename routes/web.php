<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
   return view('home');
});

Route::get('/company-profile', function () {
   return view('company-profile');
});

Route::get('/products', function () {
   return view('products');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Users Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Dashboard
Route::middleware('auth')->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

