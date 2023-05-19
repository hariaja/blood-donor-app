<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\BloodTypeController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Masters\RegistrationController;

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

  // Registration
  Route::prefix('register')->group(function () {
    Route::post('check-nik', [RegisterController::class, 'checkNik']);
    Route::post('check-phone', [RegisterController::class, 'checkPhone']);
    Route::post('check-email', [RegisterController::class, 'checkEmail']);
    Route::post('store', [RegisterController::class, 'store']);
  });

  // Authentication
  Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:api']);
  });

  Route::middleware(['auth:api'])->group(function () {
    // Home
    Route::get('home', [HomeController::class, 'index']);

    // Registration
    Route::get('registrations/index', [RegistrationController::class, 'index']);
    Route::post('registrations/store', [RegistrationController::class, 'store']);
    Route::get('registrations/{registration}/show', [RegistrationController::class, 'show']);
  });
});
