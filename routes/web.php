<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\ForgotPasswordController;





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
Route::get('/contact', [ContactController::class, 'index'])->name('Contact');
Route::get('/profile', [ProfileController::class, 'index'])->name('Proofile');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::get('/signin', [ForgotPasswordController::class, 'index'])->name('forgotpassword');





