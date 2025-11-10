<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.update', $usuario->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                        <input type="text" name="name" 
                               value="{{ old('name', $usuario->name) }}"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Correo electrónico</label>
                        <input type="email" name="email" 
                               value="{{ old('email', $usuario->email) }}"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Rol</label>
                        <select name="role_id" 
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="1" {{ $usuario->role_id == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $usuario->role_id == 2 ? 'selected' : '' }}>Supervisor</option>
                            <option value="3" {{ $usuario->role_id == 3 ? 'selected' : '' }}>Funcionario</option>
                            <option value="5" {{ $usuario->role_id == 5 ? 'selected' : '' }}>Vigilante</option>
                            <option value="4" {{ $usuario->role_id == 4 ? 'selected' : '' }}>Empleado</option>
                        </select>
                        @error('role_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow-md transition duration-150">
                            Cancelar
                        </a>

                        <button type="submit" 
                            class="text-white px-5 py-2 rounded shadow-md transition duration-150"
                            style="background-color:#16a34a;">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
