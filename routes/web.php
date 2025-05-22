<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Page\Userpagecontroller;

use App\Http\Controllers\User\Accountcontroller;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');



##############################################################################################
// User Routes
##############################################################################################
// Users Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Income Stats
Route::middleware('auth')->group(function () {
    Route::get('/income-stats', function () {
        return view('main-pages.income-stats');
    })->name('income-stats');
});

Route::group(['middleware' => 'usersession'], function () {

    Route::get('/',[Userpagecontroller::class, 'index']);
    Route::get('/teams',[Userpagecontroller::class, 'teams']);
    Route::get('/add-new-account',[Userpagecontroller::class, 'addNewAccount']);

});
##############################################################################################
// Account controller
##############################################################################################
Route::post('/user/addNewAccount',[Accountcontroller::class, 'addNewAccount']);



##############################################################################################
// Admin Routes
##############################################################################################

