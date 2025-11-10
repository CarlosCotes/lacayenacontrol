<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\IncidenteController;

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

// 🔹 ADMINISTRADOR
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::patch('/admin/{id}/toggle', [AdminController::class, 'toggleEstado'])->name('admin.toggle');
});

// 🔹 SUPERVISOR
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/supervisor/dashboard', function () {
        return view('supervisor.index');
    })->name('supervisor.dashboard');
    Route::get('/supervisor/reportes', [SupervisorController::class, 'reportes'])->name('supervisor.reportes');
});

// 🔹 FUNCIONARIO
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/funcionario/dashboard', [FuncionarioController::class, 'index'])->name('funcionario.dashboard');
    Route::get('/funcionario/trabajadores', [FuncionarioController::class, 'trabajadores'])->name('funcionario.trabajadores');
    Route::get('/funcionario/historial', [FuncionarioController::class, 'historial'])->name('funcionario.historial');
    Route::get('/funcionario/reportes', [FuncionarioController::class, 'reportes'])->name('funcionario.reportes');
    Route::get('/funcionario/vehiculos/historial', [VehiculoController::class, 'historial']) ->name('funcionario.vehiculos.historial');
    Route::get('funcionario/incidentes', [IncidenteController::class, 'index'])
        ->name('funcionario.incidentes.index');

    // Actualizar estado de un incidente
    Route::patch('funcionario/incidentes/{incidente}/estado', [IncidenteController::class, 'updateEstado'])
        ->name('funcionario.incidentes.updateEstado');
    });

// 🔹 VIGILANTE
Route::middleware(['auth', 'role:5'])->group(function () {
    Route::get('/vigilante/dashboard', [VigilanteController::class, 'index'])->name('vigilante.dashboard');
    Route::get('/vigilante/entradas', [VigilanteController::class, 'showEntradaForm'])->name('vigilante.entradas');
    Route::post('/vigilante/entradas', [VigilanteController::class, 'storeEntrada'])->name('vigilante.storeEntrada');
    Route::get('/vigilante/salidas', [VigilanteController::class, 'showSalidaForm'])->name('vigilante.salidas');
    Route::post('/vigilante/salidas', [VigilanteController::class, 'storeSalida'])->name('vigilante.storeSalida');
    Route::get('/vigilante/historial', [VigilanteController::class, 'historial'])->name('vigilante.historial');
    Route::get('/vigilante/reportes', [VigilanteController::class, 'reportes'])->name('vigilante.reportes');
    Route::get('/vigilante/generar-reportes', [VigilanteController::class, 'generarReportes'])->name('vigilante.generarReportes');
    Route::get('/vigilante/vehiculos/entrada', [VehiculoController::class, 'index'])->name('vehiculos.entrada');
    Route::get('/vigilante/vehiculos/salida', [VehiculoController::class, 'salida'])->name('vehiculos.salida');
    Route::post('/vigilante/vehiculos/entrada', [VehiculoController::class, 'storeAcceso'])->name('vehiculos.storeAcceso');
    Route::get('/vigilante/vehiculos/historial', [VehiculoController::class, 'historial'])->name('vehiculos.historial');
    Route::get('/vigilante/vehiculos/reportes', [VehiculoController::class, 'reportes'])->name('vehiculos.reportes');
    // Crear incidente
    Route::get('incidentes/create', [IncidenteController::class, 'create'])
        ->name('vigilante.incidentes.create');
    Route::post('incidentes', [IncidenteController::class, 'store'])
        ->name('vigilante.incidentes.store');

    // Lista de incidentes creados por el vigilante
    Route::get('incidentes', [IncidenteController::class, 'misIncidentes'])
        ->name('vigilante.incidentes.index'); // << nombre que faltaba

});

// 🔹 Acceso denegado
Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso.denegado');

require __DIR__.'/auth.php';
