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

    // Evitar doble entrada: si ya tiene una entrada sin salida, no crear otra
    $entradaActiva = Acceso::where('user_id', $usuario->id)
        ->whereNull('hora_salida')
        ->first();

    if ($entradaActiva) {
        return redirect()->back()->with('error', 'Este usuario ya tiene una entrada activa y no ha registrado salida.');
    }

    // Crear y almacenar el objeto creado en $acceso (útil para redirecciones)
    $acceso = Acceso::create([
        'user_id' => $usuario->id,
        'vigilante_id' => Auth::id(),
        'hora_entrada' => now(),
        'tipo' => 'entrada',
    ]);

    // Redirigir a la vista de detalle del acceso (o donde prefieras)
    return redirect()->route('vigilante.mostrar', $acceso->id)
        ->with('success', 'Entrada registrada correctamente.');
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

    // Buscar la última entrada pendiente (sin hora_salida) — esto es lo importante
    $ultimoAcceso = Acceso::where('user_id', $usuario->id)
        ->whereNull('hora_salida')
        ->latest('hora_entrada')
        ->first();

    if (!$ultimoAcceso) {
        // Mensaje claro si no hay entrada pendiente
        return redirect()->back()->withErrors(['documento' => 'El usuario no tiene una entrada registrada, no se puede registrar salida.']);
    }

    // Actualizamos el registro encontrado (no creamos uno nuevo)
    $ultimoAcceso->update([
        'hora_salida' => now(),
        'tipo' => 'salida',
        'vigilante_id' => Auth::id(),
    ]);

    return redirect()->route('vigilante.mostrar', $ultimoAcceso->id)
        ->with('success', 'Salida registrada correctamente.');
}


    // Historial completo de accesos
    public function historial()
    {
        $accesos = Acceso::with(['user', 'vigilante'])
        ->orderBy('hora_entrada', 'desc')
        ->paginate(10); // ← AGREGAR ESTO

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
        $accesos = $query->orderBy('hora_entrada', 'desc')->paginate(10);

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
    public function mostrar($id)
    {
        // Buscar el acceso con sus relaciones
        $acceso = Acceso::with(['user', 'vigilante'])
            ->findOrFail($id);
    
        return view('vigilante.mostrar', compact('acceso'));
    }

}