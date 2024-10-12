<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Candidat\RegisterController as CandidatRegisterController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;
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

Route::get('/login',  [LoginController::class, 'index'])->name('login');


Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

Route::get('/register', [RegisterController::class, "index"])->name("register");
Route::get('/register/candidat', [CandidatRegisterController::class, "index"])->name("register.candidat");
Route::post('/register/candidat', [CandidatRegisterController::class, "create"])->name("register.candidat.post");

Route::get('/register/user', [UserRegisterController::class, "index"])->name("register.user");
Route::post('/register/user', [UserRegisterController::class, "create"])->name("register.user.post");

Route::get('/logout', LogoutController::class)->name('logout');


/*--------------------------- POST ROUTES -----------------------------------------*/
// Route::post('/auth/login', );