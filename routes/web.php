<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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
Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/vigilante/dashboard', function () {
        return view('vigilante.index');
    })->name('vigilante.dashboard');
    Route::post('/vigilante/accesos', [AccesoController::class, 'registrar'])->name('accesos.registrar');
});

Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso.denegado');


require __DIR__.'/auth.php';
