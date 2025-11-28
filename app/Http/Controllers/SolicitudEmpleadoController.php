<?php

namespace App\Http\Controllers;

use App\Models\SolicitudEmpleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SolicitudEmpleadoController extends Controller
{
    /**
     * Vista del formulario para que el funcionario cree una solicitud
     */
    public function create()
    {
        return view('funcionario.solicitudes.create');
    }

    /**
     * Guardar la solicitud del funcionario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_empleado' => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'documento'       => 'required|string|max:50|unique:users,documento',
            'motivo'          => 'nullable|string',
        ]);

        $funcionario = Auth::user();

        SolicitudEmpleado::create([
            'funcionario_id'  => $funcionario->id,
            'empresa_id'      => $funcionario->empresa_id,
            'nombre_empleado' => $request->nombre_empleado,
            'email'           => $request->email,
            'documento'       => $request->documento,
            'cargo'           => 'empleado',
            'motivo'          => $request->motivo,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Solicitud enviada correctamente.');
    }

    /**
     * Vista del supervisor para ver solicitudes pendientes
     */
    public function indexSupervisor()
    {
        $solicitudes = SolicitudEmpleado::where('estado', 'pendiente')->get();

        return view('supervisor.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Historial de solicitudes aprobadas y rechazadas
     */
    public function historial()
    {
        $solicitudes = SolicitudEmpleado::whereIn('estado', ['aprobado', 'rechazado'])
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        return view('supervisor.solicitudes.historial', compact('solicitudes'));
    }

    /**
     * Aprobar una solicitud
     */
    public function aprobar($id)
    {
        $solicitud = SolicitudEmpleado::findOrFail($id);

        // Crear empleado automáticamente
        $empleado = User::create([
            'name'       => $solicitud->nombre_empleado,
            'email'      => $solicitud->email,
            'documento'  => $solicitud->documento,
            'password'   => Hash::make('12345678'),
            'role_id'    => 4, // Empleado
            'empresa_id' => $solicitud->empresa_id,
            'estado'     => 'activo',
        ]);

        // Actualizar solicitud
        $solicitud->update([
            'estado'            => 'aprobado',
            'supervisor_id'     => Auth::id(),
            'fecha_aprobacion'  => now(),
        ]);

        return back()->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Rechazar una solicitud
     */
    public function rechazar(Request $request, $id)
    {
        $request->validate([
            'motivo_rechazo' => 'required|string'
        ]);

        $solicitud = SolicitudEmpleado::findOrFail($id);

        $solicitud->update([
            'estado'         => 'rechazado',
            'supervisor_id'  => Auth::id(),
            'motivo_rechazo' => $request->motivo_rechazo
        ]);

        return back()->with('success', 'Solicitud rechazada.');
    }
}
