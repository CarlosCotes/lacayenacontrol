<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Incidentes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <tr class="text-center">
                                <th class="py-2 px-4 border">Vigilante</th>
                                <th class="py-2 px-4 border">Usuario</th>
                                <th class="py-2 px-4 border">Documento</th>
                                <th class="py-2 px-4 border">Tipo</th>
                                <th class="py-2 px-4 border">Descripción</th>
                                <th class="py-2 px-4 border">Estado</th>
                                <th class="py-2 px-4 border">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incidentes as $incidente)
                                <tr class="text-center hover:bg-gray-50 transition">
                                    <td class="py-2 px-4 border">{{ $incidente->vigilante->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $incidente->usuario->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $incidente->usuario->documento ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border">{{ $incidente->tipo }}</td>
                                    <td class="py-2 px-4 border">{{ $incidente->descripcion }}</td>
                                    <td class="py-2 px-4 border">{{ ucfirst($incidente->estado) }}</td>
                                    <td class="py-2 px-4 border">{{ $incidente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-gray-500">
                                        No hay incidentes registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al Panel
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
