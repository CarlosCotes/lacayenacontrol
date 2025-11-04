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
        // ✅ Cargar todos los roles disponibles
        $roles = Role::all();

        return view('admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|max:20|unique:users',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'role_id'    => 'required|integer'
        ]);

        User::create([
            'name'       => $request->name,
            'documento'  => $request->documento,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => $request->role_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'documento'  => 'required|string|max:20|unique:users,documento,' . $usuario->id,
            'email'      => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'role_id'    => 'required|integer'
        ]);

        $usuario->update([
            'name'       => $request->name,
            'documento'  => $request->documento,
            'email'      => $request->email,
            'role_id'    => $request->role_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.dashboard')->with('success', 'Usuario eliminado correctamente.');
    }
}
