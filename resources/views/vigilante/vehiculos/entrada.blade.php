<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Acceso Vehículo</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <form action="{{ route('vehiculos.storeAcceso') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-semibold mb-1">Placa del vehículo</label>
                        <input type="text" name="placa" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tipo de registro</label>
                        <select name="tipo" class="w-full border rounded p-2" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Registrar</button>
                </form>

                <a href="{{ route('vigilante.dashboard') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
