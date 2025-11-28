<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">

        <!-- ===== menu izquierdo ===== -->
        <aside class="w-64 bg-white shadow-md border-r border-gray-200 p-4 overflow-y-auto">

            <h2 class="font-bold text-2xl text-gray-800 mb-6">
                {{ __('Panel del Vigilante') }}
            </h2>

            {{-- 👥 Accesos de Personas --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                👥 Accesos de Personas
            </h3>

            <div class="space-y-3 mb-6">
                <a href="{{ route('vigilante.entradas') }}"
                    class="block w-full bg-sky-400 hover:bg-sky-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚪</div>
                    <div class="font-medium text-base">Entrada</div>
                </a>

                <a href="{{ route('vigilante.salidas') }}"
                    class="block w-full bg-indigo-400 hover:bg-indigo-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚶‍♂️</div>
                    <div class="font-medium text-base">Salida</div>
                </a>
            </div>

            {{-- 🚨 Incidentes --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                🚨 Incidentes
            </h3>

            <div class="space-y-3 mb-6">
                <a href="{{ route('vigilante.incidentes.create') }}"
                    class="block w-full bg-violet-400 hover:bg-violet-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">⚠️</div>
                    <div class="font-medium text-base">Registrar</div>
                </a>

                <a href="{{ route('vigilante.incidentes.index') }}"
                    class="block w-full bg-blue-400 hover:bg-blue-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📋</div>
                    <div class="font-medium text-base">Mis Incidentes</div>
                </a>
            </div>

            {{-- 🚗 Vehículos --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                🚗 Accesos de Vehículos
            </h3>

            <div class="space-y-3">
                <a href="{{ route('vehiculos.entrada') }}"
                    class="block w-full bg-sky-300 hover:bg-sky-400 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚘</div>
                    <div class="font-medium text-base">Entrada</div>
                </a>

                <a href="{{ route('vehiculos.salida') }}"
                    class="block w-full bg-indigo-300 hover:bg-indigo-400 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">🚗</div>
                    <div class="font-medium text-base">Salida</div>
                </a>
            </div>

            {{-- 📜 Personas --}}
            <h3 class="text-lg font-bold text-gray-800 mt-8 mb-2 border-b pb-1">
                📜 Historial y Reportes de Personas
            </h3>

            <div class="space-y-3 mb-5">
                <a href="{{ route('vigilante.historial') }}"
                    class="block w-full bg-cyan-400 hover:bg-cyan-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📜</div>
                    <div class="font-medium text-base">Historial</div>
                </a>

                <a href="{{ route('vigilante.reportes') }}"
                    class="block w-full bg-teal-400 hover:bg-teal-500 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📈</div>
                    <div class="font-medium text-base">Reportes</div>
                </a>
            </div>

            {{-- 📋 Vehículos --}}
            <h3 class="text-lg font-bold text-gray-800 mb-2 border-b pb-1">
                📋 Historial y Reportes de Vehículos
            </h3>

            <div class="space-y-3 mb-6">
                <a href="{{ route('vigilante.vehiculos-accesos') }}"
                    class="block w-full bg-cyan-300 hover:bg-cyan-400 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📋</div>
                    <div class="font-medium text-base">Historial</div>
                </a>

                <a href="{{ route('vehiculos.reportes') }}"
                    class="block w-full bg-teal-300 hover:bg-teal-400 text-white p-3 rounded-lg shadow-sm text-center transition duration-150 transform hover:scale-110">
                    <div class="text-2xl">📊</div>
                    <div class="font-medium text-base">Reportes</div>
                </a>
            </div>

        </aside>
        <main class="flex-1 p-8">
         {{-- HEADER PARA TITULOS DE CADA PÁGINA --}}
     @hasSection('header')
        <div class="mb-6">
            @yield('header')
        </div>
     @endif

        <!-- ===== contenido dela parte derecha ===== -->
        {{-- Mostrar mensaje SOLO si no hay contenido --}}
            @hasSection('contenido')
            @yield('contenido')
        @else
        <div class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            👮 Bienvenido al Panel de Control del Vigilante
        </div>
        @endif

        </main>

    </div>
</x-app-layout>