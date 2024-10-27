<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\PermisController;
use App\Http\Controllers\Api\CreneauController;
use App\Http\Controllers\Api\FormuleController;
use App\Http\Controllers\Api\CandidatController;
use App\Http\Controllers\Api\FormateurController;
use App\Http\Controllers\Api\UserEventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::apiResource('candidats',  CandidatController::class)
        ->only(['index', 'show']);

    Route::get('formateurs/{user}/events', [FormateurController::class, "events"]);

    Route::apiResource('formateurs', FormateurController::class)
        ->only(['index', 'show']);

    Route::apiResource('creneaux',  CreneauController::class)
        ->only(['index', 'show']);

    Route::apiResource('events/users', UserEventController::class)
        ->only(['show'])
        ->parameters(['users' => 'user']);

    Route::apiResource('events',  EventController::class)
        ->only(['index', 'store', 'destroy', 'update'])
        ->parameters(['events' => 'lecon']);

        
    Route::apiResource('formules',  FormuleController::class)
        ->only(['index']);
        
    Route::apiResource('type_permis',  PermisController::class)
        ->only(['index']);
        
});