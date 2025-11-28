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
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Correo electrónico</label>
                        <input type="email" name="email" 
                               value="{{ old('email', $usuario->email) }}"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Rol</label>
                        <select name="role_id" 
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
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

                    <!-- BOTONES -->
                    <div class="flex justify-end space-x-3 pt-4">

                        <!-- Botón Cancelar (color rosado pastel como "Desactivar") -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-br from-rose-300 to-rose-400 
                                  hover:from-rose-400 hover:to-rose-500 text-white px-4 py-2 rounded-xl 
                                  shadow-md transition-all duration-300 transform hover:scale-105 active:scale-95"
                           style="box-shadow: 0 4px 0 rgba(252,164,175,0.4);">
                            Cancelar
                        </a>

                        <!-- Botón Guardar (color violeta pastel como "Editar") -->
                        <button type="submit" 
                            class="inline-flex items-center gap-2 bg-gradient-to-br from-violet-300 to-violet-400 
                                   hover:from-blue-500 hover:to-blue-600 text-white px-5 py-2 rounded-xl 
                                   shadow-md transition-all duration-300 transform hover:scale-105 active:scale-95 font-semibold"
                            style="box-shadow: 0 4px 0 rgba(196,181,253,0.4);">
                            Guardar Cambios
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>