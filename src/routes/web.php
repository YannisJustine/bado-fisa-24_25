<?php

use App\Http\Livewire\Applicant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\HeureSuppController;
use App\Http\Controllers\FormuleCodeController;
use App\Http\Controllers\FormuleConduiteController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include("auth.php");

Route::view('/', 'welcome')->name('home');
Route::get('/ratings', [RatingController::class, 'index'])->name('rating.index');

Route::middleware('auth:web')->group(function () {
    
    Route::middleware('role:formateur')->group(function() {
        Route::get('/formateur', [UserController::class, 'show'])->name('formateur');
    });
    
    Route::middleware('role:admin')->group(function() {
        Route::get('/register/user', [UserRegisterController::class, "index"])->name("register.user");
        Route::post('/register/user', [UserRegisterController::class, "create"])->name("register.user.post");
        Route::view('/calendrier', 'calendar')->name('calendrier');
    });

    Route::get('/candidats', Applicant::class)->name('candidats');
    Route::get('/candidats/{candidat}', [CandidatController::class, 'show'])->name('candidats.profile');

});

Route::middleware('auth:candidat')->group(function() {
        
    Route::view('catalogue', 'catalogue.index')->name('catalogue');

    Route::get('catalogue/formules',[FormuleController::class, "index"])->name('catalogue.formules');
    Route::get('catalogue/formules/{formule:libelle}', [FormuleController::class, "show"])->name('catalogue.formules.formule');
    Route::post('catalogue/formules/conduite', [FormuleConduiteController::class, 'store'])->name('achat.formules.conduite');
    Route::post('catalogue/formules/code', [FormuleCodeController::class, 'store'])->name('achat.formules.code');

    Route::get('catalogue/heures_supp', [HeureSuppController::class, "index"])->name('catalogue.heures_supp');
    Route::get('catalogue/heures_supp/{type_permis}', [HeureSuppController::class, 'show'])->name('catalogue.heures_supp.type_permis');
    Route::post('catalogue/heures_supp', [HeureSuppController::class, 'store'])->name('achat.heures_supp');
    
    Route::get('/candidats/{candidat}', [CandidatController::class, 'show'])->name('candidats.profile');
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
});