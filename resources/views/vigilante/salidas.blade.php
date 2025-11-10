<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Salida de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

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
                <form action="{{ route('vigilante.storeSalida') }}" method="POST">
                    @csrf

                    <label class="block mb-2 font-semibold">Documento del Usuario:</label>
                    <input 
                        type="text" 
                        name="documento" 
                        value="{{ old('documento') }}" 
                        class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-400"
                        placeholder="Ingrese documento"
                        required
                    >

                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded w-full">
                        Registrar Salida
                    </button>
                </form>

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
