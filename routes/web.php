<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PredictController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/predict', function () {
    return view('predictV2');
});

Route::get('/abstract', function () {
    return view('abstract');
});




// Predict POST Rotaları

Route::post('/predict/hcd', [PredictController::class, 'predictHCD'])->name('predictHCD'); // HCD - Metastaz Meme Kanseri (Lenf Nodu)
Route::post('/predict/breast', [PredictController::class, 'predictBreast'])->name('predictBreast'); 
Route::post('/predict/lung', [PredictController::class, 'predictLung'])->name('predictLung'); 
Route::post('/predict/colon', [PredictController::class, 'predictColon'])->name('predictColon'); 


















// Dashboard Rotaları
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
// /Dashboard Rotaları

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
