@extends('supervisor.index')

@section('header')
<h2 class="text-xl font-semibold text-gray-800 leading-tight">
    📝 Historial de Solicitudes
</h2>
@endsection

@section('contenido')

{{-- Formulario de filtros --}}
<form method="GET" class="mb-4 flex flex-wrap gap-2">
    <select name="estado" class="border rounded p-2">
        <option value="">Estado</option>
        <option value="aprobado" @selected(request('estado')=='aprobado')>Aprobado</option>
        <option value="rechazado" @selected(request('estado')=='rechazado')>Rechazado</option>
    </select>
    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border rounded p-2">
    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border rounded p-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrar</button>
</form>

{{-- Tabla de solicitudes --}}
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Funcionario</th>
                <th class="px-4 py-2 border">Empleado</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Documento</th>
                <th class="px-4 py-2 border">Estado</th>
                <th class="px-4 py-2 border">Supervisor</th>
                <th class="px-4 py-2 border">Fecha</th>
                <th class="px-4 py-2 border">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($solicitudes as $s)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $s->funcionario->name }}</td>
                    <td class="px-4 py-2">{{ $s->nombre_empleado }}</td>
                    <td class="px-4 py-2">{{ $s->email }}</td>
                    <td class="px-4 py-2">{{ $s->documento }}</td>
                    <td class="px-4 py-2">
                        @if($s->estado === 'aprobado')
                            <span class="px-2 py-1 bg-green-600 text-white rounded text-sm">Aprobado</span>
                        @else
                            <span class="px-2 py-1 bg-red-600 text-white rounded text-sm">Rechazado</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $s->supervisor->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $s->fecha_aprobacion ?? $s->updated_at }}</td>
                    <td class="px-4 py-2">{{ $s->motivo_rechazo ?? $s->motivo ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">No hay registros</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    @if ($solicitudes->hasPages())
        <div class="mt-6 flex justify-center">
            <ul class="flex space-x-2">
                @if ($solicitudes->onFirstPage())
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">‹</li>
                @else
                    <li>
                        <a href="{{ $solicitudes->previousPageUrl() }}" class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">‹</a>
                    </li>
                @endif

                @foreach ($solicitudes->getUrlRange(1, $solicitudes->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}" class="px-3 py-1 rounded-lg text-sm {{ $page==$solicitudes->currentPage()?'bg-indigo-300 text-white font-semibold':'text-gray-600 hover:bg-gray-200' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                @if ($solicitudes->hasMorePages())
                    <li>
                        <a href="{{ $solicitudes->nextPageUrl() }}" class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">›</a>
                    </li>
                @else
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">›</li>
                @endif
            </ul>
        </div>
    @endif
</div>

@endsection
