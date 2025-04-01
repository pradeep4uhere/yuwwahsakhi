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
});



require __DIR__.'/auth.php';
