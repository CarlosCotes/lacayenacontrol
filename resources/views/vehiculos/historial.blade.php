<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Accesos de Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($accesos->isEmpty())
                    <div class="text-center text-gray-500 py-6">
                        🚗 No hay registros de accesos de vehículos todavía.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                                <tr>
                                    <th class="py-2 px-4 border">Vigilante</th>
                                    <th class="py-2 px-4 border">Vehículo</th>
                                    <th class="py-2 px-4 border">Placa</th>
                                    <th class="py-2 px-4 border">Empresa</th>
                                    <th class="py-2 px-4 border">Tipo</th>
                                    <th class="py-2 px-4 border">Hora Entrada</th>
                                    <th class="py-2 px-4 border">Hora Salida</th>
                                    <th class="py-2 px-4 border">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accesos as $acceso)
                                    <tr class="text-center hover:bg-gray-50 transition">
                                        <td class="py-2 px-4 border">{{ $acceso->vigilante->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border">{{ $acceso->vehiculo->modelo ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border">{{ $acceso->vehiculo->placa ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border">{{ $acceso->empresa_id ? $acceso->empresa->nombre ?? $acceso->empresa_id : 'N/A' }}</td>
                                        <td class="py-2 px-4 border capitalize">{{ $acceso->tipo }}</td>
                                        <td class="py-2 px-4 border">
                                            {{ $acceso->hora_entrada ? \Carbon\Carbon::parse($acceso->hora_entrada)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                        <td class="py-2 px-4 border">
                                            {{ $acceso->hora_salida ? \Carbon\Carbon::parse($acceso->hora_salida)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                        <td class="py-2 px-4 border">{{ $acceso->observacion ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-6">
                    @if(Auth::user()->role_id == 3)
                        <a href="{{ route('funcionario.dashboard') }}" class="text-blue-600 hover:underline">
                            ← Volver al Dashboard Funcionario
                        </a>
                    @elseif(Auth::user()->role_id == 5)
                        <a href="{{ route('vigilante.dashboard') }}" class="text-blue-600 hover:underline">
                            ← Volver al Dashboard Vigilante
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
