<?php

use App\Models\Lecon;
use App\Http\Livewire\Applicant;
use Illuminate\Support\Facades\Route;
use App\Notifications\EventAskedNotif;
use App\Http\Controllers\UserController;
use App\Notifications\EventUpdatedNotif;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\HeureSuppController;
use App\Http\Controllers\FormuleCodeController;
use App\Http\Controllers\FormuleConduiteController;

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

Route::middleware('auth')->group(function () {
    Route::get('/formateur', [UserController::class, 'show'])->name('formateur');
});

Route::view('/', 'welcome')->name('home');

Route::view('/calendrier', 'calendar')->name('calendrier');

Route::view('catalogue', 'catalogue.index')->name('catalogue');

Route::get('catalogue/formules',[FormuleController::class, "index"])->name('catalogue.formules');
Route::get('catalogue/formules/{formule:libelle}', [FormuleController::class, "show"])->name('catalogue.formules.formule');
Route::post('catalogue/formules/conduite', [FormuleConduiteController::class, 'store'])->name('achat.formules.conduite');
Route::post('catalogue/formules/code', [FormuleCodeController::class, 'store'])->name('achat.formules.code');

Route::get('catalogue/heures_supp', [HeureSuppController::class, "index"])->name('catalogue.heures_supp');
Route::get('catalogue/heures_supp/{type_permis}', [HeureSuppController::class, 'show'])->name('catalogue.heures_supp.type_permis');
Route::post('catalogue/heures_supp', [HeureSuppController::class, 'store'])->name('achat.heures_supp');

Route::get('/candidats', Applicant::class)->name('candidats');
Route::get('/candidats/{candidat}', [CandidatController::class, 'show'])->name('candidats.profile');
// Route::get('valide', CatalogueController::class);

Route::get('/test-notification-ask', function () {
    $lecon = Lecon::first();
    if(!$lecon) {
        return "Aucune leçon";
    }
    
    return (new EventAskedNotif($lecon))
                ->toMail($lecon->formateur);
});

Route::get('/test-notification-confirm', function () {
    $lecon = Lecon::first();
    if(!$lecon) {
        return "Aucune leçon";
    }
    
    return (new EventUpdatedNotif($lecon))
                ->toMail($lecon->candidat);
});


