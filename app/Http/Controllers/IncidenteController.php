<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IncidenteController extends Controller
{
    // 🔹 Vigilante: vista para crear incidente
    public function create()
    {
        $usuarios = User::all();
        return view('vigilante.incidentes.create',compact('usuarios'));
    }

    // 🔹 Vigilante: guardar incidente
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string|max:1000',
        ]);

        Incidente::create([
            'vigilante_id' => Auth::id(),
            'user_id' => $request->user_id,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('vigilante.incidentes.create')
                         ->with('success', 'Incidente registrado correctamente.');
    }
    // Vigilante: ver sus propios incidentes
    public function misIncidentes()
    {
        $incidentes = Incidente::where('vigilante_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('vigilante.incidentes.index', compact('incidentes'));
    }   
    // 🔹 Funcionario: listar incidentes
        public function index()
        {
            $empresaId = Auth::user()->empresa_id;

            $incidentes = Incidente::with(['vigilante', 'usuario'])
                            ->whereHas('usuario', function($q) use ($empresaId) {
                                $q->where('empresa_id', $empresaId);
                            })
                            ->orWhereHas('vigilante', function($q) use ($empresaId) {
                                $q->where('empresa_id', $empresaId);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();

            return view('funcionario.incidentes.index', compact('incidentes'));
        }

    // 🔹 Funcionario: actualizar estado del incidente
    public function updateEstado(Request $request, Incidente $incidente)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,revisado,cerrado',
        ]);

        $incidente->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('funcionario.incidentes.index')
                         ->with('success', 'Estado del incidente actualizado.');
    }
}
