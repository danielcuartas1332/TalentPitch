<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ChallengeController;
use App\Http\Controllers\api\VideoController;

//Grupo de rutas que definen el api de users para consultar los endpoints
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

//Grupo de rutas que definen el api de challenges para consultar los endpoints
Route::prefix('challenges')->group(function () {
    Route::get('/', [ChallengeController::class, 'index']);
    Route::get('{id}', [ChallengeController::class, 'show']);
    Route::post('/', [ChallengeController::class, 'store']);
    Route::put('{id}', [ChallengeController::class, 'update']);
    Route::delete('{id}', [ChallengeController::class, 'destroy']);
});

//Grupo de rutas que definen el api de videos para consultar los endpoints
Route::prefix('videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::get('{id}', [VideoController::class, 'show']);
    Route::post('/', [VideoController::class, 'store']);
    Route::put('{id}', [VideoController::class, 'update']);
    Route::delete('{id}', [VideoController::class, 'destroy']);
});

