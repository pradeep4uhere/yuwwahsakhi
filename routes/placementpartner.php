<?php
use App\Http\Controllers\PartnerAuthController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PlacementPartnerAuthController;
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
use App\Exports\EventTransactionsExport;




// Admin login route
Route::middleware('pp_partner.guest')->group(function () {
    Route::post('/logout', [PlacementPartnerAuthController::class, 'logout'])->name('pppartner.logout');
    Route::get('/login', [PlacementPartnerAuthController::class, 'loginForm'])->name('pppartner.login.get');
    Route::post('/login', [PlacementPartnerAuthController::class, 'login'])->name('pppartner.login');
});

// Admin logout route
Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('partner.logout');


// Use the 'admin' guard instead of the default 'auth' guard
Route::middleware('auth:pp_partner')->group(function () {
    Route::get('/dashboard', [PlacementPartnerAuthController::class, 'viewAllFieldCenter'])->name('placementpartner.dashboard');
    Route::get('/viewyuwaahsakhi', [PlacementPartnerAuthController::class, 'viewAllFieldCenter'])->name('placementpartner.viewyuwaahsakhi');
    Route::get('export-placement-yuwaah-sakhi', [PlacementPartnerAuthController::class, 'exportPlacementYuwaahSakhi'])->name('export.placementpartner.viewyuwaahsakhi');
    Route::get('export-placement-learner/{id}', [PlacementPartnerAuthController::class, 'exportPlacementYuwaahSakhiLearner'])->name('export.placementpartner.exportpplearner');
    
    Route::get('/viewlearner/{id}', [PlacementPartnerAuthController::class, 'viewLearner'])->name('viewlearner');
    Route::get('/get-districts', [PlacementPartnerAuthController::class, 'getDistricts'])
    ->name('get.districts');
    
   
    Route::get('/profile', [PlacementPartnerAuthController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [PlacementPartnerAuthController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [PlacementPartnerAuthController::class, 'destroy'])->name('profile.destroy');
   
    
});