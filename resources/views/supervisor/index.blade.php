<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">

        <!-- ===== Menu izquierdo ===== -->
        <aside class="w-64 bg-white shadow-md border-r border-gray-200 p-4 overflow-y-auto">

            <h2 class="font-bold text-2xl text-gray-800 mb-6">
                {{ __('Panel del Supervisor') }}
            </h2>
            {{-- 🚗 Vehículos --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                🚗 Solicitudes Vehiculares
            </h3>

            <div class="space-y-3 mb-6">
                <a href="{{ route('supervisor.vehiculos.index') }}"
                    class="block w-full bg-orange-400 hover:bg-orange-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚗</div>
                    <div class="font-medium text-base">Revisar Solicitudes Vehiculares</div>
                </a>
            </div>
            {{-- 📝 Solicitudes --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                📝 Solicitudes
            </h3>
            <div class="space-y-3 mb-6">
                <a href="{{ route('supervisor.solicitudes.index') }}"
                   class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📝</div>
                    <div class="font-medium text-base">Ver Solicitudes</div>
                </a>
                <a href="{{ route('supervisor.permisos') }}"
                   class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📝</div>
                    <div class="font-medium text-base">Ver Solicitudes Temporales</div>
                </a>
                <a href="{{ route('supervisor.solicitudes.historial') }}"
                   class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📝</div>
                    <div class="font-medium text-base">Ver Historial</div>
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
                    👮 Bienvenido al Panel del Supervisor
                </div>
            @endif

        </main>

    </div>
</x-app-layout>
