<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Salida de Vehículo</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                {{-- Mensajes de éxito o error --}}
                @if(session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 text-red-600 font-semibold">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                {{-- Formulario de salida --}}
                <form action="{{ route('vehiculos.storeAcceso') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="tipo" value="salida">

                    <div>
                        <label class="block font-semibold mb-1">Placa del vehículo</label>
                        <input 
                            type="text" 
                            name="placa" 
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" 
                            placeholder="Ejemplo: ABC123"
                            required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Observación (opcional)</label>
                        <textarea 
                            name="observacion" 
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" 
                            rows="3" 
                            placeholder="Detalles adicionales..."></textarea>
                    </div>

                    <button 
                        type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Registrar salida
                    </button>
                </form>

                <a href="{{ route('vigilante.dashboard') }}" 
                   class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
