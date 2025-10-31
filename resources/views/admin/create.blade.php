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
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold mb-1">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-semibold mb-1">Contraseña</label>
                        <input type="password" name="password" id="password" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block font-semibold mb-1">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="role_id" class="block font-semibold mb-1">Rol</label>
                        <select name="role_id" id="role_id" class="w-full border-gray-300 rounded p-2" required>
                            <option value="">Selecciona un rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Funcionario</option>
                            <option value="4">Vigilante</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.dashboard') }}" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow-md transition duration-150">
                            Cancelar
                        </a>

                        <button type="submit" 
                            class="text-white px-5 py-2 rounded shadow-md transition duration-150"
                            style="background-color:#16a34a;">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
