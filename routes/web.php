<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UsersDashboardController;

use App\Http\Controllers\Page\Userpagecontroller;
use App\Http\Controllers\Page\Adminpagecontroller;

use App\Http\Controllers\User\Accountcontroller;
use App\Http\Controllers\Admin\Codecontroller;

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
Route::get('/register-sponsor/{username}', [AuthController::class, 'registerWithSponsor']);
Route::post('/register', [AuthController::class, 'register'])->name('register.post');



##############################################################################################
// User Routes
##############################################################################################
Route::group(['middleware' => 'usersession'], function () {
    
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/income-stats', function () {return view('user.home.income-stats');})->name('income-stats');


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

// Admin dashboard
Route::group(['middleware' => 'adminsession'], function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/codes',[Adminpagecontroller::class, 'codes'])->name('admin-codes');

});
##############################################################################################
// Code controller
##############################################################################################
Route::post('/admin/code/generate',[Codecontroller::class, 'generate']);