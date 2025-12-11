<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DiagnoseController;


Route::get('/ping', function () {
    return ['status' => 'pong'];
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    // prediction endpoint
    Route::post('/predict', [DiagnoseController::class, 'diagnose']);
    Route::post('/predict-base64', [DiagnoseController::class, 'diagnoseBase64']);


});


