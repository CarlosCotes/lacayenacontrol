<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\VehiculoAcceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiculoController extends Controller
{
    /**
     * Mostrar formulario de registro de acceso
     */
    public function index()
    {
        
        return view('vehiculos.entrada');
    }
    public function salida()
    {
        return view('vehiculos.salida');
    }

    /**
     * Registrar entrada o salida del vehículo
     */
    public function storeAcceso(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|exists:vehiculos,placa',
            'tipo' => 'required|in:entrada,salida',
            'observacion' => 'nullable|string|max:255',
        ]);

        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        // Verificar si hay una entrada activa sin salida
        $accesoActivo = VehiculoAcceso::where('vehiculo_id', $vehiculo->id)
            ->whereNull('hora_salida')
            ->first();

        if ($request->tipo === 'entrada' && $accesoActivo) {
            return back()->with('error', 'El vehículo ya se encuentra dentro.');
        }

        if ($request->tipo === 'salida' && !$accesoActivo) {
            return back()->with('error', 'No hay una entrada activa para registrar la salida.');
        }

        // Crear o actualizar registro
        if ($request->tipo === 'entrada') {
        VehiculoAcceso::create([
            'vehiculo_id' => $vehiculo->id,
            'vigilante_id' => Auth::id(),
            'empresa_id' => $vehiculo->empresa_id ?? Auth::user()->empresa_id, // prioridad al vehículo
            'tipo' => 'entrada',
            'hora_entrada' => now(),
            'observacion' => $request->observacion,
        ]);
        } else {
            $accesoActivo->update([
                'hora_salida' => now(),
                'tipo' => 'salida',
                'observacion' => $request->observacion,
            ]);
        }

        return back()->with('success', 'Acceso registrado correctamente.');
    }

    /**
     * Historial de accesos de vehículos
     */
    public function historial()
    {
        $user = Auth::user();

        $query = VehiculoAcceso::with(['vehiculo', 'vigilante', 'empresa']);

        if ($user->role_id == 3) { // Funcionario
            $query->where('empresa_id', $user->empresa_id);
        } elseif ($user->role_id == 5) { // Vigilante
            $query->where('vigilante_id', $user->id);
        }

        $accesos = $query->orderByDesc('hora_entrada')->get();

        return view('vehiculos.historial', compact('accesos'));
    }


    /**
     * Reportes de accesos vehiculares
     */
    public function reportes(Request $request)
    {
        $empresaId = Auth::user()->empresa_id ?? null;

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

        // vista general: resources/views/vehiculos/reportes.blade.php
        return view('vehiculos.reportes', compact('accesos'));
    }
}
