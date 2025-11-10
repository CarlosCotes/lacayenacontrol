<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Botón Volver -->
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('funcionario.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ← Volver al Dashboard
            </a>

            <!-- Botones exportar -->
            <div class="flex gap-2">
                <a href="{{ route('funcionario.reportes', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Exportar PDF</a>
                <a href="{{ route('funcionario.reportes', array_merge(request()->all(), ['export' => 'excel'])) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Exportar Excel</a>
            </div>
        </div>

        <!-- Filtros avanzados -->
        <form method="GET" class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-gray-700">Documento</label>
                <input type="text" name="documento" value="{{ request('documento') }}" class="border rounded px-2 py-1">
            </div>
            <div>
                <label class="block text-gray-700">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border rounded px-2 py-1">
            </div>
            <div>
                <label class="block text-gray-700">Fecha Fin</label>
                <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border rounded px-2 py-1">
            </div>
            <div>
                <label class="block text-gray-700">Tipo</label>
                <select name="tipo" class="border rounded px-2 py-1">
                    <option value="">Todos</option>
                    <option value="entrada" {{ request('tipo')=='entrada' ? 'selected' : '' }}>Entrada</option>
                    <option value="salida" {{ request('tipo')=='salida' ? 'selected' : '' }}>Salida</option>
                </select>
            </div>
            <div class="col-span-1 sm:col-span-4">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">Filtrar</button>
            </div>
        </form>

        <!-- Tabla de accesos filtrada -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if($accesos->isEmpty())
                <p class="text-gray-500 text-center">No hay registros que coincidan con los filtros.</p>
            @else
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr class="text-center">
                            <th class="px-4 py-2 border">Usuario</th>
                            <th class="px-4 py-2 border">Documento</th>
                            <th class="px-4 py-2 border">Hora Entrada</th>
                            <th class="px-4 py-2 border">Hora Salida</th>
                            <th class="px-4 py-2 border">Registrado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accesos as $acceso)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $acceso->user->name }}</td>
                                <td class="border px-4 py-2">{{ $acceso->user->documento }}</td>
                                <td class="border px-4 py-2">{{ $acceso->hora_entrada }}</td>
                                <td class="border px-4 py-2">{{ $acceso->hora_salida ?? '---' }}</td>
                                <td class="border px-4 py-2">{{ $acceso->vigilante->name ?? '---' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-app-layout>
