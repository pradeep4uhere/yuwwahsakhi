<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;


// Admin login route
Route::middleware('ip.whitelist','admin.guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login.get');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    // Admin registration route
    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('admin.register.get');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
});

// Admin logout route
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Use the 'admin' guard instead of the default 'auth' guard
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    //All Partner Routes Here
    Route::get('/partner', [AdminController::class, 'allPartnerList'])->name('admin.partner');
    Route::any('/add-partner', [AdminController::class, 'addNewPartner'])->name('admin.partner.add');
    Route::any('/edit-partner/{id}', [AdminController::class, 'editPartner'])->name('admin.partner.edit');
    Route::any('/delete-partner/{id}', [AdminController::class, 'deletePartner'])->name('admin.partner.delete');


    //All Partner Center routes Here
    Route::get('/partner-center', [AdminController::class, 'allPartnerCenterList'])->name('admin.partnercenter');
    Route::any('/add-partner-center', [AdminController::class, 'addNewPartnerCenter'])->name('admin.partnercenter.add');
    Route::any('/edit-partner-cengter/{id}', [AdminController::class, 'editPartnerCenter'])->name('admin.partnercenter.edit');
    Route::any('/delete-partner-center/{id}', [AdminController::class, 'deletePartnerCenter'])->name('admin.partnercenter.delete');

    //All opportunities routes Here
    Route::get('/getopportunitieslist', [AdminController::class, 'getOpportunitiesList'])->name('admin.opportunities.list');
    Route::any('/addopportunities', [AdminController::class, 'addNewOpportunities'])->name('admin.opportunities.add');
    Route::any('/updateopportunities/{id}', [AdminController::class, 'updateOpportunities'])->name('admin.opportunities.update');
    Route::any('/deleteopportunities/{id}', [AdminController::class, 'deleteOpportunities'])->name('admin.opportunities.delete');
    Route::get('/getopportunitiesdetails/{id}', [AdminController::class, 'getOpportunitiesDetails'])->name('admin.opportunities.details');
  
    //All Promotion Route List
    Route::get('/promotionlist', [AdminController::class, 'getPromotionList'])->name('admin.promotions.list');
    Route::any('/addpromotion', [AdminController::class, 'addNewPromotion'])->name('admin.promotions.add');
    Route::any('/updatepromotion/{id}', [AdminController::class, 'updatePromotion'])->name('admin.promotions.update');
    Route::any('/deletepromotion/{id}', [AdminController::class, 'deletePromotion'])->name('admin.promotions.delete');
    Route::get('/getpromotiondetails/{id}', [AdminController::class, 'getPromotionDetails'])->name('admin.promotions.details');
  
    //Yuwwah Sakhi all routes Here
    Route::any('/addnewyuwaahsakhi', [AdminController::class, 'addNewYuwaahSakhi'])->name('admin.yuwaahsakhi.add');
    Route::any('/updateyuwaahsakhi/{id}', [AdminController::class, 'updateYuwaahSakhi'])->name('admin.yuwaahsakhi.update');
    Route::any('/delete/{id}', [AdminController::class, 'deleteYuwaahSakhi'])->name('admin.yuwaahsakhi.delete');
    Route::get('/getyuwaahdetails/{id}', [AdminController::class, 'getYuwaahDetails'])->name('admin.yuwaahsakhi.details');
    Route::get('/getyuwaahlist', [AdminController::class, 'getYuwaahList'])->name('admin.yuwaahsakhi.list');
    Route::get('/getyuwaahlist', [AdminController::class, 'getYuwaahList'])->name('admin.yuwaahsakhi.list');
    Route::get('/get-partner-centers', [AdminController::class, 'getPartnerCenters'])->name('admin.get_partner_centers');

});