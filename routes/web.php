<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ADMINISTRADOR
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

});

// SUPERVISOR
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/supervisor/dashboard', function () {
        return view('supervisor.index');
    })->name('supervisor.dashboard');
    Route::get('/supervisor/reportes', [SupervisorController::class, 'reportes'])->name('supervisor.reportes');
});

// FUNCIONARIO
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/funcionario/dashboard', function () {
        return view('funcionario.index');
    })->name('funcionario.dashboard');
});

// VIGILANTE
Route::middleware(['auth', 'role:5'])->group(function () {
    
    // Panel principal
    Route::get('/vigilante/dashboard', [VigilanteController::class, 'index'])->name('vigilante.dashboard');

    // Registrar entrada

    Route::get('/vigilante/entradas', [VigilanteController::class, 'showEntradaForm'])->name('vigilante.entradas');
    Route::post('/vigilante/entradas', [VigilanteController::class, 'storeEntrada'])->name('vigilante.storeEntrada');

    Route::get('/vigilante/salidas', [VigilanteController::class, 'showSalidaForm'])->name('vigilante.salidas');
    Route::post('/vigilante/salidas', [VigilanteController::class, 'storeSalida'])->name('vigilante.storeSalida');

    Route::get('/vigilante/historial', [VigilanteController::class, 'historial'])->name('vigilante.historial');
    Route::get('/vigilante/reportes', [VigilanteController::class, 'reportes'])->name('vigilante.reportes');
    Route::get('/vigilante/generar-reportes', [VigilanteController::class, 'generarReportes'])->name('vigilante.generarReportes');

    Route::get('entrada', [VehiculoController::class, 'index'])->name('vehiculos.entrada');
    Route::post('entrada', [VehiculoController::class, 'storeAcceso'])->name('vehiculos.storeAcceso');
    Route::get('historial', [VehiculoController::class, 'historial'])->name('vehiculos.historial');
    Route::get('reportes', [VehiculoController::class, 'reportes'])->name('vehiculos.reportes');

});

Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso.denegado');


require __DIR__.'/auth.php';
