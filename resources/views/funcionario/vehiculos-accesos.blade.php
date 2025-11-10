<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Historial Vehicular') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" class="mb-4 flex flex-wrap gap-2">
            <input type="text" name="placa" placeholder="Buscar por placa" value="{{ request('placa') }}" class="border rounded p-2">
            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="border rounded p-2">
            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="border rounded p-2">
            <select name="tipo" class="border rounded p-2">
                <option value="">Tipo</option>
                <option value="entrada" @selected(request('tipo') === 'entrada')>Entrada</option>
                <option value="salida" @selected(request('tipo') === 'salida')>Salida</option>
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrar</button>
        </form>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Placa</th>
                        <th class="px-4 py-2 text-left">Empleado</th>
                        <th class="px-4 py-2 text-left">Tipo</th>
                        <th class="px-4 py-2 text-left">Hora Entrada</th>
                        <th class="px-4 py-2 text-left">Hora Salida</th>
                        <th class="px-4 py-2 text-left">Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accesosVehiculares as $acceso)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $acceso->vehiculo->placa ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $acceso->vehiculo->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 capitalize">{{ $acceso->tipo }}</td>
                            <td class="px-4 py-2">{{ $acceso->hora_entrada }}</td>
                            <td class="px-4 py-2">{{ $acceso->hora_salida }}</td>
                            <td class="px-4 py-2">{{ $acceso->vigilante->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-gray-500">No hay registros</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
