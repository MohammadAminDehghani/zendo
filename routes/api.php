<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("v1")->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'login'])->middleware('auth:sanctum');
    Route::get('user', [AuthController::class, 'login'])->middleware('auth:sanctum');
});

Route::prefix("v1")->group(function () {
    Route::get('/events', [EventController::class, 'index']); // List events
    Route::post('/events', [EventController::class, 'store']); // Create an event
    Route::get('/events/{id}', [EventController::class, 'show']); // View event details
    Route::post('/events/{id}/join', [EventController::class, 'join']); // Join an event
});

