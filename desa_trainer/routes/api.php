<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScenarioApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para obtener la información escenarios mediante la API REST
Route::get('/scenarios', [ScenarioApiController::class, 'index']);
Route::get('/scenarios/{id}', [ScenarioApiController::class, 'show']);
