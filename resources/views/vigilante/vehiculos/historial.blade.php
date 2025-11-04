<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Historial de Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($accesos->isEmpty())
                    <p class="text-gray-600">No hay registros de accesos de vehículos.</p>
                @else
                    <table class="min-w-full border border-gray-300 mt-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border">Placa</th>
                                <th class="py-2 px-4 border">Marca</th>
                                <th class="py-2 px-4 border">Modelo</th>
                                <th class="py-2 px-4 border">Vigilante</th>
                                <th class="py-2 px-4 border">Tipo</th>
                                <th class="py-2 px-4 border">Hora Entrada</th>
                                <th class="py-2 px-4 border">Hora Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accesos as $acceso)
                                <tr class="text-center">
                                    <td class="py-2 px-4 border">{{ $acceso->vehiculo->placa ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vehiculo->marca ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vehiculo->modelo ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->vigilante->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ ucfirst($acceso->tipo) }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
                                    <td class="py-2 px-4 border">{{ $acceso->hora_salida ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <a href="{{ route('vigilante.dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mt-4 inline-block">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
