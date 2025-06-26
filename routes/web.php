<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\CampaignsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\CampaignDetailController;
use App\Http\Controllers\DonationController;
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
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/orphanage', [OrphanageController::class, 'index'])->name('orphanage');
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::get('/profile', [ProfileController::class, 'index'])->name('Profile');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');

// Campaign routes
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaign');
Route::get('/campaigns/{id}', [CampaignDetailController::class, 'show'])->name('campaign.details');

//Auth Admin
Route::middleware(['setlanguage:backend'])->group(function (){
    Route::get('/auth/admin',[LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/auth/admin',[LoginController::class, 'adminLogin']);
    Route::get('/logout/admin',[AdminDashboardController::class, 'adminLogout'])->name('admin.logout');
});

/*----------------------------------------------------------------------------------------------------------------------------
| User login - Registration
|----------------------------------------------------------------------------------------------------------------------------*/
//user login
    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/ajax-login',[HomeController::class, 'ajax_login'])->name('user.ajax.login');
    Route::post('/login',[LoginController::class, 'login']);
    Route::get('/register',[SignupController::class, 'showRegistrationForm'])->name('user.register');

//user email verify
    Route::get('/user/email-verify',[UserDashboardController::class, 'user_email_verify_index'])->name('user.email.verify');


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
        Route::post('/donation_management', [Donationadmincontroller::class, 'index'])->name('donation_management');


        Route::post('/campaigns', [CampaignsController::class, 'store'])->name('campaigns.store');





    });

}); 

//End admin-dashboard
 
/*----------------------------------------------------------------------------------------------------------------------------
| User dashboard
|----------------------------------------------------------------------------------------------------------------------------*/
Route::prefix('user-home')->middleware(['userEmailVerify', 'setlanguage:frontend', 'globalVariable', 'maintains_mode'])->group(function () {
    Route::get('/', [UserDashboardController::class, 'user_index'])->name('user.home');
});