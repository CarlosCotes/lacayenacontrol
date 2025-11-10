<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

            <!-- Filtros -->
            <form method="GET" class="mb-4 flex gap-4 flex-wrap items-end">
                <div>
                    <label class="block text-gray-700">Fecha:</label>
                    <input type="date" name="fecha" value="{{ request('fecha') }}" class="border px-2 py-1 rounded">
                </div>

                <div>
                    <label class="block text-gray-700">Tipo de Acceso:</label>
                    <select name="tipo" class="border px-2 py-1 rounded">
                        <option value="">Todos</option>
                        <option value="entrada" {{ request('tipo')=='entrada'?'selected':'' }}>Entrada</option>
                        <option value="salida" {{ request('tipo')=='salida'?'selected':'' }}>Salida</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Empleado:</label>
                    <select name="empleado_id" class="border px-2 py-1 rounded">
                        <option value="">Todos</option>
                        @foreach(\App\Models\User::where('empresa_id', Auth::user()->empresa_id)->get() as $empleado)
                            <option value="{{ $empleado->id }}" {{ request('empleado_id')==$empleado->id?'selected':'' }}>
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filtrar</button>
            </form>

            @if($accesos->isEmpty())
                <p class="text-gray-500 text-center">No hay accesos registrados con estos filtros.</p>
            @else
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100 text-center">
                        <tr>
                            <th class="px-4 py-2 border">Usuario</th>
                            <th class="px-4 py-2 border">Documento</th>
                            <th class="px-4 py-2 border">Hora Entrada</th>
                            <th class="px-4 py-2 border">Hora Salida</th>
                            <th class="px-4 py-2 border">Registrado por</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($accesos as $acceso)
                            <tr>
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
            <div class="mb-4">
            <a href="{{ route('funcionario.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ← Volver al Dashboard
            </a>
        </div>
        </div>
    </div>
</x-app-layout>
