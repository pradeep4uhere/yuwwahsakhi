<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Exports\YuwaahSakhiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PartnerCenterExport;
use App\Exports\YuwaahEventMasterExport;
use App\Exports\OpportunityExport;
use App\Exports\PromotionExport;
use App\Http\Controllers\EventCategoryExportController;



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
    Route::get('/export/partner-centers', function () {
        return Excel::download(new PartnerCenterExport, 'partner_division_'.date('y_m_d_h_i_s').'.xlsx');
    })->name('partnerCenters.export');

    //All opportunities routes Here
    Route::get('/getopportunitieslist', [AdminController::class, 'getOpportunitiesList'])->name('admin.opportunities.list');
    Route::any('/addopportunities', [AdminController::class, 'addNewOpportunities'])->name('admin.opportunities.add');
    Route::any('/updateopportunities/{id}', [AdminController::class, 'updateOpportunities'])->name('admin.opportunities.update');
    Route::any('/deleteopportunities/{id}', [AdminController::class, 'deleteOpportunities'])->name('admin.opportunities.delete');
    Route::get('/getopportunitiesdetails/{id}', [AdminController::class, 'getOpportunitiesDetails'])->name('admin.opportunities.details');
    Route::get('/export/opportunities', function () {
        return Excel::download(new OpportunityExport, 'opportunities.xlsx');
    })->name('opportunities.export');
  
    //All Promotion Route List
    Route::get('/promotionlist', [AdminController::class, 'getPromotionList'])->name('admin.promotions.list');
    Route::any('/addpromotion', [AdminController::class, 'addNewPromotion'])->name('admin.promotions.add');
    Route::any('/updatepromotion/{id}', [AdminController::class, 'updatePromotion'])->name('admin.promotions.update');
    Route::any('/deletepromotion/{id}', [AdminController::class, 'deletePromotion'])->name('admin.promotions.delete');
    Route::get('/getpromotiondetails/{id}', [AdminController::class, 'getPromotionDetails'])->name('admin.promotions.details');
    Route::get('/export/promotions', function () {
        return Excel::download(new PromotionExport, 'promotions.xlsx');
    })->name('promotions.export');
    
    //Yuwwah Sakhi all routes Here
    Route::any('/addnewyuwaahsakhi', [AdminController::class, 'addNewYuwaahSakhi'])->name('admin.yuwaahsakhi.add');
    Route::any('/updateyuwaahsakhi/{id}', [AdminController::class, 'updateYuwaahSakhi'])->name('admin.yuwaahsakhi.update');
    Route::any('/delete/{id}', [AdminController::class, 'deleteYuwaahSakhi'])->name('admin.yuwaahsakhi.delete');
    Route::get('/getyuwaahdetails/{id}', [AdminController::class, 'getYuwaahDetails'])->name('admin.yuwaahsakhi.details');
    Route::get('/getyuwaahlist', [AdminController::class, 'getYuwaahList'])->name('admin.yuwaahsakhi.list');
    Route::get('/getyuwaahlist', [AdminController::class, 'getYuwaahList'])->name('admin.yuwaahsakhi.list');
    Route::get('/get-partner-centers', [AdminController::class, 'getPartnerCenters'])->name('admin.get_partner_centers');Route::get('/export/yuwaah-sakhi', function () {
        return Excel::download(new YuwaahSakhiExport, 'field_center_list.xlsx');
    })->name('yuwaahSakhi.export');


    //YuwaahSakhi Setting
    Route::any('/yuwaah_homepage_setting', [AdminController::class, 'yuwaahSakhiHomePageSetting'])->name('admin.yuwaahsakhi.homepage.setting');
    Route::post('/yuwaahsakhi/delete-banner', [AdminController::class, 'deleteBanner'])->name('admin.yuwaahsakhi.setting.deleteBanner');

     
    //All Partner Routes Here
    Route::get('/eventcategory', [AdminController::class, 'allEventMasterList'])->name('admin.eventcategory.list');
    Route::get('/eventmaster', [AdminController::class, 'allEventTypeList'])->name('admin.eventmaster.list');
    Route::any('/add-eventmaster', [AdminController::class, 'addNewEventType'])->name('admin.eventmaster.add');   
    Route::any('/edit-eventtype/{id}', [AdminController::class, 'editEventType'])->name('admin.eventtype.edit');
    Route::any('/delete-eventtype/{id}', [AdminController::class, 'deleteEventType'])->name('admin.eventtype.delete');

    Route::any('/add-eventcategory', [AdminController::class, 'addNewEventCategory'])->name('admin.eventcategory.add');   
    
    
    Route::any('/edit-eventmaster/{id}', [AdminController::class, 'editEventMaster'])->name('admin.eventmaster.edit');
    Route::any('/delete-eventmaster/{id}', [AdminController::class, 'deleteEventMaster'])->name('admin.eventmaster.delete');
    Route::get('/export/yuwaah-events', function () {
        return Excel::download(new YuwaahEventMasterExport, 'yuwaah_event_master.xlsx');
    })->name('yuwaah.events.export');
    Route::get('/export-event-category', [EventCategoryExportController::class, 'export'])->name('admin.export-event-category');





    Route::get('/learner', [AdminController::class, 'allLearnerList'])->name('admin.learner');
    Route::get('/export-learners', [AdminController::class, 'exportLearnersCSV'])->name('admin.learner.export');
    Route::get('/export-partners', [AdminController::class, 'exportPartners'])->name('partners.export');
    Route::any('/import-learners', [AdminController::class, 'importLearnerForm'])->name('admin.import.learner');
    Route::post('/importlearners', [AdminController::class, 'importLearners'])->name('admin.import.learner.action');

    Route::get('/learner-skills', [AdminController::class, 'allLearnerSkillsList'])->name('admin.learner.skills');
    Route::get('/export-dashboard-learners', [AdminController::class, 'exportDashboardLearnersCSV'])->name('admin.learner.skills.export');
    Route::get('/export-dashboard-matched-learners', [AdminController::class, 'exportDashboardMatchedLearnersCSV'])->name('admin.learner.skills.matched.export');
    


    

});