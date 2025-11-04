<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Reportes de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-4 text-gray-700">
                    Filtra los registros por usuario o rango de fechas.
                </p>

                <!-- FORMULARIO DE FILTROS -->
                <form action="{{ route('vigilante.generarReportes') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-semibold">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Fecha fin</label>
                            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Documento Usuario</label>
                            <input type="text" name="documento" value="{{ request('documento') }}" placeholder="Opcional" class="w-full border-gray-300 rounded p-2">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Generar Reporte
                        </button>
                    </div>
                </form>
            </div>

            <!-- RESULTADOS -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                <a href="{{ route('vigilante.dashboard') }}" 
                   class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mb-4">
                    ← Volver al inicio
                </a>

                @if(isset($accesos) && $accesos->isEmpty())
                    <p class="text-gray-600">No se encontraron registros en el rango seleccionado.</p>
                @elseif(isset($accesos))
                    <table class="min-w-full border border-gray-300 mt-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border">Usuario</th>
                                <th class="py-2 px-4 border">Vigilante</th>
                                <th class="py-2 px-4 border">Tipo</th>
                                <th class="py-2 px-4 border">Hora Entrada</th>
                                <th class="py-2 px-4 border">Hora Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accesos as $acceso)
                                <tr class="text-center">
                                    <td class="py-2 px-4 border">{{ $acceso->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vigilante->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ ucfirst($acceso->tipo) }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_salida ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
