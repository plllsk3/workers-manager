<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\WorkerController;

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

Route::prefix('sanctum')->group(function() {
    Route::post("register", [RegisterController::class, 'register']);
    Route::post("token", [AuthController::class, 'token']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'workers' => WorkerController::class
    ]);
});
