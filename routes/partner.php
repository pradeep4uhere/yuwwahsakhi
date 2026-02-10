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
use App\Http\Controllers\PlacementPartnerAuthController;

use App\Exports\EventTransactionsExport;




// Admin login route
Route::middleware('partner.guest')->group(function () {
    Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('partner.logout');
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
    Route::get('partner.event', [PartnerController::class, 'eventList'])->name('partner.event');
    Route::get('partner.fieldagents', [PartnerController::class, 'fieldAgentList'])->name('partner.fieldagents');
    Route::get('partner.viewfieldagent/{id}', [PartnerController::class, 'viewFieldAgent'])->name('partner.viewfieldagent');
    Route::get('export-placement-learner/{id}', [PlacementPartnerAuthController::class, 'exportPlacementYuwaahSakhiLearner'])->name('export.partner.exportpplearner');
    Route::get('/get-districts', [PartnerController::class, 'getDistricts'])->name('partner.get.districts');
    Route::get('/partner/filed-agents/export', [PartnerController::class, 'exportFiledAgents'])->name('partner.filed-agents.export');
    Route::get('partner.learners', [PartnerController::class, 'learnerList'])->name('partner.learners');
    Route::get('/partner/learners/export/{agent_id}', [PartnerController::class, 'exportPartnerFliendAgentLearners'])
     ->name('partner.learners.export');
     Route::get('/partner/export/learner', [PartnerController::class, 'exportPartnerLearners'])
     ->name('export.partner.exportlearner');



   
    Route::get('viewyuwaahsakhi/{id}', [PartnerController::class, 'viewAssociatedYuwaahSakhi'])->name('partner.partnercenter.viewyuwaahsakhi');
    Route::get('viewyuwaahsakhi_details/{id}', [PartnerController::class, 'viewAssociatedYuwaahSakhi'])->name('partner.partnercenter.viewyuwaahsakhi.details');
    Route::get('setting', [PartnerController::class, 'settingProfile'])->name('partner.setting');
    Route::post('partner_password', [PartnerAuthController::class, 'changePassword'])->name('partner.password.change');
    Route::get('promotion_view/{id}', [PartnerController::class, 'promotionalDetails'])->name('patner.promotion.view');

    Route::get('/event/comments/{id}', [PartnerController::class, 'getComments']);
    Route::get('/event/export', [PartnerController::class, 'export'])->name('partner.event.export');

    
});