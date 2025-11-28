<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Crear Usuario -->
                <a href="{{ route('admin.create') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-br from-indigo-300 to-indigo-400 
                          text-white px-4 py-2 rounded-xl shadow-md hover:from-blue-500 hover:to-blue-600 
                          transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95 font-semibold"
                   style="box-shadow: 0 4px 0 rgba(165, 180, 252, 0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Crear Usuario
                </a>

                <table class="table-auto w-full mt-6 border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Correo</th>
                            <th class="px-4 py-2 border">Rol</th>
                            <th class="px-4 py-2 border">Empresa</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $u)
                            <tr class="hover:bg-gray-50 transition-all duration-300 hover:translate-x-1">
                                <td class="border px-4 py-2">{{ $u->id }}</td>
                                <td class="border px-4 py-2">{{ $u->name }}</td>
                                <td class="border px-4 py-2">{{ $u->email }}</td>
                                <td class="border px-4 py-2">{{ $u->role->nombre ?? '—' }}</td>
                                <td class="border px-4 py-2">{{ $u->empresa->nombre ?? '—' }}</td>
                                <td class="border px-4 py-2">
                                    @if ($u->estado === 'activo')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Activo</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">Inactivo</span>
                                    @endif
                                </td>

                                <td class="border px-4 py-2 text-center flex gap-2 justify-center">

                                    <!-- Botón Editar -->
                                    <a href="{{ route('admin.edit', $u->id) }}"
                                       class="inline-flex items-center gap-2 bg-gradient-to-br from-violet-300 to-violet-400 
                                              hover:from-blue-500 hover:to-blue-600 text-white font-semibold px-3 py-1 
                                              rounded-xl shadow-md transition-all duration-300 transform hover:scale-105 
                                              hover:shadow-lg active:scale-95"
                                       style="box-shadow: 0 4px 0 rgba(196, 181, 253, 0.4);">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13L3 21l.05-1.935a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                                        </svg>
                                        Editar
                                    </a>

                                    <!-- Botón Activar/Desactivar -->
                                    <form action="{{ route('admin.toggle', $u->id) }}" method="POST" 
                                          onsubmit="return confirm('¿Cambiar el estado de este usuario?');">
                                        @csrf
                                        @method('PATCH')

                                        @if ($u->estado === 'activo')
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 bg-gradient-to-br from-rose-300 to-rose-400 
                                                       hover:from-rose-400 hover:to-rose-500 text-white px-3 py-1 rounded-xl 
                                                       shadow-md transition-all duration-300 transform hover:scale-105 
                                                       hover:shadow-lg active:scale-95 font-semibold"
                                                style="box-shadow: 0 4px 0 rgba(252, 164, 175, 0.4);">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Desactivar
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 bg-gradient-to-br from-cyan-300 to-cyan-400 
                                                       hover:from-blue-500 hover:to-blue-600 text-white px-3 py-1 rounded-xl 
                                                       shadow-md transition-all duration-300 transform hover:scale-105 
                                                       hover:shadow-lg active:scale-95 font-semibold"
                                                style="box-shadow: 0 4px 0 rgba(103, 232, 249, 0.4);">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                                Activar
                                            </button>
                                        @endif
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
