<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Acceso;
use Illuminate\Support\Facades\Auth;
class VigilanteController extends Controller
{
    public function index()
    {
        return view('vigilante.index');
    }

    public function showEntradaForm()
    {
        return view('vigilante.entradas');
    }

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

    public function showSalidaForm()
    {
        return view('vigilante.salidas');
    }

    public function storeSalida(Request $request)
    {
   // Validar que se haya enviado un documento y exista en la tabla users
   $request->validate([
    'documento' => 'required|exists:users,documento',
]);

// Buscar el usuario por documento
$usuario = User::where('documento', $request->documento)->first();

if (!$usuario) {
    return redirect()->back()->withErrors(['documento' => 'Usuario no encontrado']);
}

// Buscar la última entrada del usuario que aún no tenga salida
$ultimoAcceso = Acceso::where('user_id', $usuario->id)
    ->where('tipo', 'entrada')
    ->whereNull('hora_salida')
    ->latest('hora_entrada')
    ->first();

if (!$ultimoAcceso) {
    return redirect()->back()->withErrors(['documento' => 'No se encontró una entrada pendiente para este usuario.']);
}

// Actualizar la hora_salida y cambiar el tipo a salida
$ultimoAcceso->update([
    'hora_salida' => now(),
    'tipo' => 'salida',
    'vigilante_id' => auth()->id(), // Registrar qué vigilante hizo la salida
]);

return redirect()->route('vigilante.dashboard')->with('success', 'Salida registrada correctamente.');
}
   

    public function historial()
    {
        $accesos = Acceso::with('user')->orderBy('hora_entrada', 'desc')->get();
        return view('vigilante.historial', compact('accesos'));
        return view('vigilante.historial');
    }
    public function reportes()
    {       
        $accesos = collect();

        // Retornamos la vista con la variable
        return view('vigilante.reportes', compact('accesos'));
    }
    public function generarReportes(Request $request)
    {
        // Validar fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        // Obtener los accesos filtrados
        $accesos = Acceso::with(['user', 'vigilante'])
            ->whereDate('hora_entrada', '>=', $request->fecha_inicio)
            ->whereDate('hora_entrada', '<=', $request->fecha_fin)
            ->orderBy('hora_entrada', 'desc')
            ->get();
    
        // Retornar la misma vista de reportes, pero con los datos
        return view('vigilante.reportes', compact('accesos'));
    }
}
