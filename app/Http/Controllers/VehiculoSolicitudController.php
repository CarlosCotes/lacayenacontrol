<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiculoSolicitud;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VehiculoSolicitudController extends Controller
{
  /**
     * FORMULARIO: Crear solicitud de vehículo
     */
    public function create()
    {
    $usuario = Auth::user();

    // Empresa del funcionario
    $empresaId = $usuario->empresa_id;

    // Empleados de la empresa (para el select)
    $trabajadores = User::where('empresa_id', $empresaId)
                        ->orderBy('name', 'asc')
                        ->get();

    // Solicitudes del funcionario
    $vehiculos = VehiculoSolicitud::where('funcionario_id', $usuario->id)
                                  ->orderBy('created_at', 'desc')
                                  ->get();

    return view('funcionario.vehiculos.create', [
        'trabajadores' => $trabajadores,
        'vehiculos'    => $vehiculos
    ]);
 }

    /**
     * GUARDAR SOLICITUD
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'tipo' => 'required',
            'user_id' => 'required|exists:users,id',
            'motivo' => 'nullable'
        ]);
    
        VehiculoSolicitud::create([
            'placa' => $request->placa,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo ?? 'SIN MOTIVO',
            'estado' => 'PENDIENTE',
            'funcionario_id' => Auth::id(),
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->back()->with('success', 'Solicitud registrada correctamente.');
    }
    /**
     * LISTAR SOLICITUDES PARA EL SUPERVISOR
     */
    public function indexSupervisor()
    {
        $solicitudes = VehiculoSolicitud::where('estado', 'pendiente')
            ->with(['funcionario', 'empleado'])
            ->latest()
            ->paginate(10);

        return view('supervisor.vehiculos.index', compact('solicitudes'));
    }

    /**
     * APROBAR SOLICITUD
     */
    public function aprobar($id)
    {
        $solicitud = VehiculoSolicitud::findOrFail($id);
    
        // Verificar si ya existe
        $vehiculo = Vehiculo::where('placa', $solicitud->placa)->first();
    
        if (!$vehiculo) {
            Vehiculo::create([
                'placa'    => $solicitud->placa,
                'marca'    => $solicitud->marca,
                'modelo'   => $solicitud->modelo,
                'tipo'     => $solicitud->tipo,
                'user_id'  => $solicitud->user_id, // CORREGIDO
            ]);
        }
    
        $solicitud->estado = 'aprobada';
        $solicitud->save();
    
        return redirect()->back()->with('success', 'Solicitud aprobada correctamente.');
    }

    /**
     * RECHAZAR SOLICITUD
     */
    public function rechazar($id)
    {
        $solicitud = VehiculoSolicitud::findOrFail($id);
        $solicitud->estado = 'rechazada';
        $solicitud->save();

        return redirect()->back()->with('error', 'Solicitud rechazada.');
    }

}
