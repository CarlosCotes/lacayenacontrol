<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acceso;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; 
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\AccesosExport; 
use App\Models\VehiculoAcceso;
use App\Models\Vehiculo;

class FuncionarioController extends Controller
{
    // Dashboard principal
    public function index()
    {
        return view('funcionario.index'); // Solo enlaces a las secciones
    }

    // Listado de trabajadores de la empresa
    public function trabajadores()
    {
        $trabajadores = User::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('funcionario.trabajadores', compact('trabajadores'));
    }

    // Historial rápido de accesos
    public function historial(Request $request)
    {
        $empresaId = Auth::user()->empresa_id;

        $query = Acceso::with(['user', 'vigilante'])
            ->whereHas('user', fn($q) => $q->where('empresa_id', $empresaId));

        // Filtros simples
        if ($request->filled('fecha')) {
            $query->whereDate('hora_entrada', $request->fecha);
        }

        if ($request->filled('tipo')) {
            if ($request->tipo === 'entrada') $query->whereNotNull('hora_entrada');
            elseif ($request->tipo === 'salida') $query->whereNotNull('hora_salida');
        }

        if ($request->filled('empleado_id')) {
            $query->where('user_id', $request->empleado_id);
        }

        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

        return view('funcionario.historial', compact('accesos'));
    }

    // Reportes avanzados
    public function reportes(Request $request)
    {
        $empresaId = Auth::user()->empresa_id;

        $query = Acceso::with(['user', 'vigilante'])
            ->whereHas('user', fn($q) => $q->where('empresa_id', $empresaId));

        // Filtros avanzados
        if ($request->filled('documento')) {
            $query->whereHas('user', fn($q) => $q->where('documento', $request->documento));
        }

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('hora_entrada', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->filled('tipo')) {
            if ($request->tipo === 'entrada') $query->whereNotNull('hora_entrada');
            elseif ($request->tipo === 'salida') $query->whereNotNull('hora_salida');
        }

        if ($request->filled('empleado_id')) {
            $query->where('user_id', $request->empleado_id);
        }

        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

    // Exportar PDF usando la vista que creaste
    if ($request->filled('export') && $request->export === 'pdf') {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('funcionario.reportes-pdf', compact('accesos'));
        return $pdf->download('reporte_accesos.pdf');
    }

    // Exportar Excel
    if ($request->filled('export') && $request->export === 'excel') {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AccesosExport($accesos), 'reporte_accesos.xlsx');
    }

    return view('funcionario.reportes', compact('accesos'));
   }

    /** ==========================
     *  HISTORIAL DE ACCESOS VEHICULARES DE LA EMPRESA
     *  ========================== */
    // 🚗 NUEVO: Ver accesos vehiculares
    public function vehiculos(Request $request)
    {
        $empresaId = Auth::user()->empresa_id;

        if (!$empresaId) {
            return redirect()->back()->withErrors('No tienes una empresa asignada.');
        }

        $query = VehiculoAcceso::with(['vehiculo', 'vigilante'])
            ->whereHas('vehiculo', function ($q) use ($empresaId) {
                $q->where('empresa_id', $empresaId);
            });

        if ($request->filled('placa')) {
            $query->whereHas('vehiculo', fn($q) => $q->where('placa', 'like', "%{$request->placa}%"));
        }

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('hora_entrada', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $accesos = $query->orderBy('hora_entrada', 'desc')->get();

        return view('funcionario.vehiculos', compact('accesos'));
    }

    // 🔔 (Próximamente) Alertas / Incidencias
    public function alertas()
    {
        return view('funcionario.alertas');
    }

    // 🕒 (Próximamente) Permisos temporales
    public function permisos()
    {
        return view('funcionario.permisos');
    }
}
