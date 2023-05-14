<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BloodTypeController;

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

Route::prefix('users')->group(function () {

  // Blood type route, No need authenticated
  Route::get('blood-types', [BloodTypeController::class, 'index']);

  // Authentication
  Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:api']);
  });

  // 
});
