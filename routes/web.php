<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CampaignsController;
use App\Http\Controllers\Admin\DonationAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignDetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\OrphanageDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
Route::get('/profile', [ProfileController::class, 'index'])->name('Profile');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');

// Donation routes
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donations/store', [DonationController::class, 'store'])->name('donation.store');
Route::post('/donations/initiate', [DonationController::class, 'initiate'])->name('donations.initiate');
Route::post('/donation', [DonationController::class, 'initiate'])->name('donations.initiate1');
Route::post('/donations/confirm', [DonationController::class, 'confirmDonation'])->name('donations.confirm');

// Orphanage routes
Route::get('/orphanage', [OrphanageController::class, 'index'])->name('orphanage');
Route::get('/orphanage/{id}', [OrphanageDetailController::class, 'show'])->name('orphanage.details');

// Campaign routes
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaign');
Route::get('/campaigns/{id}', [CampaignDetailController::class, 'show'])->name('campaign.details');

//
// Auth Admin
Route::middleware(['setlanguage:backend'])->group(function () {
    Route::get('/auth/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/auth/admin', [LoginController::class, 'adminLogin'])->name('admin.login');
    Route::get('/logout/admin', [AdminDashboardController::class, 'adminLogout'])->name('admin.logout');
});

/*----------------------------------------------------------------------------------------------------------------------------
| User login - Registration
|----------------------------------------------------------------------------------------------------------------------------*/

Route::post('/ajax-login', [HomeController::class, 'ajax_login'])->name('user.ajax.login');

// User Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register.submit');
// user login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
// email verification routes
Route::get('/email/verify', function () {
    return view('frontend.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    try {
        $user = Admin::findOrFail($id);

        Log::info('Email verification attempt', [
            'user_id' => $id,
            'email' => $user->email,
        ]);

        // Verify hash matches
        if (!hash_equals($hash, sha1($user->email))) {
            Log::warning('Invalid verification hash', [
                'expected' => sha1($user->email),
                'provided' => $hash,
            ]);
            abort(403, 'Invalid verification link');
        }

        // Mark as verified
        if ($user->email_verified !== 1) {
            $user->update(['email_verified' => 1]);
            Log::info('Email marked as verified', ['user_id' => $user->id]);
        }

        return redirect()->route('admin.login')
            ->with('status', 'Email successfully verified! You can now login.');
    } catch (Exception $e) {
        Log::error('Email verification failed', [
            'error' => $e->getMessage(),
            'user_id' => $id ?? 'unknown',
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->route('register')
            ->with('error', 'Verification failed. Please try again.');
    }
})->middleware(['signed'])->name('verification.verify');
// Admin Dashboard

Route::prefix('admin-dash')->middleware(['auth:admin','setlanguage:backend', 'adminGlobalVar'])->group(function () {
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/', [AdminDashboardController::class, 'adminIndex'])->name('admin.home');
        Route::get('/manageusers', [AdminDashboardController::class, 'manageUsers'])->name('admin.manageUsers');
        Route::get('/adduser', [AdminDashboardController::class, 'addUsers'])->name('admin.addUser');
        Route::get('/profile', [AdminDashboardController::class, 'profilePersonalInfo'])->name('admin.profilePersonalInfo');
        Route::get('/profile-update', [AdminDashboardController::class, 'admin_profile'])->name('admin.profile');
        Route::post('/profile-update', [AdminDashboardController::class, 'admin_profile_update'])->name('admin.profile.update');
        Route::get('/password-change', [AdminDashboardController::class, 'admin_password'])->name('admin.password');
        Route::post('/password-change', [AdminDashboardController::class, 'admin_password_chagne'])->name('admin.password.change');
        Route::get('/donation_management', [DonationAdminController::class, 'index'])->name('donation_management');
        Route::post('/donations', [DonationAdminController::class, 'store'])->name('donations.store');
       
        //campaign routes
        Route::get('/campaign', [AdminDashboardController::class, 'campaign'])->name('admin.campaign');
        Route::get('/campaign_details', [AdminDashboardController::class, 'campaignDetails'])->name('admin.campaignDetails');
        Route::post('/campaigns', [CampaignsController::class, 'store'])->name('campaigns.store');
        Route::get('campaigns/{campaign}/edit', [AdminDashboardController::class, 'edit'])->name('campaigns.edit');
        Route::put('campaigns/{campaign}', [CampaignsController::class, 'update'])->name('campaigns.update');
        Route::delete('campaigns/{campaign}', [CampaignsController::class, 'destroy'])->name('campaigns.destroy');
        
        // Campaign approval routes
        Route::post('/campaigns/{campaign}/approve', [CampaignsController::class, 'approve'])
            ->name('admin.campaigns.approve');
        Route::post('/campaigns/{campaign}/reject', [CampaignsController::class, 'reject'])
            ->name('admin.campaigns.reject');
        Route::get('/campaigns/{campaign}/download', [CampaignsController::class, 'downloadBusinessPlan'])
            ->name('admin.campaigns.download');
       
        //user approval routes
        Route::post('/users/{user}/approve', [AdminDashboardController::class, 'approveUser'])
        ->name('admin.users.approve');
        Route::post('/users/{user}/reject', [AdminDashboardController::class, 'rejectUser'])
        ->name('admin.users.reject');
    });
});
Route::get('/test-mail-view', function () {
    try {
        $admin = Admin::first();

        return view('emails.admin_rejected', [
            'admin' => $admin,
            'reason' => 'Test reason',
        ]);
    } catch (Exception $e) {
        dd($e->getMessage()); // This will show the exact error
    }
});
// End admin-dashboard

/*----------------------------------------------------------------------------------------------------------------------------
| User dashboard
|----------------------------------------------------------------------------------------------------------------------------*/
// User routes
Route::prefix('user-home')->middleware([
    'auth:web',
    // 'email.verify',  // Our custom middleware
    // 'user.active'
])->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('user.home');
    Route::get('/mycampaigns', [UserDashboardController::class, 'mycampaigns'])->name('user.mycampaigns');
    Route::get('/donations', [UserDashboardController::class, 'donations'])->name('user.donations');
    Route::get('/profilesetting', [UserDashboardController::class, 'profilesetting'])->name('user.profile');
    Route::get('/myrewards', [UserDashboardController::class, 'myrewards'])->name('user.rewards');
    Route::get('/changepassword', [UserDashboardController::class, 'changepassword'])->name('user.changepassword');
});
// Admin approval route
Route::post('/admin-dash/approve-om/{admin}', [RegisterController::class, 'approveOrphanageManager'])
    ->name('admin.approve.om');
