<?php
namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\VehiculoAcceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiculoController extends Controller
{
    // Formulario de registro de acceso
    public function index()
    {
        return view('vigilante.vehiculos.entrada');
    }

    // Guardar entrada o salida
    public function storeAcceso(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|exists:vehiculos,placa',
            'tipo' => 'required|in:entrada,salida',
        ]);

        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        $acceso = new VehiculoAcceso();
        $acceso->vehiculo_id = $vehiculo->id;
        $acceso->vigilante_id = Auth::id();
        $acceso->tipo = $request->tipo;
        if ($request->tipo === 'entrada') $acceso->hora_entrada = now();
        if ($request->tipo === 'salida') $acceso->hora_salida = now();
        $acceso->save();

        return redirect()->back()->with('success', 'Acceso registrado correctamente.');
    }

    // Historial de vehículos
    public function historial()
    {
        $accesos = VehiculoAcceso::with('vehiculo', 'vigilante')->orderBy('hora_entrada', 'desc')->get();
        return view('vigilante.vehiculos.historial', compact('accesos'));
    }

    // Reportes de vehículos
    public function reportes(Request $request)
    {
        $query = VehiculoAcceso::with('vehiculo', 'vigilante');

        if ($request->filled('placa')) {
            $query->whereHas('vehiculo', fn($q) => $q->where('placa', $request->placa));
        }

        if ($request->filled('fecha_inicio')) {
            $query->where('hora_entrada', '>=', $request->fecha_inicio . ' 00:00:00');
        }

        if ($request->filled('fecha_fin')) {
            $query->where('hora_entrada', '<=', $request->fecha_fin . ' 23:59:59');
        }

        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

        return view('vigilante.vehiculos.reportes', compact('accesos'));
    }
}
