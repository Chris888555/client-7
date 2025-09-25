<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ThemeSettingController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProfileController;

use App\Http\Controllers\ForgotPasswordController;

use App\Http\Controllers\User\UserDashboardController;

use App\Http\Controllers\Admin\ManageUserController;

use App\Http\Controllers\Funnel\FunnelController;

use App\Http\Controllers\Funnel\LeadController;

use App\Http\Controllers\Materials\MaterialController;

use App\Http\Controllers\Admin\PackageController;

use App\Http\Controllers\User\PaymentMethodController;

use App\Http\Controllers\User\OrderController;

use App\Http\Controllers\Academy\AcademyController;

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



Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot-password.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPassword'])->name('forgot-password.send');



###########################################################################################################################
###########################################################################################################################
// User Routes
###########################################################################################################################
###########################################################################################################################

Route::middleware(['auth', 'usersession'])->group(function () {

Route::get('/user/home/dashboard', [UserDashboardController::class, 'viewDashboard'])->name('user.dashboard');


Route::get('/myprofile', [ProfileController::class, 'showProfileForm'])->name('user.myprofile');
Route::post('/upload-profile-photo', [ProfileController::class, 'uploadProfilePhoto'])->name('profile.upload');


Route::put('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');


Route::get('/my-funnel', [FunnelController::class, 'index'])->name('funnel.index');
Route::post('/my-funnel/activate', [FunnelController::class, 'activate'])->name('funnel.activate');
Route::post('/funnel/update-link', [FunnelController::class, 'updateLink'])->name('funnel.updateLink');


Route::get('funnel/buttons', [FunnelController::class, 'editButtons'])->name('funnel.editButtons');
Route::post('funnel/buttons/update', [FunnelController::class, 'updateButtons'])->name('funnel.updateButtons');
Route::post('/funnel/update-meta', [FunnelController::class, 'updateMetaPixel'])->name('funnel.update.meta');



Route::get('/materials/images', [MaterialController::class, 'showByCategory'])->name('materials.showByCategory');


Route::get('/my-funnel/leads', [LeadController::class, 'myLeads'])->name('funnel.myLeads');
Route::get('/user/leads/export', [LeadController::class, 'exportLeads'])->name('user.leads.export');
Route::post('/leads/bulk-delete', [LeadController::class, 'bulkDelete'])->name('user.leads.bulkDelete');




Route::get('/payment-method/create', [PaymentMethodController::class, 'create'])->name('payment-method.create');
Route::get('/payment-method/list', [PaymentMethodController::class, 'showtable'])->name('payment-method.list');
Route::post('/payment-method/store', [PaymentMethodController::class, 'store'])->name('payment-method.store');
Route::post('/payment-method/update', [PaymentMethodController::class, 'update'])->name('payment-method.update');
Route::post('/payment-method/delete', [PaymentMethodController::class, 'delete'])->name('payment-method.delete');


Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/my-orders/bulk-delete', [OrderController::class, 'bulkDelete'])->name('user.orders.bulkDelete');


Route::get('/analytics/page-view', [LeadController::class, 'pageAnalytics'])->name('user.pageAnalytics');



 // Academy
Route::get('academy/courses', [AcademyController::class, 'viewCourses'])->name('user.academy.courses');
Route::get('/academy/module/{id}/lessons', [AcademyController::class, 'viewModuleLessonsByCategory'])->name('academy.module.lessons');
Route::post('/academy/lesson/complete', [AcademyController::class, 'completeLesson']);
Route::get('/academy/module/{module}/check-completion', [AcademyController::class, 'checkCompletion']);
Route::get('/academy/module/{module}/certificate', [AcademyController::class, 'viewCertificate']);


});


Route::get('/{page_link}', [LeadController::class, 'landingPage'])->name('funnel.landingPage');
Route::post('/store', [LeadController::class, 'store'])->name('funnel.store');
Route::get('/sales/{page_link}', [LeadController::class, 'salesPage'])->name('funnel.salesPage');


Route::get('/choose-package/{page_link}', [PackageController::class, 'choose'])->name('buy.now.choose');



Route::post('/checkout/store/{page_link}', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/checkout/thank-you/{page_link}', [OrderController::class, 'thankYou'])->name('checkout.thank-you');




###########################################################################################################################
###########################################################################################################################
// Admin Routes
###########################################################################################################################
###########################################################################################################################

Route::middleware(['auth', 'adminsession'])->group(function () {

  Route::get('/admin/home/dashboard', function () {return view('admin.home.dashboard');})->name('admin.dashboard');
  
  Route::get('/admin/theme/settings', [ThemeSettingController::class, 'edit'])->name('admin.theme.settings');
  Route::post('/admin/theme/store', [ThemeSettingController::class, 'update'])->name('admin.theme.update');


  Route::get('/admin/manage-users', [ManageUserController::class, 'showManageUser'])->name('admin.manage-users');
  Route::post('/admin/users/bulk-action', [ManageUserController::class, 'bulkAction'])->name('admin.bulk-action');


  Route::get('/admin/materials/create', [MaterialController::class, 'create'])->name('materials.create');
  Route::get('/admin/materials/update', [MaterialController::class, 'showpage'])->name('materials.show');
  Route::post('/admin/materials', [MaterialController::class, 'store'])->name('materials.store');
  Route::post('/admin/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
  Route::post('/materials/bulk-delete', [MaterialController::class, 'bulkDelete'])->name('materials.bulkDelete');


  Route::get('/admin/packages/create', [PackageController::class, 'create'])->name('packages.create');
  Route::post('/admin/packages', [PackageController::class, 'store'])->name('packages.store');

  Route::get('/admin/packages/list', [PackageController::class, 'list'])->name('packages.list');
  Route::post('/admin/update', [PackageController::class, 'update'])->name('packages.update');
  Route::post('/admin/delete', [PackageController::class, 'delete'])->name('packages.delete');


  // Course create
  Route::get('/admin/academy/course', [AcademyController::class, 'create'])->name('academy.course.index');
  Route::post('/admin/academy/course', [AcademyController::class, 'store'])->name('academy.course.store');

  // Module create
  Route::get('/admin/academy/course/{id}/modules', [AcademyController::class, 'manageModules'])->name('academy.manageModules');
  Route::post('/admin/academy/course/{id}/module', [AcademyController::class, 'storeModule'])->name('academy.module.store');

  // Lesson create
  Route::get('/admin/academy/module/{id}/lessons', [AcademyController::class, 'manageLessons'])->name('academy.manageLessons');
  Route::post('/admin/academy/module/{module_id}/lesson', [AcademyController::class, 'storeLesson'])->name('academy.lesson.store');

  // Course update
  Route::post('admin/academy/courses/bulk-delete', [AcademyController::class, 'bulkDelete'])->name('admin.academy.course.bulkDelete');
  Route::post('/admin/course/{id}/update', [AcademyController::class, 'update'])->name('academy.course.update');
  Route::post('/admin/course/{id}/toggle-visibility', [AcademyController::class, 'toggleVisibility'])->name('admin.course.toggle-visibility');
  Route::post('/admin/courses/reorder/manual', [AcademyController::class, 'reorderManual'])->name('admin.course.reorder.manual');

  // Module update
  Route::post('/admin/module/{module_id}/update', [AcademyController::class, 'updateModule'])->name('academy.module.update');
  Route::delete('/admin/module/{module_id}/delete', [AcademyController::class, 'deleteModule'])->name('academy.module.delete');

  // Lesson update
  Route::post('/admin/lesson/{id}/update', [AcademyController::class, 'updateLesson'])->name('academy.lesson.update');
  Route::delete('/admin/lesson/{id}/delete', [AcademyController::class, 'deleteLesson'])->name('academy.lesson.delete');
  Route::post('/admin/module/{module_id}/lessons/reorder', [AcademyController::class, 'reorderLessons'])->name('academy.lesson.reorder');

});
