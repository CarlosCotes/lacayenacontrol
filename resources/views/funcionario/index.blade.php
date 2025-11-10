<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Funcionario') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- 🔹 Gestión de Empleados -->
            <a href="{{ route('funcionario.trabajadores') }}" 
               class="bg-white shadow-sm rounded-2xl p-6 hover:shadow-lg transition transform hover:-translate-y-1 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Gestión de Empleados</h3>
                        <p class="text-gray-500 mt-1 text-sm">Ver, editar o registrar empleados</p>
                    </div>
                    <div class="text-blue-600 text-3xl">👥</div>
                </div>
            </a>

            <!-- 🔹 Historial de Accesos -->
            <a href="{{ route('funcionario.historial') }}" 
               class="bg-white shadow-sm rounded-2xl p-6 hover:shadow-lg transition transform hover:-translate-y-1 focus:ring-2 focus:ring-green-300 focus:outline-none">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Historial de Accesos</h3>
                        <p class="text-gray-500 mt-1 text-sm">Consultar accesos del personal</p>
                    </div>
                    <div class="text-green-600 text-3xl">📋</div>
                </div>
            </a>

            <!-- 🔹 Reportes y Estadísticas -->
            <a href="{{ route('funcionario.reportes') }}" 
               class="bg-white shadow-sm rounded-2xl p-6 hover:shadow-lg transition transform hover:-translate-y-1 focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Reportes y Estadísticas</h3>
                        <p class="text-gray-500 mt-1 text-sm">Filtra y exporta en PDF o Excel</p>
                    </div>
                    <div class="text-purple-600 text-3xl">📊</div>
                </div>
            </a>

            <!-- 🔹 Accesos de Vehículos -->
            <a href="{{ route('funcionario.vehiculos.historial') }}"
               class="bg-white shadow-sm rounded-2xl p-6 hover:shadow-lg transition transform hover:-translate-y-1 focus:ring-2 focus:ring-yellow-300 focus:outline-none">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Accesos de Vehículos</h3>
                        <p class="text-gray-500 mt-1 text-sm">Consultar entradas y salidas vehiculares</p>
                    </div>
                    <div class="text-yellow-600 text-3xl">🚗</div>
                </div>
            </a>

            <!-- 🔹 Alertas e Incidencias -->
            <a href="{{ route('funcionario.incidentes.index') }}" 
               class="bg-white shadow-sm rounded-2xl p-6 hover:shadow-lg transition transform hover:-translate-y-1 focus:ring-2 focus:ring-red-300 focus:outline-none">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Alertas e Incidencias</h3>
                        <p class="text-gray-500 mt-1 text-sm">Revisar notificaciones del personal de seguridad</p>
                    </div>
                    <div class="text-red-600 text-3xl">⚠️</div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
