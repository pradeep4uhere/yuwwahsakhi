<?php

use App\Http\Controllers\PartnerAuthController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;



// Admin login route
Route::middleware('partner.guest')->group(function () {
    Route::get('/login', [PartnerAuthController::class, 'loginForm'])->name('partner.login.get');
    Route::post('/login', [PartnerAuthController::class, 'login'])->name('partner.login');
    // Admin registration route
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('partner.register.get');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('partner.register');
});

// Admin logout route
Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('partner.logout');


// Use the 'admin' guard instead of the default 'auth' guard
Route::middleware('auth:partner')->group(function () {
    Route::get('/dashboard', [PartnerController::class, 'dashboard'])->name('partner.dashboard');
    Route::get('/profile', [PartnerController::class, 'edit'])->name('partner.profile.edit');
    Route::patch('/profile', [PartnerController::class, 'update'])->name('partner.profile.update');
    Route::delete('/profile', [PartnerController::class, 'destroy'])->name('partner.profile.destroy');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('partner.verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PartnerController::class, 'updatePassowrd'])->name('partner.password.update');
    Route::get('promotional', [PartnerController::class, 'getAllPromotionalList'])->name('partner.promotional');
    Route::get('partnercenter', [PartnerController::class, 'getAllPartnerCenterList'])->name('partner.partnercenter');
    Route::get('opportunites', [PartnerController::class, 'getAllOpportunitesList'])->name('partner.opportunites');
    Route::get('opportunites-details/{id}', [PartnerController::class, 'getOpportunitesDetails'])->name('partner.opportunites.details');
    Route::any('updatepartnercenter/{id}', [PartnerController::class, 'udatePartnerCenterDetails'])->name('partner.partnercenter.edit');
    Route::post('update-partner-center-action', [PartnerController::class, 'udatePartnerCenterAction'])->name('partner.partnercenter.updatepartnercenter');
});