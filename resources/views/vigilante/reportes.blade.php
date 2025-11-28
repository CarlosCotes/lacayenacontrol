@extends('vigilante.index')
@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📊 Reportes de Accesos') }}
        </h2>
@endsection

@section('contenido')

                {{-- 🔹 FORMULARIO DE FILTRO --}}
                <form action="{{ route('vigilante.generarReportes') }}" method="POST" class="mb-8 bg-gray-50 p-6 rounded-lg shadow-inner animate-fadeIn">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="fecha_inicio" class="block text-gray-700 font-medium mb-1">📅 Fecha Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="w-full border-gray-300 focus:border-sky-400 focus:ring-sky-400 rounded-lg px-3 py-2" required>
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-gray-700 font-medium mb-1">📅 Fecha Fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" class="w-full border-gray-300 focus:border-sky-400 focus:ring-sky-400 rounded-lg px-3 py-2" required>
                        </div>

                        <div>
                            <label for="documento_usuario" class="block text-gray-700 font-medium mb-1">🧾 Documento Usuario (opcional):</label>
                            <input type="text" id="documento_usuario" name="documento_usuario" placeholder="Ej: 123456789"
                                   class="w-full border-gray-300 focus:border-sky-400 focus:ring-sky-400 rounded-lg px-3 py-2">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 gap-3">
                        <!-- Generar Reporte -->
                        <button type="submit" 
                            class="bg-gradient-to-br from-cyan-300 to-cyan-400 hover:from-blue-500 hover:to-blue-600 text-white px-5 py-2.5 rounded-xl shadow-md transition transform hover:scale-105 font-semibold animate-fadeIn">
                            🔍 Generar Reporte
                        </button>

                        <!-- Exportar PDF -->
                        <a href="{{ route('vigilante.reportes', ['export' => 'pdf']) }}" 
                           class="bg-gradient-to-br from-indigo-300 to-indigo-400 hover:from-blue-500 hover:to-blue-600 text-white px-4 py-2 rounded-xl shadow-md font-semibold transition transform hover:scale-105 animate-fadeIn">
                            📕 Exportar PDF
                        </a>

                        <!-- Exportar Excel -->
                        <a href="{{ route('vigilante.reportes', ['export' => 'excel']) }}" 
                           class="bg-gradient-to-br from-violet-300 to-violet-400 hover:from-blue-500 hover:to-blue-600 text-white px-4 py-2 rounded-xl shadow-md font-semibold transition transform hover:scale-105 animate-fadeIn">
                            📗 Exportar Excel
                        </a>
                    </div>
                </form>

                {{-- 🔹 TABLA DE RESULTADOS --}}
                @if($accesos->isEmpty())
                    <p class="text-gray-600 text-center mt-6 animate-fadeIn">❌ No se encontraron registros en el rango seleccionado.</p>
                @else
                    <div class="overflow-x-auto mt-6 animate-fadeIn">
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
                                    <tr class="text-center hover:bg-gray-50 transition transform hover:scale-105 hover:shadow-md">
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

  {{-- PAGINACIÓN PERSONALIZADA  --}}
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