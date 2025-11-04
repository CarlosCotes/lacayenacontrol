<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Vigilante') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-semibold mb-4">Accesos de Personas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <a href="{{ route('vigilante.entradas') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded shadow-md text-center">
                        Registrar Entrada
                    </a>
                    <a href="{{ route('vigilante.salidas') }}" class="bg-red-600 hover:bg-red-700 text-white p-6 rounded shadow-md text-center">
                        Registrar Salida
                    </a>
                    <a href="{{ route('vigilante.historial') }}" class="bg-gray-600 hover:bg-gray-700 text-white p-6 rounded shadow-md text-center">
                        Historial de Accesos
                    </a>
                    <a href="{{ route('vigilante.reportes') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded shadow-md text-center">
                        Reportes
                    </a>
                </div>

                <h3 class="text-lg font-semibold mb-4">Accesos de Vehículos</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('vehiculos.entrada', ['tipo' => 'entrada']) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded shadow-md text-center">
                        Registrar Entrada Vehículo
                    </a>
                    <a href="{{ route('vehiculos.entrada', ['tipo' => 'salida']) }}" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded shadow-md text-center">
                        Registrar Salida Vehículo
                    </a>
                    <a href="{{ route('vehiculos.historial') }}" class="bg-gray-500 hover:bg-gray-600 text-white p-6 rounded shadow-md text-center">
                        Historial Vehículos
                    </a>
                    <a href="{{ route('vehiculos.reportes') }}" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded shadow-md text-center">
                        Reportes Vehículos
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
