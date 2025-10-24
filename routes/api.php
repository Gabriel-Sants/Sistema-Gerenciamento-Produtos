<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProdutoApiController;
use App\Http\Controllers\Api\UserApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::middleware('auth:sanctum')->as('api.')->group(function () {
    Route::apiResource('produtos', ProdutoApiController::class);
    Route::apiResource('users', UserApiController::class);
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');
});
