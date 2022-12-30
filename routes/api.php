<?php

use Illuminate\Support\Facades\Route;

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

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);

    // Mission Types
    Route::get('mission-type', [App\Http\Controllers\MissionTypeController::class, 'index']);
    Route::post('mission-type', [App\Http\Controllers\MissionTypeController::class, 'store']);

    // Mission
    Route::get('mission', [App\Http\Controllers\MissionController::class, 'index']);
    Route::post('mission', [App\Http\Controllers\MissionController::class, 'store']);
});
