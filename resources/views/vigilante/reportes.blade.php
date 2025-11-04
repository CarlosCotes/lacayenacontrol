<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('vigilante.generarReportes') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-1 font-semibold">Fecha Inicio:</label>
                            <input type="date" name="fecha_inicio" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Fecha Fin:</label>
                            <input type="date" name="fecha_fin" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Documento Usuario (opcional):</label>
                            <input type="text" name="documento_usuario" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                    <button type="submit" class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Generar Reporte
                    </button>
                </form>

                @if($accesos->isEmpty())
                    <p class="text-gray-600">No se encontraron registros en el rango seleccionado.</p>
                @else
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
                            @foreach($accesos as $acceso)
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

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al inicio
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
