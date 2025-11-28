@extends('funcionario.index')

@section('header')
<h2 class="text-xl font-semibold text-gray-800 leading-tight">
    {{ __('Historial Vehicular') }}
</h2>
@endsection

@section('contenido')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Formulario de filtros --}}
    <form method="GET" class="mb-4 flex flex-wrap gap-2">
        <input type="text" name="placa" placeholder="Buscar por placa" value="{{ request('placa') }}" class="border rounded p-2">
        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border rounded p-2">
        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border rounded p-2">
        <select name="tipo" class="border rounded p-2">
            <option value="">Tipo</option>
            <option value="entrada" @selected(request('tipo') === 'entrada')>Entrada</option>
            <option value="salida" @selected(request('tipo') === 'salida')>Salida</option>
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrar</button>
    </form>

    {{-- Tabla de accesos --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="table-auto w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Placa</th>
                    <th class="px-4 py-2">Vehículo</th>
                    <th class="px-4 py-2">Color</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Tipo de Acceso</th>
                    <th class="px-4 py-2">Hora Entrada</th>
                    <th class="px-4 py-2">Hora Salida</th>
                    <th class="px-4 py-2">Tiempo en el sitio</th>
                    <th class="px-4 py-2">Vigilante</th>
                    <th class="px-4 py-2">Empresa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accesos as $acceso)
                @php
                    $entrada = $acceso->hora_entrada ? \Carbon\Carbon::parse($acceso->hora_entrada) : null;
                    $salida  = $acceso->hora_salida ? \Carbon\Carbon::parse($acceso->hora_salida) : null;
                @endphp
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $acceso->vehiculo->placa ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $acceso->vehiculo->marca ?? '' }} {{ $acceso->vehiculo->modelo ?? '' }}</td>
                    <td class="px-4 py-2">{{ $acceso->vehiculo->color ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $acceso->vehiculo->tipo ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded {{ $acceso->tipo=='entrada' ? 'bg-green-200' : 'bg-red-200' }}">
                            {{ ucfirst($acceso->tipo) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $acceso->hora_entrada ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $acceso->hora_salida ?? '-' }}</td>
                    <td class="px-4 py-2">
                        @if ($entrada && $salida)
                            {{ $entrada->diffForHumans($salida, true) }}
                        @else
                            ---
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $acceso->vigilante->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $acceso->empresa->nombre ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4 text-gray-500">No hay registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación personalizada --}}
        @if ($accesos->hasPages())
        <div class="mt-6 flex justify-center">
            <ul class="flex space-x-2">
                {{-- Botón atrás --}}
                @if ($accesos->onFirstPage())
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">‹</li>
                @else
                    <li>
                        <a href="{{ $accesos->previousPageUrl() }}" class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">‹</a>
                    </li>
                @endif

                {{-- Números --}}
                @foreach ($accesos->getUrlRange(1, $accesos->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}" class="px-3 py-1 rounded-lg text-sm {{ $page==$accesos->currentPage()?'bg-indigo-300 text-white font-semibold':'text-gray-600 hover:bg-gray-200' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                {{-- Botón siguiente --}}
                @if ($accesos->hasMorePages())
                    <li>
                        <a href="{{ $accesos->nextPageUrl() }}" class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">›</a>
                    </li>
                @else
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">›</li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
