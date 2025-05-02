<?php
use App\Http\Controllers\PartnerCenterAuthController;
use App\Http\Controllers\PartnerCenterController;
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
Route::middleware('partnercenter.guest')->group(function () {
    Route::post('/logout', [PartnerCenterAuthController::class, 'logout'])->name('partnercenter.logout');
    Route::get('/login', [PartnerCenterAuthController::class, 'loginForm'])->name('partnercenter.login.get');
    Route::post('/login', [PartnerCenterAuthController::class, 'login'])->name('partnercenter.login');
    Route::get('/register', [PartnerCenterAuthController::class, 'registerForm'])->name('partnercenter.register.get');
    Route::post('/register', [PartnerCenterAuthController::class, 'register'])->name('partnercenter.register');
});

// Admin logout route
Route::post('/logout', [PartnerCenterAuthController::class, 'logout'])->name('partnercenter.logout');

// Use the 'admin' guard instead of the default 'auth' guard
Route::middleware('auth:partner_center')->group(function () {
    Route::get('/dashboard', [PartnerCenterController::class, 'dashboard'])->name('partnercenter.dashboard');
    Route::get('/profile', [PartnerCenterController::class, 'edit'])->name('partnercenter.profile.edit');
    Route::patch('/profile', [PartnerCenterController::class, 'update'])->name('partnercenter.profile.update');
    Route::delete('/profile', [PartnerCenterController::class, 'destroy'])->name('partnercenter.profile.destroy');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('partner.verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PartnerCenterController::class, 'updatePassowrd'])->name('partnercenter.password.update');
    Route::get('promotional', [PartnerCenterController::class, 'getAllPromotionalList'])->name('partnercenter.promotional');
    Route::get('partnercenter', [PartnerCenterController::class, 'getAllPartnerCenterList'])->name('partnercenter.partnercenter');
    Route::get('opportunites', [PartnerCenterController::class, 'getAllOpportunitesList'])->name('partnercenter.opportunites');
    Route::get('opportunites-details/{id}', [PartnerCenterController::class, 'getOpportunitesDetails'])->name('partnercenter.opportunites.details');
    Route::any('updatepartnercenter/{id}', [PartnerCenterController::class, 'udatePartnerCenterDetails'])->name('partnercenter.partnercenter.edit');
    Route::post('update-partner-center-action', [PartnerCenterController::class, 'udatePartnerCenterAction'])->name('partnercenter.partnercenter.updatepartnercenter');
    Route::get('event', [PartnerCenterController::class, 'eventList'])->name('partnercenter.event');
    Route::get('viewyuwaahsakhi/{id}', [PartnerCenterController::class, 'viewAssociatedYuwaahSakhi'])->name('partnercenter.partnercenter.viewyuwaahsakhi');
    Route::get('viewyuwaahsakhi_details/{id}', [PartnerCenterController::class, 'viewAssociatedYuwaahSakhi'])->name('partnercenter.partnercenter.viewyuwaahsakhi.details');    
    Route::get('setting', [PartnerCenterController::class, 'settingProfile'])->name('partnercenter.setting');
    Route::post('partner_password', [PartnerCenterAuthController::class, 'changePassword'])->name('partnercenter.password.change');
    Route::get('promotion_view/{id}', [PartnerCenterController::class, 'promotionalDetails'])->name('patnercenter.promotion.view');
    

});