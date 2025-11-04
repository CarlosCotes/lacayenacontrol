<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Entrada') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('vigilante.storeEntrada') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <label for="documento" class="block font-semibold mb-1">Documento de identidad</label>
                        <input type="text" name="documento" id="documento" class="w-full border-gray-300 rounded p-2" required>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('vigilante.dashboard') }}" 
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow-md transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow-md transition duration-150">
                            Registrar Entrada
                        </button>
                    </div>
                </form>
                <a href="{{ route('vigilante.dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-3">
                    ← Volver al inicio
                </a>
                    
            </div>
        </div>
    </div>
</x-app-layout>
