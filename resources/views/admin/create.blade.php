<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-semibold mb-1">Nombre</label>
                        <input type="text" name="name" id="name" 
                               class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="documento" class="block font-semibold mb-1">Documento</label>
                        <input type="text" name="documento" id="documento" 
                               class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold mb-1">Correo electrónico</label>
                        <input type="email" name="email" id="email" 
                               class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-semibold mb-1">Contraseña</label>
                        <input type="password" name="password" id="password" 
                               class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block font-semibold mb-1">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Rol</label>
                        <select name="role_id" class="w-full border p-2 rounded" required>
                            <option value="">-- Seleccione un rol --</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="empresa_id" class="block font-semibold mb-1">Empresa</label>
                        <select name="empresa_id" id="empresa_id" class="w-full border-gray-300 rounded p-2">
                            <option value="">-- Seleccione una empresa --</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">

                        <!-- Botón Cancelar (ROJO del panel) -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-br from-rose-300 to-rose-400 
                                  hover:from-rose-400 hover:to-rose-500 text-white font-semibold px-4 py-2 
                                  rounded-xl shadow-md transition-all duration-300 transform hover:scale-105 
                                  hover:shadow-lg active:scale-95"
                           style="box-shadow: 0 4px 0 rgba(252, 164, 175, 0.4);">
                            Cancelar
                        </a>

                        <!-- Botón Guardar (VERDE estilo de Activar) -->
                        <button type="submit" 
                            class="inline-flex items-center gap-2 bg-gradient-to-br from-cyan-300 to-cyan-400 
                                   hover:from-blue-500 hover:to-blue-600 text-white font-semibold px-5 py-2 
                                   rounded-xl shadow-md transition-all duration-300 transform hover:scale-105 
                                   hover:shadow-lg active:scale-95"
                            style="box-shadow: 0 4px 0 rgba(103, 232, 249, 0.4);">
                            Guardar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>