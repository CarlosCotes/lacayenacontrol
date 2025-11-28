@extends('vigilante.index')

@section('header')
        <div class="text-xl font-semibold text-gray-800 animate-fadeIn">Reportes de Vehículos</div>
@endsection

@section('contenido')
                {{-- Formulario filtros --}}
                <form action="{{ route('vehiculos.reportes') }}" method="GET" class="space-y-4 animate-fadeIn">
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

                    <!-- Botón estilo azul -->
                    <button 
                        type="submit" 
                        class="bg-sky-400 hover:bg-sky-500 text-white px-4 py-2 rounded-xl shadow-md transition transform hover:scale-105 duration-300 font-semibold animate-fadeIn">
                        Buscar Reporte
                    </button>
                </form>

                {{-- Tabla de resultados --}}
                @if(isset($accesos) && $accesos->isEmpty())
                    <p class="mt-4 text-gray-600 animate-fadeIn">No se encontraron registros.</p>
                @elseif(isset($accesos))
                    <div class="overflow-x-auto mt-4 animate-fadeIn">
                        <table class="min-w-full border border-gray-300">
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
                                    <tr class="text-center hover:bg-gray-50 transition transform hover:scale-105 hover:shadow-md animate-fadeIn">
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
                    </div>
                @endif

@endsection
