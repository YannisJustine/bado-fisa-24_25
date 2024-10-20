<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\User\LoginController as LoginController;
use App\Http\Controllers\Auth\Candidat\LoginController as CandidatLoginController;
use App\Http\Controllers\Auth\Candidat\RegisterController as CandidatRegisterController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for the application. 
|
|
|
*/

/*--------------------------- GET ROUTES -----------------------------------------*/
Route::group([
    'middleware' => 'guest'
], function() {
    Route::get('/login/candidat',  [CandidatLoginController::class, 'index'])->name('login.candidat');
    Route::get('/login',  [LoginController::class, 'index'])->name('login.user');
    
    
    Route::post('/login/candidat', [CandidatLoginController::class, 'authenticate'])->name('login.post.candidat');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post.user');

    Route::get('/register', [RegisterController::class, "index"])->name("register");
    Route::get('/register/candidat', [CandidatRegisterController::class, "index"])->name("register.candidat");
    Route::post('/register/candidat', [CandidatRegisterController::class, "create"])->name("register.candidat.post");
});


Route::get('/logout', LogoutController::class)->name('logout');


/*--------------------------- POST ROUTES -----------------------------------------*/
// Route::post('/auth/login', );