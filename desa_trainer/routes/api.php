<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScenarioApiController;
use App\Http\Controllers\Api\DesaTrainerApiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para obtener la información escenarios mediante la API REST
Route::get('/scenarios', [ScenarioApiController::class, 'index']);
Route::get('/scenarios/{id}', [ScenarioApiController::class, 'show']);

Route::get('/desa_trainers', [DesaTrainerApiController::class, 'index']);
Route::get('/desa_trainers/{id}', [DesaTrainerApiController::class, 'show']);