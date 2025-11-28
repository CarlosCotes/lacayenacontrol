<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\VehiculoAcceso; // ← IMPORTACIÓN CORRECTA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiculoController extends Controller
{
    /**
     * Mostrar formulario de entrada de vehículos
     */
    public function index()
    {
        return view('vehiculos.entrada');
    }

    /**
     * Mostrar formulario de salida de vehículos
     */
    public function salida()
    {
        return view('vehiculos.salida');
    }

    /**
     * Registrar ENTRADA del vehículo
     */
    public function storeEntrada(Request $request)
    {
        $request->validate([
            'placa' => 'required',
        ]);

        // Buscar vehículo
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        if (!$vehiculo) {
            return back()->with('error', 'El vehículo no está registrado.');
        }
        $ultimoAcceso = VehiculoAcceso::where('vehiculo_id', $vehiculo->id)
        ->orderByDesc('id')
        ->first();

        if ($ultimoAcceso && $ultimoAcceso->tipo === 'entrada' && $ultimoAcceso->hora_salida === null) {
            return back()->with('error', 'El vehículo ya está dentro. No puede registrar otra entrada.');
        }

        // Registrar acceso
        $acceso = VehiculoAcceso::create([
            'vehiculo_id' => $vehiculo->id,
            'tipo' => 'entrada',
            'vigilante_id' => Auth::id(),
            'hora_entrada' => now(),
            'empresa_id' => $vehiculo->empresa_id, // opcional según tu diseño
        ]);

        return view('vehiculos.mostrar', compact('vehiculo', 'acceso'))
            ->with('success', 'Entrada registrada correctamente.');
    }

    /**
     * Registrar SALIDA del vehículo
     */
    public function storeSalida(Request $request)
    {
        $request->validate([
            'placa' => 'required',
        ]);

        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        if (!$vehiculo) {
            return back()->with('error', 'El vehículo no está registrado.');
        }
        
        $ultimoAcceso = VehiculoAcceso::where('vehiculo_id', $vehiculo->id)
        ->orderByDesc('id')
        ->first();

        if (!$ultimoAcceso || $ultimoAcceso->tipo !== 'entrada' || $ultimoAcceso->hora_salida !== null) {
            return back()->with('error', 'No se puede registrar salida. El vehículo no tiene entrada pendiente.');
        }
        // Registrar salida
        $acceso = VehiculoAcceso::create([
            'vehiculo_id' => $vehiculo->id,
            'tipo' => 'salida',
            'vigilante_id' => Auth::id(),
            'hora_salida' => now(),
            'empresa_id' => $vehiculo->empresa_id,
        ]);

        return view('vehiculos.mostrar', compact('vehiculo', 'acceso'))
            ->with('success', 'Salida registrada correctamente.');
    }

    /**
     * Historial de entradas y salidas por roles
     */
    public function historial()
    {
        $user = Auth::user();
    
        $query = VehiculoAcceso::with(['vehiculo', 'vigilante', 'empresa']);
    
        if ($user->role_id == 3) {
            $query->where('empresa_id', $user->empresa_id);
            $accesos = $query->orderByDesc('hora_entrada')->paginate(10);
            return view('funcionario.vehiculos-accesos', compact('accesos'));
        }
    
        if ($user->role_id == 5) {
            $query->where('vigilante_id', $user->id);
            $accesos = $query->orderByDesc('hora_entrada')->paginate(10);
            return view('vigilante.vehiculos-accesos', compact('accesos')); 
        }
    
        abort(403, 'Acceso no autorizado');
    }

    /**
     * Reportes filtrados
     */
    public function reportes(Request $request)
    {
        $empresaId = Auth::user()->empresa_id;

        $query = VehiculoAcceso::with(['vehiculo', 'vigilante'])
            ->when($empresaId, fn($q) => $q->where('empresa_id', $empresaId));

        if ($request->filled('placa')) {
            $query->whereHas('vehiculo', fn($q) =>
                $q->where('placa', 'like', '%' . $request->placa . '%')
            );
        }

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('hora_entrada', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59',
            ]);
        }

        $accesos = $query->orderByDesc('hora_entrada')->paginate(15);

        return view('vehiculos.reportes', compact('accesos'));
    }
}
