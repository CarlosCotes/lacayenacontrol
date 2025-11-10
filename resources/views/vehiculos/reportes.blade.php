<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Reportes de Vehículos</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('vehiculos.reportes') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Placa</label>
                            <input type="text" name="placa" value="{{ request('placa') }}" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Fecha fin</label>
                            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="w-full border rounded p-2">
                        </div>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-2">Generar Reporte</button>
                </form>

                @if(isset($accesos) && $accesos->isEmpty())
                    <p class="mt-4 text-gray-600">No se encontraron registros.</p>
                @elseif(isset($accesos))
                    <table class="min-w-full border border-gray-300 mt-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border">Placa</th>
                                <th class="py-2 px-4 border">Propietario</th>
                                <th class="py-2 px-4 border">Vigilante</th>
                                <th class="py-2 px-4 border">Tipo</th>
                                <th class="py-2 px-4 border">Hora Entrada</th>
                                <th class="py-2 px-4 border">Hora Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accesos as $acceso)
                                <tr class="text-center">
                                    <td class="py-2 px-4 border">{{ $acceso->vehiculo->placa }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vehiculo->propietario_nombre }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vigilante->name }}</td>
                                    <td class="py-2 px-4 border">{{ ucfirst($acceso->tipo) }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_salida ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <a href="{{ route('vigilante.dashboard') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
