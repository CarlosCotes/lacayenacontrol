@extends('vigilante.index')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Registrar Entrada de Usuario') }}
        </h2>
    @endsection

    @section('contenido')

                {{-- Mensaje de éxito --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Mensaje de error  --}}
                @if(session('error'))
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Mensajes de validación --}}
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
                <form action="{{ route('vigilante.storeEntrada') }}" method="POST">
                    @csrf

                    <label class="block mb-2 font-semibold">Documento del Usuario:</label>
                    <input 
                        type="text" 
                        name="documento" 
                        value="{{ old('documento') }}" 
                        class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-sky-400"
                        placeholder="Ingrese documento"
                        required
                    >

                    <!-- Botón Registrar Entrada -->
                    <button 
                        type="submit" 
                        class="block w-full mt-2 bg-sky-400 hover:bg-sky-500 text-white px-4 py-2 rounded-xl shadow-md text-center transition-all duration-300 font-semibold">
                        Registrar Entrada
                    </button>
                </form>

    

@endsection