<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\SolicitudEmpleadoController;
use App\Http\Controllers\PermisoTemporalController;
use App\Http\Controllers\VehiculoSolicitudController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    switch ($user->role_id) {
        case 1:
            return redirect()->route('admin.dashboard');
        case 2:
            return redirect()->route('supervisor.dashboard');
        case 3:
            return redirect()->route('funcionario.dashboard');
        case 5:
            return redirect()->route('vigilante.dashboard');
        default:
            return view('dashboard'); 
    }
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
    Route::get('/supervisor/dashboard', function () {return view('supervisor.index');})->name('supervisor.dashboard');
    Route::get('/supervisor/reportes', [SupervisorController::class, 'reportes'])->name('supervisor.reportes');
    Route::get('/supervisor/solicitudes', [SolicitudEmpleadoController::class, 'indexSupervisor'])->name('supervisor.solicitudes.index');
    Route::get('/supervisor/solicitudes/historial', [SolicitudEmpleadoController::class, 'historial'])->name('supervisor.solicitudes.historial');
    Route::post('/supervisor/solicitudes/{id}/aprobar', [SolicitudEmpleadoController::class, 'aprobar'])->name('solicitudes.aprobar');
    Route::post('/supervisor/solicitudes/{id}/rechazar', [SolicitudEmpleadoController::class, 'rechazar'])->name('solicitudes.rechazar');
    Route::get('/supervisor/permisos', [PermisoTemporalController::class, 'pendientes'])->name('supervisor.permisos');
    Route::post('/supervisor/permisos/{id}/aprobar', [PermisoTemporalController::class, 'aprobar'])->name('supervisor.permisos.aprobar');
    Route::post('/supervisor/permisos/{id}/rechazar', [PermisoTemporalController::class, 'rechazar'])->name('supervisor.permisos.rechazar');
    Route::get('/supervisor/vehiculos/solicitudes', [VehiculoSolicitudController::class, 'indexSupervisor'])->name('supervisor.vehiculos.index');
    Route::post('/supervisor/vehiculos/solicitudes/{id}/aprobar', [VehiculoSolicitudController::class, 'aprobar'])->name('supervisor.vehiculos.aprobar');
    Route::post('/supervisor/vehiculos/solicitudes/{id}/rechazar', [VehiculoSolicitudController::class, 'rechazar'])->name('supervisor.vehiculos.rechazar');

});

// 🔹 FUNCIONARIO
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/funcionario/dashboard', [FuncionarioController::class, 'index'])->name('funcionario.dashboard');
    Route::get('/funcionario/trabajadores', [FuncionarioController::class, 'trabajadores'])->name('funcionario.trabajadores');
    Route::get('/funcionario/historial', [FuncionarioController::class, 'historial'])->name('funcionario.historial');
    Route::get('/funcionario/reportes', [FuncionarioController::class, 'reportes'])->name('funcionario.reportes');
    Route::get('/funcionario/vehiculos/accesos', [VehiculoController::class, 'historial'])->name('funcionario.vehiculos-accesos');
    Route::get('funcionario/incidentes', [IncidenteController::class, 'index'])->name('funcionario.incidentes.index');
    Route::patch('funcionario/incidentes/{incidente}/estado', [IncidenteController::class, 'updateEstado'])->name('funcionario.incidentes.updateEstado');
    Route::get('/funcionario/solicitudes/create', [SolicitudEmpleadoController::class, 'create'])->name('funcionario.solicitudes.create');
    Route::post('/funcionario/solicitudes/store', [SolicitudEmpleadoController::class, 'store'])->name('funcionario.solicitudes.store');
    Route::patch('funcionario/incidentes/{incidente}/estado', [IncidenteController::class, 'updateEstado'])->name('funcionario.incidentes.updateEstado');
    Route::get('/funcionario/permisos', [PermisoTemporalController::class, 'formFuncionario'])->name('funcionario.permisos');
    Route::post('/funcionario/permisos', [PermisoTemporalController::class, 'store'])->name('funcionario.permisos.store');
    Route::get('/funcionario/solicitud/crear', [VehiculoSolicitudController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos/solicitud', [VehiculoSolicitudController::class, 'store'])->name('vehiculos.store');
    Route::get('/vehiculos/empleados', [VehiculoSolicitudController::class, 'getEmpleadosPorFuncionario'])->name('vehiculos.empleados');
    

});

// 🔹 VIGILANTE
Route::middleware(['auth', 'role:5'])->group(function () {
    Route::get('/vigilante/dashboard', [VigilanteController::class, 'index'])->name('vigilante.dashboard');
    Route::get('/vigilante/entradas', [VigilanteController::class, 'showEntradaForm'])->name('vigilante.entradas');
    Route::post('/vigilante/entradas', [VigilanteController::class, 'storeEntrada'])->name('vigilante.storeEntrada');
    Route::get('/vigilante/salidas', [VigilanteController::class, 'showSalidaForm'])->name('vigilante.salidas');
    Route::get('/vigilante/acceso/{id}', [VigilanteController::class, 'mostrar'])->name('vigilante.mostrar');
    Route::post('/vigilante/salidas', [VigilanteController::class, 'storeSalida'])->name('vigilante.storeSalida');
    Route::get('/vigilante/historial', [VigilanteController::class, 'historial'])->name('vigilante.historial');
    Route::get('/vigilante/reportes', [VigilanteController::class, 'reportes'])->name('vigilante.reportes');
    Route::get('/vigilante/generar-reportes', [VigilanteController::class, 'generarReportes'])->name('vigilante.generarReportes');
    Route::get('/vigilante/vehiculos/entrada', [VehiculoController::class, 'index'])->name('vehiculos.entrada');
    Route::get('/vigilante/vehiculos/salida', [VehiculoController::class, 'salida'])->name('vehiculos.salida');
    Route::post('/vigilante/vehiculos/entrada', [VehiculoController::class, 'storeEntrada'])->name('vehiculos.storeEntrada');
    Route::post('/vigilante/vehiculos/salida', [VehiculoController::class, 'storeSalida'])->name('vehiculos.storeSalida');
    Route::get('/vigilante/vehiculos/{id}', [VigilanteController::class, 'mostrar'])->name('vehiculos.mostrar');
    Route::get('/vehiculos/accesos', [VehiculoController::class, 'historial'])->name('vigilante.vehiculos-accesos');
    Route::get('/vigilante/vehiculos/reportes', [VehiculoController::class, 'reportes'])->name('vehiculos.reportes');
    Route::get('incidentes/create', [IncidenteController::class, 'create'])->name('vigilante.incidentes.create');
    Route::post('incidentes', [IncidenteController::class, 'store'])->name('vigilante.incidentes.store');
    Route::get('incidentes', [IncidenteController::class, 'misIncidentes'])->name('vigilante.incidentes.index');
    
});

// 🔹 Acceso denegado
Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso.denegado');

require __DIR__.'/auth.php';
