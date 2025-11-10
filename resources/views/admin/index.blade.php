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

                <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    ➕ Crear Usuario
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
                            <tr class="hover:bg-gray-50">
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

                                    <a href="{{ route('admin.edit', $u->id) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-3 py-1 rounded shadow-md transition duration-150">
                                        Editar
                                    </a>

                                    <!-- Botón activar/desactivar -->
                                    <form action="{{ route('admin.toggle', $u->id) }}" method="POST" onsubmit="return confirm('¿Cambiar el estado de este usuario?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                            class="{{ $u->estado === 'activo' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-3 py-1 rounded shadow-md transition duration-150">
                                            {{ $u->estado === 'activo' ? 'Desactivar' : 'Activar' }}
                                        </button>
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
