<?php

use App\Http\Controllers\AddUser;
use App\Http\Controllers\ScenarioController;
use App\Http\Controllers\TransitionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DESAController;
use App\Http\Controllers\InstructionsController;
use App\Http\Middleware\checkRole;
use App\Http\Middleware\checkRoleExamen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulatorController;



// Redirigir la página de inicio a la de login
Route::get('/', function () {
    return redirect()->route('index');
});

Route::middleware(['auth', 'verified', checkRoleExamen::class])->prefix('examen')->group(function () {
    Route::get('/examen/{scenarioId}',[ScenarioController::class, 'show'])->name('examen.show');

});
// Rutas para el panel de control
Route::middleware(['auth', 'verified', checkRole::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // RUTAS USUARIOS
    Route::resource('users', UserController::class);

    // Rutas de escenarios
    Route::resource('scenarios', ScenarioController::class);

    // RUTAS DESA
    Route::resource('desa', DESAController::class);

    Route::get('desa/{id}/edit-buttons', [DesaController::class, 'editButtons'])->name('desa.editButtons');

    // RUTAS instrucciones

    Route::resource('instructions', InstructionsController::class)->except(['create', 'store']);

    // Ruta manual para el método 'create', incluyendo el 'scenario_id'
    Route::get('scenarios/{scenario}/instructions/create', [InstructionsController::class, 'create'])->name('instructions.create');

    // Ruta manual para el método 'store', incluyendo el 'scenario_id'
    Route::post('scenarios/{scenario}/instructions', [InstructionsController::class, 'store'])->name('instructions.store');

    // Rutas Transiciones
    Route::resource('scenarios/{scenario}/transitions', TransitionsController::class)->except(['index']);

    Route::patch('/scenarios/{scenario}/status', [ScenarioController::class, 'updateStatus'])->name('scenarios.updateStatus');
    

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [SimulatorController::class, 'index'] )->name('dashboard');

    Route::get('/simulator', [SimulatorController::class, 'index'])->name('simulator.index');
    
});

// Rutas para la página principal

Route::get('/index', function () {
    return view('index');
})->name('index');

