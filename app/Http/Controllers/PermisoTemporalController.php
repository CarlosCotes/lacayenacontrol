<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermisoTemporal;
use Illuminate\Support\Facades\Auth;

class PermisoTemporalController extends Controller
{
     // FORMULARIO DEL FUNCIONARIO
     public function formFuncionario()
     {
         return view('funcionario.permisos.create');
     }
 
     // GUARDAR SOLICITUD
     public function store(Request $request)
     {
         $request->validate([
             'nombre_visitante' => 'required',
             'documento_visitante' => 'required',
             'fecha_ingreso' => 'required|date',
             'fecha_salida' => 'required|date|after:fecha_ingreso',
             'motivo' => 'nullable|string'
         ]);
 
         PermisoTemporal::create([
             'funcionario_id' => Auth::id(),
             'nombre_visitante' => $request->nombre_visitante,
             'documento_visitante' => $request->documento_visitante,
             'fecha_ingreso' => $request->fecha_ingreso,
             'fecha_salida' => $request->fecha_salida,
             'motivo' => $request->motivo,
         ]);
 
         return back()->with('success', 'Permiso temporal solicitado correctamente.');
     }
 
     // LISTA PARA SUPERVISOR
     public function pendientes()
     {
         $solicitudes = PermisoTemporal::where('estado', 'pendiente')->get();
         return view('supervisor.permisos.index', compact('solicitudes'));
     }
 
     // APROBAR
     public function aprobar($id)
     {
         $permiso = PermisoTemporal::findOrFail($id);
 
         $permiso->update([
             'estado' => 'aprobado',
             'supervisor_id' => Auth::id()
         ]);
 
         return back()->with('success', 'Permiso aprobado correctamente.');
     }
 
     // RECHAZAR
     public function rechazar($id)
     {
         $permiso = PermisoTemporal::findOrFail($id);
 
         $permiso->update([
             'estado' => 'rechazado',
             'supervisor_id' => Auth::id()
         ]);
 
         return back()->with('error', 'Permiso rechazado.');
     }
}
