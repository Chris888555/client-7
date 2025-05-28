<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UsersDashboardController;

use App\Http\Controllers\ProfileSettings\MyProfileController;

use App\Http\Controllers\Materials\MaterialController;

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

   // User Userpagecontroller for dashboard and other user-related pages

    Route::get('/myprofile', [MyProfileController::class, 'index'])->name('myprofile.view');
    Route::post('/myprofile/upload', [MyProfileController::class, 'upload'])->name('myprofile.upload');

    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/type/{type}', [MaterialController::class, 'showByCategory'])->name('materials.showByType');
    
    Route::get('/', [Userpagecontroller::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard', [Userpagecontroller::class, 'index'])->name('user.dashboard');
    Route::get('/teams',[Userpagecontroller::class, 'teams']);
    Route::get('/add-new-account',[Userpagecontroller::class, 'addNewAccount']);
    Route::get('/income-stats', [Userpagecontroller::class, 'incomeStats'])->name('income-stats');

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

   // User Adminpagecontroller for dashboard and other user-related pages

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');

    Route::get('/admin/codes',[Adminpagecontroller::class, 'codes'])->name('admin-codes');
    Route::get('/admin/codes/create-package',[Adminpagecontroller::class, 'codeCreatePackage']);

});
##############################################################################################
// Code controller
##############################################################################################
Route::post('/admin/code/generate',[Codecontroller::class, 'generate']);
Route::post('/admin/code/createPackage',[Codecontroller::class, 'createPackage']);