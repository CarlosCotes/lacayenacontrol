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

                <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                     ➕ Crear Usuario
                </a>


                <table class="table-auto w-full mt-6 border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Rol</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $u)
                            <tr>
                                <td class="border px-4 py-2">{{ $u->id }}</td>
                                <td class="border px-4 py-2">{{ $u->name }}</td>
                                <td class="border px-4 py-2">{{ $u->email }}</td>
                                <td class="border px-4 py-2">{{ $u->role_id }}</td>
                                <td class="border px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.edit', $u->id) }}" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-3 py-1 rounded shadow-md transition duration-150 inline-block">
                                    Editar
                                </a>
                                    <form action="{{ route('admin.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">
                                            Eliminar
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
