<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'asc')->get();
        return view('admin.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        $empresas = \App\Models\Empresa::all();
    
        return view('admin.create', compact('roles', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|max:20|unique:users',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'role_id'    => 'required|integer',
            'empresa_id' => 'nullable|integer|exists:empresas,id',
        ]);
    
        User::create([
            'name'       => $request->name,
            'documento'  => $request->documento,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => $request->role_id,
            'empresa_id' => $request->empresa_id,
            'estado'     => 'activo',
        ]);
    
        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado correctamente.');
     }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        $empresas = \App\Models\Empresa::all();
    
        return view('admin.edit', compact('usuario', 'roles', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|max:20|unique:users,documento,' . $usuario->id,
            'email'      => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'role_id'    => 'required|integer',
            'empresa_id' => 'nullable|integer|exists:empresas,id',
        ]);
    
        $usuario->update([
            'name'       => $request->name,
            'documento'  => $request->documento,
            'email'      => $request->email,
            'role_id'    => $request->role_id,
            'empresa_id' => $request->empresa_id,
            'estado'     => $request->estado ?? $usuario->estado,
        ]);
    
        return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
      }
      public function toggleEstado($id)
      {
          $usuario = User::findOrFail($id);
      
          // Cambiamos el estado
          $usuario->estado = $usuario->estado === 'activo' ? 'inactivo' : 'activo';
          $usuario->save();
      
          return redirect()->route('admin.dashboard')->with('success', 'Estado del usuario actualizado correctamente.');
      }
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // Cambiar el estado a inactivo
        $usuario->estado = 'inactivo';
        $usuario->save();
    
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Usuario desactivado correctamente.');
      }
}
