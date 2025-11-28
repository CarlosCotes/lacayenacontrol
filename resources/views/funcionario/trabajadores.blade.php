@extends('funcionario.index') <!-- Tu layout principal -->

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Trabajadores de la Empresa') }}
    </h2>
@endsection

@section('contenido')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        @php
            $trabajadores = \App\Models\User::where('empresa_id', Auth::user()->empresa_id)->get();
        @endphp

        @if($trabajadores->isEmpty())
            <p class="text-gray-500 text-center animate-fadeIn">No hay trabajadores registrados.</p>
        @else
            <!-- Tabla -->
            <table class="min-w-full border border-gray-200 animate-fadeIn">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Documento</th>
                        <th class="px-4 py-2 border">Correo</th>
                        <th class="px-4 py-2 border">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trabajadores as $trabajador)
                        <tr class="text-center border px-4 py-2 transition-all duration-300 hover:scale-105 hover:shadow-md hover:bg-indigo-50">
                            <td class="border px-4 py-2">{{ $trabajador->name }}</td>
                            <td class="border px-4 py-2">{{ $trabajador->documento }}</td>
                            <td class="border px-4 py-2">{{ $trabajador->email }}</td>
                            <td class="border px-4 py-2">{{ $trabajador->role?->nombre ?? 'Sin rol' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection