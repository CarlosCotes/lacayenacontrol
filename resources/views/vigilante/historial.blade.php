<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora Entrada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora Salida</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($accesos as $acceso)
                            <tr>
                                <td class="px-6 py-4">{{ $acceso->user->name }}</td>
                                <td class="px-6 py-4">{{ $acceso->hora_entrada }}</td>
                                <td class="px-6 py-4">{{ $acceso->hora_salida }}</td>
                                <td class="px-6 py-4">{{ $acceso->tipo }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay registros.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <a href="{{ route('vigilante.dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-3">
                    ← Volver al inicio
                </a>
        </div>
    </div>
</x-app-layout>
