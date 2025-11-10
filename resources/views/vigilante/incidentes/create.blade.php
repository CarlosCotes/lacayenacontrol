<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Incidente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 border">

                {{-- Mensaje de éxito --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Mensajes de error --}}
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario --}}
                <form action="{{ route('vigilante.incidentes.store') }}" method="POST">
                    @csrf
                    <label class="block mb-2 font-semibold">Usuario relacionado:</label>
                    <select name="user_id" 
                            class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="">-- Ninguno --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} - {{ $usuario->documento ?? 'Sin documento' }}
                            </option>
                        @endforeach
                    </select>
                    <label class="block mb-2 font-semibold">Tipo de Incidente:</label>
                    <input type="text" name="tipo" value="{{ old('tipo') }}" 
                           class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                           placeholder="Ej: Accidente, Alerta, etc." required>

                    <label class="block mb-2 font-semibold">Descripción:</label>
                    <textarea name="descripcion" rows="4"
                              class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                              placeholder="Detalle del incidente" required>{{ old('descripcion') }}</textarea>

                    <button type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded w-full">
                        Registrar Incidente
                    </button>
                </form>

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al Panel
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
