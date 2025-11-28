@extends('vigilante.index')

@section('contenido')

<h2 class="font-semibold text-2xl text-gray-800 mb-6">
    Historial de Accesos
</h2>

<div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-2 px-4 border">Usuario</th>
                    <th class="py-2 px-4 border">Vigilante</th>
                    <th class="py-2 px-4 border">Tipo</th>
                    <th class="py-2 px-4 border">Hora de Entrada</th>
                    <th class="py-2 px-4 border">Hora de Salida</th>
                </tr>
            </thead>

            <tbody>
                @forelse($accesos as $acceso)
                    <tr class="text-center border px-4 py-2 hover:bg-indigo-50">

                        <td class="py-2 px-4 border font-semibold text-gray-800">
                            {{ $acceso->user->name ?? 'N/A' }}
                        </td>

                        <td class="py-2 px-4 border text-gray-700">
                            {{ $acceso->vigilante->name ?? 'N/A' }}
                        </td>

                        <td class="py-2 px-4 border">
                            <span class="{{ $acceso->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }} px-2 py-1 rounded text-sm">
                                {{ ucfirst($acceso->tipo) }}
                            </span>
                        </td>

                        <td class="py-2 px-4 border">
                            {{ $acceso->hora_entrada }}
                        </td>

                        <td class="py-2 px-4 border">
                            {{ $acceso->hora_salida ?? '—' }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            No hay registros de accesos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- PAGINACIÓN PERSONALIZADA --}}
    @if ($accesos->hasPages())
        <div class="mt-6 flex justify-center">
            <ul class="flex space-x-2">

                {{-- Botón atrás --}}
                @if ($accesos->onFirstPage())
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">‹</li>
                @else
                    <li>
                        <a href="{{ $accesos->previousPageUrl() }}" 
                           class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">
                            ‹
                        </a>
                    </li>
                @endif

                {{-- Números --}}
                @foreach ($accesos->getUrlRange(1, $accesos->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}" 
                           class="px-3 py-1 rounded-lg text-sm 
                           {{ $page == $accesos->currentPage() ? 'bg-indigo-300 text-white font-semibold' : 'text-gray-600 hover:bg-gray-200' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                {{-- Botón siguiente --}}
                @if ($accesos->hasMorePages())
                    <li>
                        <a href="{{ $accesos->nextPageUrl() }}" 
                           class="px-3 py-1 rounded-lg text-sm bg-gray-100 hover:bg-gray-200">
                            ›
                        </a>
                    </li>
                @else
                    <li class="px-3 py-1 text-gray-400 bg-gray-200 rounded-lg text-sm">›</li>
                @endif

            </ul>
        </div>
    @endif

</div>

@endsection