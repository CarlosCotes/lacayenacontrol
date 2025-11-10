<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Vigilante') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">

                {{-- ✅ Mensaje de bienvenida --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        👮 Bienvenido al Panel de Control del Vigilante
                    </h3>
                    <p class="text-gray-600">
                        Desde aquí puedes registrar entradas, salidas y consultar los historiales tanto de personas como de vehículos.
                    </p>
                </div>

                {{-- 👤 Accesos de personas --}}
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                    👥 Accesos de Personas
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <a href="{{ route('vigilante.entradas') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">🚪</div>
                        <div class="font-semibold text-lg">Registrar Entrada</div>
                    </a>

                    <a href="{{ route('vigilante.salidas') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">🚶‍♂️</div>
                        <div class="font-semibold text-lg">Registrar Salida</div>
                    </a>

                    <a href="{{ route('vigilante.historial') }}" 
                       class="bg-gray-700 hover:bg-gray-800 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">📜</div>
                        <div class="font-semibold text-lg">Historial de Accesos</div>
                    </a>

                    <a href="{{ route('vigilante.reportes') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">📈</div>
                        <div class="font-semibold text-lg">Reportes</div>
                    </a>
                </div>
                {{-- 🚨 Incidentes --}}
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                    🚨 Incidentes
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    {{-- Crear incidente (vigilante) --}}
                    <a href="{{ route('vigilante.incidentes.create') }}" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">⚠️</div>
                        <div class="font-semibold text-lg">Registrar Incidente</div>
                    </a>

                    {{-- Lista de incidentes creados por este vigilante --}}
                    <a href="{{ route('vigilante.incidentes.index') }}"
                    class="bg-gray-700 hover:bg-gray-800 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">📋</div>
                        <div class="font-semibold text-lg">Mis Incidentes</div>
                    </a>


                </div>
                {{-- 🚗 Accesos de vehículos --}}
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                    🚗 Accesos de Vehículos
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('vehiculos.entrada') }}" 
                    class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">🚘</div>
                        <div class="font-semibold text-lg">Registrar Entrada Vehículo</div>
                    </a>

                    <a href="{{ route('vehiculos.salida') }}" 
                    class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">🚗</div>
                        <div class="font-semibold text-lg">Registrar Salida Vehículo</div>
                    </a>

                    <a href="{{ route('vehiculos.historial') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">📋</div>
                        <div class="font-semibold text-lg">Historial Vehículos</div>
                    </a>

                    <a href="{{ route('vehiculos.reportes') }}" 
                    class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-2xl shadow-md text-center transition transform hover:scale-105">
                        <div class="text-4xl mb-2">📊</div>
                        <div class="font-semibold text-lg">Reportes Vehículos</div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
