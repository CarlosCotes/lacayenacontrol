<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Acceso;
use Illuminate\Support\Facades\Auth;

class VigilanteController extends Controller
{
    // Panel del vigilante
    public function index()
    {
        return view('vigilante.index');
    }

    // Formulario para registrar entrada
    public function showEntradaForm()
    {
        return view('vigilante.entradas');
    }

    // Registrar entrada de usuario
    public function storeEntrada(Request $request)
    {
        $request->validate([
            'documento' => 'required|exists:users,documento',
        ]);

        $usuario = User::where('documento', $request->documento)->first();

        if (!$usuario) {
            return redirect()->back()->withErrors(['documento' => 'Usuario no encontrado']);
        }

        Acceso::create([
            'user_id' => $usuario->id,
            'vigilante_id' => Auth::id(),
            'hora_entrada' => now(),
            'tipo' => 'entrada',
        ]);

        return redirect()->route('vigilante.dashboard')->with('success', 'Entrada registrada correctamente.');
    }

    // Formulario para registrar salida
    public function showSalidaForm()
    {
        return view('vigilante.salidas');
    }

    // Registrar salida de usuario
    public function storeSalida(Request $request)
    {
        $request->validate([
            'documento' => 'required|exists:users,documento',
        ]);

        $usuario = User::where('documento', $request->documento)->first();

        if (!$usuario) {
            return redirect()->back()->withErrors(['documento' => 'Usuario no encontrado']);
        }

        $ultimoAcceso = Acceso::where('user_id', $usuario->id)
            ->where('tipo', 'entrada')
            ->whereNull('hora_salida')
            ->latest('hora_entrada')
            ->first();

        if (!$ultimoAcceso) {
            return redirect()->back()->withErrors(['documento' => 'No se encontró una entrada pendiente para este usuario.']);
        }

        $ultimoAcceso->update([
            'hora_salida' => now(),
            'tipo' => 'salida',
            'vigilante_id' => Auth::id(),
        ]);

        return redirect()->route('vigilante.dashboard')->with('success', 'Salida registrada correctamente.');
    }

    // Historial completo de accesos
    public function historial()
    {
        $accesos = Acceso::with(['user', 'vigilante'])->orderBy('hora_entrada', 'desc')->get();
        return view('vigilante.historial', compact('accesos'));
    }

    // Vista de reportes (vacía al inicio)
    public function reportes()
    {       
        $accesos = collect();
        return view('vigilante.reportes', compact('accesos'));
    }

    // Generar reportes filtrados por fecha y/o usuario
    public function generarReportes(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'documento_usuario' => 'nullable|exists:users,documento',
        ]);

        $query = Acceso::with(['user', 'vigilante'])
            ->whereDate('hora_entrada', '>=', $request->fecha_inicio)
            ->whereDate('hora_entrada', '<=', $request->fecha_fin);

        if ($request->filled('documento_usuario')) {
            $query->whereHas('user', fn($q) => $q->where('documento', $request->documento_usuario));
        }

        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

        return view('vigilante.reportes', compact('accesos'));
    }
}
