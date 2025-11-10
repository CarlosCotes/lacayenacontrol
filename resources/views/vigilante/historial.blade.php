<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

                {{-- ✅ Mensaje de éxito o error --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        ✅ {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                {{-- 🔍 Filtros opcionales (puedes activar luego) --}}
                {{-- 
                <form method="GET" action="{{ route('vigilante.historial') }}" class="flex gap-4 mb-6">
                    <input type="date" name="fecha" value="{{ request('fecha') }}" class="border p-2 rounded">
                    <select name="tipo" class="border p-2 rounded">
                        <option value="">-- Tipo de acceso --</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Filtrar
                    </button>
                </form>
                --}}

                {{-- 📋 Tabla de accesos --}}
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
                                <tr class="text-center hover:bg-gray-50 transition">
                                    <td class="py-2 px-4 border font-semibold text-gray-800">
                                        {{ $acceso->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4 border text-gray-700">
                                        {{ $acceso->vigilante->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4 border">
                                        <span class="{{ $acceso->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }} px-2 py-1 rounded text-sm font-medium">
                                            {{ ucfirst($acceso->tipo) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
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

                {{-- 🔙 Botón volver --}}
                <div class="mt-6">
                    <a href="{{ route('vigilante.dashboard') }}" 
                       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded transition">
                        ← Volver al inicio
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
