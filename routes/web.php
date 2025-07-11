<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CampaignsController;
use App\Http\Controllers\Admin\DonationAdminController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignDetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrphanageController;
use App\Http\controllers\PendingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserDashboardController;
// test controller
use Illuminate\Support\Facades\Route;

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
// public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/orphanage', [OrphanageController::class, 'index'])->name('orphanage');
Route::get('/profile', [ProfileController::class, 'index'])->name('Profile');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::get('/dash', [TestController::class, 'index'])->name('test');
Route::get('/mycampaigns', [TestController::class, 'mycampaigns'])->name('mycampaigns');
Route::get('/donations', [TestController::class, 'donations'])->name('donations');
Route::get('/pending-approval', [PendingController::class, 'index'])->name('');

// Donation routes
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donations/store', [DonationController::class, 'store'])->name('donation.store');
Route::post('/donations/initiate', [DonationController::class, 'initiate'])->name('donations.initiate');
Route::post('/donation', [DonationController::class, 'initiate'])->name('donations.initiate1');
Route::post('/donations/confirm', [DonationController::class, 'confirmDonation'])->name('donations.confirm');

// Campaign routes
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaign');
Route::get('/campaigns/{id}', [CampaignDetailController::class, 'show'])->name('campaign.details');

// Auth Admin
Route::middleware(['setlanguage:backend'])->group(function () {
    Route::get('/auth/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/auth/admin', [LoginController::class, 'adminLogin']);
    Route::get('/logout/admin', [AdminDashboardController::class, 'adminLogout'])->name('admin.logout');
});

/*----------------------------------------------------------------------------------------------------------------------------
| User login - Registration
|----------------------------------------------------------------------------------------------------------------------------*/
// user login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/ajax-login', [HomeController::class, 'ajax_login'])->name('user.ajax.login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');

Route::get('/activation/{token}', [ActivationController::class, 'verify'])->name('activation.verify');

// user email verify
Route::get('/user/email-verify', [UserDashboardController::class, 'user_email_verify_index'])->name('user.email.verify');

// Admin Dashboard

Route::prefix('admin-dash')->middleware(['setlanguage:backend', 'adminGlobalVar'])->group(function () {
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/', [AdminDashboardController::class, 'adminIndex'])->name('admin.home');
        Route::get('/manageusers', [AdminDashboardController::class, 'manageUsers'])->name('admin.manageUsers');
        Route::get('/adduser', [AdminDashboardController::class, 'addUsers'])->name('admin.addUser');
        Route::get('/profile', [AdminDashboardController::class, 'profilePersonalInfo'])->name('admin.profilePersonalInfo');
        Route::get('/campaign', [AdminDashboardController::class, 'campaign'])->name('admin.campaign');
        Route::get('/campaign_details', [AdminDashboardController::class, 'campaignDetails'])->name('admin.campaignDetails');
        Route::get('/profile-update', [AdminDashboardController::class, 'admin_profile'])->name('admin.profile');
        Route::post('/profile-update', [AdminDashboardController::class, 'admin_profile_update'])->name('admin.profile.update');
        Route::get('/password-change', [AdminDashboardController::class, 'admin_password'])->name('admin.password');
        Route::post('/password-change', [AdminDashboardController::class, 'admin_password_chagne'])->name('admin.password.change');
        Route::get('/donation_management', [DonationAdminController::class, 'index'])->name('donation_management');
        Route::post('/donations', [DonationAdminController::class, 'store'])->name('donations.store');

        Route::post('/campaigns', [CampaignsController::class, 'store'])->name('campaigns.store');
        Route::get('campaigns/{campaign}/edit', [AdminDashboardController::class, 'edit'])->name('campaigns.edit');
        Route::put('campaigns/{campaign}', [CampaignsController::class, 'update'])->name('campaigns.update');
        Route::delete('campaigns/{campaign}', [CampaignsController::class, 'destroy'])->name('campaigns.destroy');
    });
});

// End admin-dashboard

/*----------------------------------------------------------------------------------------------------------------------------
| User dashboard
|----------------------------------------------------------------------------------------------------------------------------*/
Route::prefix('user-home')->middleware(['userEmailVerify', 'setlanguage:frontend', 'globalVariable', 'maintains_mode'])->group(function () {
    Route::get('/', [UserDashboardController::class, 'user_index'])->name('user.home');
});
