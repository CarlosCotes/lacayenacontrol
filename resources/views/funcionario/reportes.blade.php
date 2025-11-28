@extends('funcionario.index') <!-- Tu layout principal -->

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Reportes de Accesos') }}
    </h2>
@endsection

@section('contenido')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Botón Volver y exportar -->
    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('funcionario.dashboard') }}" 
           class="inline-block bg-gradient-to-br from-indigo-300 to-indigo-400 hover:from-blue-500 hover:to-blue-600 text-white px-3 py-1.5 rounded-xl shadow-md text-center transition-all duration-300 hover:scale-105 font-semibold text-sm">
            ← Volver al Panel
        </a>

        <div class="flex gap-2 justify-end">
            <a href="{{ route('funcionario.reportes', array_merge(request()->all(), ['export' => 'pdf'])) }}" 
               class="bg-gradient-to-br from-rose-300 to-rose-400 hover:from-rose-400 hover:to-rose-500 text-white px-4 py-2 rounded-xl shadow-md transition-all duration-300 hover:scale-105 font-semibold text-sm"
               style="box-shadow: 0 4px 0 rgba(255, 196, 203, 0.4);">
                📕 Exportar PDF
            </a>

            <a href="{{ route('vigilante.reportes', ['export' => 'excel']) }}" 
               class="bg-gradient-to-br from-violet-300 to-violet-400 hover:from-blue-500 hover:to-blue-600 text-white px-4 py-2 rounded-xl shadow-md font-semibold transition">
                📗Exportar Excel
            </a>
        </div>
    </div>

    <!-- Filtros avanzados -->
    <form method="GET" class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label class="block text-gray-700">Documento</label>
            <input type="text" name="documento" value="{{ request('documento') }}" class="border rounded px-2 py-1">
        </div>
        <div>
            <label class="block text-gray-700">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border rounded px-2 py-1">
        </div>
        <div>
            <label class="block text-gray-700">Fecha Fin</label>
            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border rounded px-2 py-1">
        </div>
        <div>
            <label class="block text-gray-700">Tipo</label>
            <select name="tipo" class="border rounded px-2 py-1">
                <option value="">Todos</option>
                <option value="entrada" {{ request('tipo')=='entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="salida" {{ request('tipo')=='salida' ? 'selected' : '' }}>Salida</option>
            </select>
        </div>
        <div class="col-span-1 sm:col-span-4">
            <button type="submit" class="bg-sky-400 hover:bg-sky-500 text-white px-4 py-2 rounded-xl font-semibold">
                Filtrar
            </button>
        </div>
    </form>

    <!-- Tabla -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        @if($accesos->isEmpty())
            <p class="text-gray-500 text-center">No hay registros que coincidan con los filtros.</p>
        @else
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th class="px-4 py-2 border">Usuario</th>
                        <th class="px-4 py-2 border">Documento</th>
                        <th class="px-4 py-2 border">Hora Entrada</th>
                        <th class="px-4 py-2 border">Hora Salida</th>
                        <th class="px-4 py-2 border">Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accesos as $acceso)
                        <tr class="text-center border px-4 py-2 hover:bg-indigo-50">
                            <td class="border px-4 py-2">{{ $acceso->user->name }}</td>
                            <td class="border px-4 py-2">{{ $acceso->user->documento }}</td>
                            <td class="border px-4 py-2">{{ $acceso->hora_entrada }}</td>
                            <td class="border px-4 py-2">{{ $acceso->hora_salida ?? '---' }}</td>
                            <td class="border px-4 py-2">{{ $acceso->vigilante->name ?? '---' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection