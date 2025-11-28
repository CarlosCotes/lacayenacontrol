@extends('vigilante.index')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Registrar Salida de Vehículo</h2>
@endsection

@section('contenido')

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje de error --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('vehiculos.storeSalida') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Establecer tipo SALIDA --}}
        <input type="hidden" name="tipo" value="salida">

        <div>
            <label class="block font-semibold mb-1">Placa del vehículo</label>
            <input 
                type="text" 
                name="placa" 
                class="w-full border rounded p-2 focus:ring-2 focus:ring-sky-400" 
                required
            >
        </div>

        <div>
            <label class="block font-semibold mb-1">Observación (opcional)</label>
            <input 
                type="text" 
                name="observacion" 
                class="w-full border rounded p-2 focus:ring-2 focus:ring-sky-400"
            >
        </div>

        <button 
            type="submit" 
            class="block w-full mt-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-md text-center transition-all duration-300 font-semibold">
            Registrar Salida
        </button>
    </form>

@endsection
