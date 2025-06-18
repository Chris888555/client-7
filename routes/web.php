<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ManageUserController;

use App\Http\Controllers\Materials\MaterialController;
use App\Http\Controllers\Academy\AcademyController;

use App\Http\Controllers\UserTool\DownloadableController;

use App\Http\Controllers\Funnels\FunnelController;

use App\Http\Controllers\Funnels\AdminManageFunnel;

use App\Http\Controllers\User\VideoProgressController;

use App\Http\Controllers\User\FunnelViewController;

use App\Http\Controllers\Page\UserPageController;

Route::get('/', function () {
   return view('home');
});



// Guest routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/thankyou', function () {return view('auth.thankyou');})->name('thankyou');




###########################################################################################################################
// User Routes
###########################################################################################################################

Route::middleware(['auth', 'usersession'])->group(function () {

    Route::get('/dashboard', [UserPageController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/myprofile', [ProfileController::class, 'showProfileForm'])->name('user.myprofile');
    Route::post('/upload-profile-photo', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload');

    Route::put('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/category/{category}', [MaterialController::class, 'showByCategory'])->name('materials.showByCategory');

    Route::get('/academy', [AcademyController::class, 'showAcademy'])->name('academy.show');

    Route::get('/funnels/funnel-activate', [FunnelController::class, 'showActivateForm'])->name('funnels.activate.form');

    Route::get('/funnels/update', [FunnelController::class, 'showtable'])->name('funnels.showtable');


});

###########################################################################################################################
// Sales FUnnel Routes
###########################################################################################################################
 Route::post('/funnels/funnel-activate', [FunnelController::class, 'activate'])->name('funnels.activate');
 Route::post('/funnels/{id}/update-link', [FunnelController::class, 'updateLink'])->name('funnel.updateLink');

 Route::post('/funnels/blocks/update', [FunnelController::class, 'update'])->name('blocks.update');
 Route::post('/funnels/{block}/toggle-active', [FunnelController::class, 'toggleActive'])->name('blocks.toggleActive');
 Route::post('/blocks/{id}/sort-order', [FunnelController::class, 'updateSortOrder'])->name('blocks.updateSortOrder');



Route::post('/funnels/save-video-progress', [VideoProgressController::class, 'store'])->name('video.progress.store');


 
###########################################################################################################################
// Sales FUnnel Routes Guest 
###########################################################################################################################
 Route::get('/{page_link}', [FunnelController::class, 'viewFunnel'])->name('funnel.view');



###########################################################################################################################
// Admin Routes
###########################################################################################################################

Route::middleware(['auth', 'adminsession'])->group(function () {

   Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

   Route::get('/admin/manage-users', [ManageUserController::class, 'showManageUser'])->name('admin.manage-users');
   
   Route::get('/admin/materials/create', [MaterialController::class, 'create'])->name('materials.create');
   Route::get('/admin/materials/update', [MaterialController::class, 'showpage'])->name('materials.show');
  
   Route::get('/admin/academy-edit/', [AcademyController::class, 'showAcademyupdate'])->name('academy.edit');
   Route::get('/admin/academy/create', [AcademyController::class, 'show'])->name('academy.create');
 
   Route::get('/admin/funnels/list', [AdminManageFunnel::class, 'showlist'])->name('list.showtable');
   Route::get('/admin/funnels/manage', [AdminManageFunnel::class, 'showtable'])->name('manage.showtable');
  
  
});
###########################################################################################################################
// Manage Users Routes
###########################################################################################################################
  Route::post('/admin/users/bulk-action', [ManageUserController::class, 'bulkAction'])->name('admin.bulk-action');
###########################################################################################################################
// Materials Routes
###########################################################################################################################
   Route::post('/admin/materials', [MaterialController::class, 'store'])->name('materials.store');
   Route::post('/admin/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
   Route::post('/materials/bulk-delete', [MaterialController::class, 'bulkDelete'])->name('materials.bulkDelete');
###########################################################################################################################
// Academy Routes
###########################################################################################################################
   Route::post('/admin/academy/store', [AcademyController::class, 'store'])->name('academy.store');
   Route::post('/admin/academy-edit/{id}', [AcademyController::class, 'update'])->name('academy.update');
   Route::post('/academy/bulk-delete', [AcademyController::class, 'bulkDelete'])->name('academy.bulkDelete');

   

   Route::post('/admin/funnels/manage/blocks/update', [AdminManageFunnel::class, 'update'])->name('manage.blocks.update');
   Route::post('/admin/funnels/manage/{block}/toggle-active', [AdminManageFunnel::class, 'toggleActive'])->name('manage.blocks.toggleActive');
   Route::post('/admin/blocks/manage/{id}/sort-order', [AdminManageFunnel::class, 'updateSortOrder'])->name('manage.blocks.updateSortOrder');

   Route::post('/admin/funnels/update-editable', [AdminManageFunnel::class, 'updateEditable'])->name('admin.funnels.update-editable');
