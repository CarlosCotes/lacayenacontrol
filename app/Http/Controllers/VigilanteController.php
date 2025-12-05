<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Acceso;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PermisoTemporal;

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
    {
        $request->validate(['documento' => 'required|string']);
    
        $usuario = User::where('documento', $request->documento)->first();
        $permiso  = PermisoTemporal::where('documento_visitante', $request->documento)->first();
    
        if (!$usuario && !$permiso) {
            return back()->with('error', '❌ No existe un usuario ni un permiso temporal con ese documento.');
        }
    
        // VISITANTE (permiso)
        if ($permiso) {
            $entradaActiva = Acceso::where('permiso_id', $permiso->id)
                ->whereNull('hora_salida')
                ->first();
    
            if ($entradaActiva) {
                return back()->with('error', '⚠️ Este visitante ya tiene una entrada activa.');
            }
    
            $acceso = Acceso::create([
                'permiso_id'   => $permiso->id,
                'user_id'      => null,
                'vigilante_id' => Auth::id(),
                'hora_entrada' => now(),
                'tipo'         => 'entrada',
                'origen'       => 'permiso',
            ]);
    
            return redirect()->route('vigilante.mostrar', $acceso->id)
                ->with('success', 'Entrada registrada correctamente (PERMISO TEMPORAL).');
        }
    
        // USUARIO
        if ($usuario) {
            if ($usuario->estado !== 'activo') {
                return back()->with('error', '⚠️ El usuario está inactivo.');
            }
    
            $entradaActiva = Acceso::where('user_id', $usuario->id)
                ->whereNull('hora_salida')
                ->first();
    
            if ($entradaActiva) {
                return back()->with('error', '⚠️ Este usuario ya tiene una entrada activa.');
            }
    
            $acceso = Acceso::create([
                'user_id'      => $usuario->id,
                'permiso_id'   => null,
                'vigilante_id' => Auth::id(),
                'hora_entrada' => now(),
                'tipo'         => 'entrada',
                'origen'       => 'user',
            ]);
    
            return redirect()->route('vigilante.mostrar', $acceso->id)
                ->with('success', 'Entrada registrada correctamente (USUARIO).');
        }
    }
    
}


    // Formulario para registrar salida
    public function showSalidaForm()
    {
        return view('vigilante.salidas');
    }

// Registrar salida de usuario
public function storeSalida(Request $request)
{
    $request->validate(['documento' => 'required|string']);

    $usuario = User::where('documento', $request->documento)->first();
    $permiso  = PermisoTemporal::where('documento_visitante', $request->documento)->first();

    if ($permiso) {
        $ultimoAcceso = Acceso::where('permiso_id', $permiso->id)
            ->whereNull('hora_salida')
            ->latest('hora_entrada')
            ->first();

        if (!$ultimoAcceso) {
            return back()->with('error', '⚠️ No hay una entrada activa para este visitante.');
        }

        $ultimoAcceso->update([
            'hora_salida'  => now(),
            'tipo'         => 'salida',
            'vigilante_id' => Auth::id(),
        ]);

        return redirect()->route('vigilante.mostrar', $ultimoAcceso->id)
            ->with('success', 'Salida registrada correctamente (PERMISO TEMPORAL).');
    }

    if ($usuario) {
        $ultimoAcceso = Acceso::where('user_id', $usuario->id)
            ->whereNull('hora_salida')
            ->latest('hora_entrada')
            ->first();

        if (!$ultimoAcceso) {
            return back()->with('error', '⚠️ No hay una entrada activa para este usuario.');
        }

        $ultimoAcceso->update([
            'hora_salida'  => now(),
            'tipo'         => 'salida',
            'vigilante_id' => Auth::id(),
        ]);

        return redirect()->route('vigilante.mostrar', $ultimoAcceso->id)
            ->with('success', 'Salida registrada correctamente (USUARIO).');
    }

    return back()->with('error', '❌ No se encontró registro para registrar salida.');

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
        $acceso = Acceso::findOrFail($id);

        // Intentamos encontrar un usuario con user_id
        $usuario = null;
        $permiso  = null;
        $registroTipo = 'user'; // por defecto
    
        if ($acceso->user_id) {
            $usuario = User::find($acceso->user_id);
            // Si no existe usuario, tal vez el user_id corresponde a un permiso temporal
            if (!$usuario) {
                $permiso = PermisoTemporal::find($acceso->user_id);
                if ($permiso) {
                    $registroTipo = 'permiso';
                }
            } else {
                // si existe usuario, pero podría igualmente corresponder también a un permiso (caso raro)
                // preferimos que sea usuario cuando ambos existen; si quieres preferir permiso,
                // cambia la lógica aquí.
                $registroTipo = 'user';
            }
        } else {
            // Si user_id está vacío, pero tienes permiso_id en otro campo (no en tu caso), podrías comprobarlo aquí.
            $registroTipo = 'user';
        }
    
        // Si no hay usuario y no hay permiso pero el acceso tiene campos propios (documento/nombre),
        // podríamos usarlos como fallback. Se puede agregar aquí.
    
        return view('vigilante.mostrar', compact('acceso', 'usuario', 'permiso', 'registroTipo'));
    
    }

}