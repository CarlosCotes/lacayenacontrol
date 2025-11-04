<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Accesos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <table class="min-w-full border border-gray-300">
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
                        @forelse($accesos as $acceso)
                            <tr class="text-center">
                                <td class="py-2 px-4 border">{{ $acceso->user->name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $acceso->vigilante->name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ ucfirst($acceso->tipo) }}</td>
                                <td class="py-2 px-4 border">{{ $acceso->hora_entrada }}</td>
                                <td class="py-2 px-4 border">{{ $acceso->hora_salida ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-600">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al inicio
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
