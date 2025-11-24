<?php

use App\Http\Controllers\Api\V1\Api1AuthController;
use App\Http\Controllers\Api\V1\Api1LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// http://localhost:8000/api/v1/laporan
Route::prefix('v1')->group(function () {
    Route::post('/login', [Api1AuthController::class, 'login']);
    Route::get('/laporan', [Api1LaporanController::class, 'index'])->middleware('auth:sanctum');
});
