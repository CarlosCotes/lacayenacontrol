<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">

        <!-- ===== Menu izquierdo ===== -->
        <aside class="w-64 bg-white shadow-md border-r border-gray-200 p-4 overflow-y-auto">

            <h2 class="font-bold text-2xl text-gray-800 mb-6">
                {{ __('Panel del Funcionario') }}
            </h2>

            {{-- 👥 Empleados --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                👥 Gestión de Empleados
            </h3>
            <div class="space-y-3 mb-6">
                <a href="{{ route('funcionario.trabajadores') }}"
                    class="block w-full bg-indigo-400 hover:bg-indigo-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">👥</div>
                    <div class="font-medium text-base">Empleados</div>
                </a>
            </div>

            {{-- 📋 Accesos --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                📋 Historial de Accesos
            </h3>
            <div class="space-y-3 mb-6">
                <a href="{{ route('funcionario.historial') }}"
                    class="block w-full bg-sky-400 hover:bg-sky-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📋</div>
                    <div class="font-medium text-base">Personas</div>
                </a>

                <a href="{{ route('funcionario.reportes') }}"
                    class="block w-full bg-violet-400 hover:bg-violet-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📊</div>
                    <div class="font-medium text-base">Reportes</div>
                </a>
            </div>

            {{-- 🚗 Vehículos --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                🚗 Accesos Vehiculares
            </h3>
            <div class="space-y-3 mb-6">
                <a href="{{ route('funcionario.vehiculos-accesos') }}"
                    class="block w-full bg-cyan-400 hover:bg-cyan-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚗</div>
                    <div class="font-medium text-base">Historial</div>
                </a>
            </div>

            {{-- ⚠️ Alertas --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                ⚠️ Alertas e Incidencias
            </h3>
            <div class="space-y-3 mb-6">
                <a href="{{ route('funcionario.incidentes.index') }}"
                    class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">⚠️</div>
                    <div class="font-medium text-base">Incidentes</div>
                </a>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                📝 Solicitudes
            </h3>

            <div class="space-y-3 mb-6">
                <a href="{{ route('funcionario.solicitudes.create') }}"
                    class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📝</div>
                    <div class="font-medium text-base">Solicitar Nuevo Empleado</div>
                </a>
            </div>
        </aside>

        <!-- ===== Contenido derecho ===== -->
        <main class="flex-1 p-8">

            {{-- HEADER PARA TITULOS DE CADA PÁGINA --}}
            @hasSection('header')
                <div class="mb-6">
                    @yield('header')
                </div>
            @endif

            {{-- CONTENIDO --}}
            @hasSection('contenido')
                @yield('contenido')
            @else
                <div class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    👮 Bienvenido al Panel del Funcionario
                </div>
            @endif

        </main>

    </div>
</x-app-layout>