<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Acceso;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'documento' => 'required|string',
        ]);
    
        $usuario = User::where('documento', $request->documento)->first();
    
        if (!$usuario) {
            return redirect()->back()->with('error', '❌ Usuario no encontrado.');
        }
    
        if ($usuario->estado !== 'activo') {
            return redirect()->back()->with('error', '⚠️ El usuario está inactivo y no puede registrar entrada.');
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
     // 🔹 Mostrar formulario de reportes
    public function reportes(Request $request)
    {
        $vigilanteId = Auth::user()->id; // Vigilante autenticado

        // Relacionar modelo Acceso con el vigilante
        $query = Acceso::with(['user', 'vigilante'])
            ->where('vigilante_id', $vigilanteId);

        // 🔹 Filtro por documento del usuario
        if ($request->filled('documento')) {
            $query->whereHas('user', fn($q) => $q->where('documento', $request->documento));
        }

        // 🔹 Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('hora_entrada', [$request->fecha_inicio, $request->fecha_fin]);
        }

        // 🔹 Filtro por tipo (entrada o salida)
        if ($request->filled('tipo')) {
            if ($request->tipo === 'entrada') {
                $query->whereNotNull('hora_entrada');
            } elseif ($request->tipo === 'salida') {
                $query->whereNotNull('hora_salida');
            }
        }

        // 🔹 Filtro por usuario específico
        if ($request->filled('empleado_id')) {
            $query->where('user_id', $request->empleado_id);
        }

        // Ordenar resultados
        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

        // 🔸 Exportar PDF
        if ($request->filled('export') && $request->export === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('vigilante.reportes-pdf', compact('accesos'));
            return $pdf->download('reporte_accesos_vigilante.pdf');
        }

        // 🔸 Exportar Excel
        if ($request->filled('export') && $request->export === 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\AccesosVigilanteExport($accesos),
                'reporte_accesos_vigilante.xlsx'
            );
        }

        // Retornar vista
        return view('vigilante.reportes', compact('accesos'));
    }
}