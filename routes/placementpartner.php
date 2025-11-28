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
    Route::get('partner.event', [PartnerController::class, 'eventList'])->name('partner.event');
    Route::get('viewyuwaahsakhi/{id}', [PartnerController::class, 'viewAssociatedYuwaahSakhi'])->name('partner.partnercenter.viewyuwaahsakhi');
    Route::get('viewyuwaahsakhi_details/{id}', [PartnerController::class, 'viewAssociatedYuwaahSakhi'])->name('partner.partnercenter.viewyuwaahsakhi.details');
    Route::get('setting', [PartnerController::class, 'settingProfile'])->name('partner.setting');
    Route::post('partner_password', [PartnerAuthController::class, 'changePassword'])->name('partner.password.change');
    Route::get('promotion_view/{id}', [PartnerController::class, 'promotionalDetails'])->name('patner.promotion.view');

    Route::get('/event/comments/{id}', [PartnerController::class, 'getComments']);
    Route::get('/event/export', [PartnerController::class, 'export'])->name('partner.event.export');

   
    
});