<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('set.language')->group(function () {
Route::get('/test', function () {
    Log::info('Locale set to: ' . app()->getLocale());
    Log::info('This is an info message.');
    return response()->json([
        'success' => true,
        'message' => 'Hello, World!'
    ]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-learners', [ApiAuthController::class, 'fetchLearners']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-opportunity', [ApiAuthController::class, 'fetchOppertunites']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-partner', [ApiAuthController::class, 'fetchPartner']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-partnercenter', [ApiAuthController::class, 'fetchPartnerCenter']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-eventtype', [ApiAuthController::class, 'fetchEventType']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-eventcategory', [ApiAuthController::class, 'fetchEventCategory']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-eventtransaction', [ApiAuthController::class, 'fetchEventTransaction']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-assigned-opportunities', [ApiAuthController::class, 'fetchAssignedOpportunities']);
Route::middleware(['powerbi.auth', 'throttle:30,1'])->get('/fetch-field-center', [ApiAuthController::class, 'fetchFieldAgent']);






Route::post('/admin/login', [ApiAuthController::class, 'login']);
// API route for deleting a partner with authentication
Route::middleware('set.language','auth:sanctum')->group(function () {
    Route::delete('/deletepartner/{id}', [ApiAuthController::class, 'deletePartner'])->name('api.partner.delete');
    Route::get('/getpartnerlist', [ApiAuthController::class, 'getPartnerList']);
    Route::post('/addpartner', [ApiAuthController::class, 'addNewPartner']);
    Route::put('/update-partner/{partnerId}', [ApiAuthController::class, 'updatePartner']);
    Route::get('/getpartner/{id}', [ApiAuthController::class, 'getPartnerDetails'])->name('api.getpartnerdetails');
    

    Route::get('/adminprofile', [ApiAuthController::class, 'getAdminProfileDetails']);
    Route::get('/user', [ApiAuthController::class, 'user']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    //Add New Partner Center
    Route::delete('/deletepartnercenter/{id}', [ApiAuthController::class, 'deletePartnerCenter'])->name('api.partnercenter.delete');
    Route::get('/getpartnercenterlist', [ApiAuthController::class, 'getPartnerCenterList'])->name('api.getpartnercenterlist');
    Route::post('/addpartnercenter', [ApiAuthController::class, 'addNewPartnerCenter'])->name('api.addpartnercenter');
    Route::put('/update-partner-center/{partnerId}', [ApiAuthController::class, 'updatePartnerCenter'])->name('api.update-partner-center');
    Route::get('/getpartnecenter/{id}', [ApiAuthController::class, 'getPartnerCenterDetails'])->name('api.getpartnercenterdetails');
    
    
    //Global List
    Route::get('/get_digital_proficiency_levels', [ApiAuthController::class, 'getDigitalProficiencyLevels'])->name('api.get_digital_proficiency_levels');
    Route::get('/get_education_list', [ApiAuthController::class, 'getEducationList'])->name('api.get_education_list');
    Route::get('/get_specification_qualification_list', [ApiAuthController::class, 'getSpecificationQualificationList'])->name('api.get_specification_qualification_list');
    Route::get('/get_service_offered', [ApiAuthController::class, 'getServiceOfferedList'])->name('api.get_service_offered');
    Route::get('/get_loan_type', [ApiAuthController::class, 'getLoanTypeList'])->name('api.get_loan_type');
    

    //Add New Global Item
    Route::post('/add_new_global_item', [ApiAuthController::class, 'addNewGlobalItem'])->name('api.add.add_new_global_item');
    Route::put('/update_global_item/{id}', [ApiAuthController::class, 'updateGlobalItem'])->name('api.update.update_global_item');
    

    //addopportunities
    Route::group(['prefix' => 'opportunities'], function () {
        Route::post('/addopportunities', [ApiAuthController::class, 'addNewOpportunities'])->name('api.add.opportunities');
        Route::put('/updateopportunities/{id}', [ApiAuthController::class, 'updateOpportunities'])->name('api.update.opportunities');
        Route::delete('/deleteopportunities/{id}', [ApiAuthController::class, 'deleteOpportunities'])->name('api.delete.opportunities');
        Route::get('/getopportunitieslist', [ApiAuthController::class, 'getOpportunitiesList'])->name('api.getopportunitieslist');
        Route::get('/getopportunitiesdetails/{id}', [ApiAuthController::class, 'getOpportunitiesDetails'])->name('api.getopportunitiesdetails');
        
    });


    //addopportunities
    Route::group(['prefix' => 'pathway'], function () {
        Route::post('/addpathway', [ApiAuthController::class, 'addPathwaysToOpportunitiesd'])->name('api.add.pathway');
        Route::get('/getpathwaylist', [ApiAuthController::class, 'getPathwayList'])->name('api.list.pathway');
        Route::put('/updatepathway/{id}', [ApiAuthController::class, 'updatePathway'])->name('api.update.pathway');
        Route::delete('/deletepathway/{id}', [ApiAuthController::class, 'deletePathway'])->name('api.delete.pathway');

//        Route::get('/getpathwaydetails/{id}', [ApiAuthController::class, 'getPathwayDetails'])->name('api.details.pathway');
    });


    //All Promotional API Routes
    Route::group(['prefix' => 'promotional'], function () {
        Route::post('/addnewpromotion', [ApiAuthController::class, 'addNewPromotionalItem'])->name('api.add.promotinal');
        Route::get('/getpromotionlist', [ApiAuthController::class, 'getPromotionList'])->name('api.list.promotionlist');
        Route::delete('/deletepromotion/{id}', [ApiAuthController::class, 'deletePromotion'])->name('api.delete.promotion');
        Route::post('/updatepromotion/{id}', [ApiAuthController::class, 'updatePromotion'])->name('api.update.promotion');
    });


    //All yuwaah Sakhi API Routes
    Route::group(['prefix' => 'yuwaah'], function () {
        Route::post('/addnewyuwaahsakhi', [ApiAuthController::class, 'addNewYuwaahSakhi'])->name('api.add.yuwaahsakhi');
        Route::post('/updateyuwaahsakhi', [ApiAuthController::class, 'updateYuwaahSakhi'])->name('api.update.yuwaahsakhi');
        Route::delete('/delete/{id}', [ApiAuthController::class, 'deleteYuwaahSakhi'])->name('api.delete.yuwaahsakhi');
        Route::get('/getyuwaahdetails/{id}', [ApiAuthController::class, 'getYuwaahDetails'])->name('api.details.yuwaahsakhi');
        Route::get('/getyuwaahlist', [ApiAuthController::class, 'getYuwaahList'])->name('api.list.yuwaahsakhi');
    });


    


});

});