<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Entrada de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vigilante.storeEntrada') }}" method="POST">
                    @csrf
                    <label class="block mb-2 font-semibold">Documento del Usuario:</label>
                    <input type="text" name="documento" value="{{ old('documento') }}" 
                           class="w-full border rounded px-3 py-2 mb-4" placeholder="Ingrese documento">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Registrar Entrada
                    </button>
                </form>

                <a href="{{ route('vigilante.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
