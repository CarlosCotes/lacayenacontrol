<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📊 Reportes de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- 🔹 FORMULARIO DE FILTRO --}}
                <form action="{{ route('vigilante.generarReportes') }}" method="POST" class="mb-8 bg-gray-50 p-6 rounded-lg shadow-inner">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="fecha_inicio" class="block text-gray-700 font-medium mb-1">📅 Fecha Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg px-3 py-2" required>
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-gray-700 font-medium mb-1">📅 Fecha Fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg px-3 py-2" required>
                        </div>

                        <div>
                            <label for="documento_usuario" class="block text-gray-700 font-medium mb-1">🧾 Documento Usuario (opcional):</label>
                            <input type="text" id="documento_usuario" name="documento_usuario" placeholder="Ej: 123456789"
                                   class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg px-3 py-2">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 gap-3">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow transition transform hover:scale-105">
                            🔍 Generar Reporte
                        </button>

                        <a href="{{ route('vigilante.reportes', ['export' => 'pdf']) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                            📕 Exportar PDF
                        </a>

                        <a href="{{ route('vigilante.reportes', ['export' => 'excel']) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            📗 Exportar Excel
                        </a>
                    </div>
                </form>

                {{-- 🔹 TABLA DE RESULTADOS --}}
                @if($accesos->isEmpty())
                    <p class="text-gray-600 text-center mt-6">❌ No se encontraron registros en el rango seleccionado.</p>
                @else
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="py-2 px-4 border text-center">Usuario</th>
                                    <th class="py-2 px-4 border text-center">Vigilante</th>
                                    <th class="py-2 px-4 border text-center">Tipo</th>
                                    <th class="py-2 px-4 border text-center">Hora Entrada</th>
                                    <th class="py-2 px-4 border text-center">Hora Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accesos as $acceso)
                                    <tr class="text-center hover:bg-gray-50 transition">
                                        <td class="py-2 px-4 border">{{ $acceso->user->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border">{{ $acceso->vigilante->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border">
                                            @if($acceso->tipo === 'entrada')
                                                <span class="text-green-700 font-semibold">Entrada</span>
                                            @else
                                                <span class="text-red-700 font-semibold">Salida</span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
                                        <td class="py-2 px-4 border">{{ $acceso->hora_salida ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('vigilante.dashboard') }}"
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
                        ← Volver al Panel del Vigilante
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
