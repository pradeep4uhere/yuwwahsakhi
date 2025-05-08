<?php
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;

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
Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('log-viewer', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::post('/change-language', function (Request $request) {
    $language = $request->input('language');
    if (in_array($language, ['en', 'hi', 'es', 'fr'])) {
        Session::put('locale', $language);
        App::setLocale($language);
    }
    return back();
})->name('change.language');

Route::get('/', [ProfileController::class, 'welcome'])->name('welcome');
Route::any('/userlogin', [ProfileController::class, 'login'])->name('user.login');



Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/opportunities-details/{id}', [ProfileController::class, 'opportunitiesDetails'])->name('opportunities.details');
    Route::get('/opportunities', [ProfileController::class, 'opportunitiesList'])->name('opportunities');
    Route::get('/upload', [ProfileController::class, 'eventTransactionList'])->name('upload');
    Route::get('/learner', [ProfileController::class, 'LearnerList'])->name('learner');
    Route::get('/promotion', [ProfileController::class, 'PromotionList'])->name('promotion');
    Route::get('/learner_details/{id}', [ProfileController::class, 'learnerDetails'])->name('learner.details');
    Route::get('/addopportunities', [ProfileController::class, 'addNewOpportunities'])->name('addopportunities');
    Route::any('/saveopportunites', [ProfileController::class, 'saveOpportunities'])->name('saveopportunites');
    Route::any('/opportunitiesLearner/{id}', [ProfileController::class, 'AssignLearnerOpportunities'])->name('opportunitiesLearner');
    Route::post('/assign-learners', [ProfileController::class, 'assignLearners'])->name('assign.learners');
    Route::post('/storeeventtransaction', [ProfileController::class, 'storeEventTransaction'])->name('storeeventtransaction');
    Route::post('/fetch-event-categories', [ProfileController::class, 'fetchEventCategories'])->name('fetch.event.categories');
    Route::any('/allevents', [ProfileController::class, 'allEventTransactionList'])->name('user.allevents');
    Route::get('/eventlearner/{id}', [ProfileController::class, 'assignLearnersIntoEvent'])->name('event.assignLearner');
    Route::post('/saveassignedeventlearner', [ProfileController::class, 'saveAssignLearnersIntoEvent'])->name('event.save.assignLearner');
    Route::get('/termsandconditions', [ProfileController::class, 'PageTermsAndConditions'])->name('page.termsandconditions');
    Route::get('/unicefyuthhub', [ProfileController::class, 'PageUnicefYuthHub'])->name('page.unicefyuthhub');
    Route::get('/aboutyuwaah', [ProfileController::class, 'AboutYuwaah'])->name('page.about_yuwaah');
    Route::get('/profileedit', [ProfileController::class, 'profileEdit'])->name('profile.profiledit');
    Route::post('/update-profile', [ProfileController::class, 'saveEditProfile'])->name('user.updateProfile');
    Route::get('/get-event-documents', [ProfileController::class, 'getEventDocuments'])->name('user.event.document');
    Route::get('/promotion_details/{id}', [ProfileController::class, 'getPromotionDetails'])->name('user.promotion.details');
    Route::any('/search_learner', [ProfileController::class, 'LearnerList'])->name('user.search.learner');
    Route::get('/get-beneficiaries', [ProfileController::class, 'getBeneficiaries'])->name('get.beneficiaries');
    Route::get('/viewevent/{id}', [ProfileController::class, 'getEventDetails'])->name('viewevent');
    
    
    
    


    
});

Route::any('/verifyotp', [ProfileController::class, 'verifyOTP'])->name('verify.otp.page');
Route::post('/verifymobile', [ProfileController::class, 'verifyMobileNumber'])->name('verifymobile');
Route::get('/fpassword', [ProfileController::class, 'VerifyMobile'])->name('recoverpassword');
Route::get('/get-districts/{state_id}', [ProfileController::class, 'getDistrictDropdown'])->name('getdistricts');
Route::get('/get-blocks', [ProfileController::class, 'getBlocksByDistrict'])->name('getblock');
Route::post('/changepassword', [ProfileController::class, 'changePassword'])->name('change.password');

require __DIR__.'/auth.php';
