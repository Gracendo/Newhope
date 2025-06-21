<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SigninController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/orphanage', [OrphanageController::class, 'index'])->name('orphanage');
Route::get('/profile', [ProfileController::class, 'index'])->name('Profile');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::get('/signin', [SigninController::class, 'index'])->name('signin');





//Auth Admin
Route::middleware(['setlanguage:backend'])->group(function (){
    Route::get('/auth/admin',[LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/auth/admin',[LoginController::class, 'adminLogin']);
    Route::get('/logout/admin',[AdminDashboardController::class, 'adminLogout'])->name('admin.logout');
});

//Admin Dashboard

Route::prefix('admin-dash')->middleware(['setlanguage:backend','adminGlobalVar'])->group(function () {
    Route::group(['namespace'=>'Admin'],function () {
        Route::get('/', [AdminDashboardController::class, 'adminIndex'])->name('admin.home');
        Route::get('/manageusers', [AdminDashboardController::class, 'manageUsers'])->name('admin.manageUsers');
        Route::get('/adduser', [AdminDashboardController::class, 'addUsers'])->name('admin.addUser');
        Route::get('/profile', [AdminDashboardController::class, 'profilePersonalInfo'])->name('admin.profilePersonalInfo');
        Route::get('/campaign', [AdminDashboardController::class, 'Campaign'])->name('admin.campaign');
        Route::get('/campaign_details', [AdminDashboardController::class, 'campaignDetails'])->name('admin.campaignDetails');

        Route::get('/profile-update', [AdminDashboardController::class, 'admin_profile'])->name('admin.profile');
        Route::post('/profile-update', [AdminDashboardController::class, 'admin_profile_update'])->name('admin.profile.update');
        Route::get('/password-change', [AdminDashboardController::class, 'admin_password'])->name('admin.password');
        Route::post('/password-change', [AdminDashboardController::class, 'admin_password_chagne'])->name('admin.password.change');





    });

}); 

//End admin-dashboard
 
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
