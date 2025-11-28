@extends('vigilante.index')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">
        Registrar Salida de Usuario
    </h2>
@endsection

@section('contenido')

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 4000)"
        class="bg-green-100 text-green-800 p-3 rounded mb-4"
    >
        {{ session('success') }}
    </div>
@endif

{{-- Mensaje de error --}}
@if(session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 4000)"
        class="bg-red-100 text-red-800 p-3 rounded mb-4"
    >
        {{ session('error') }}
    </div>
@endif

{{-- Validaciones --}}
@if($errors->any())
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 6000)"
        class="bg-red-100 text-red-800 p-3 rounded mb-4"
    >
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
        class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        placeholder="Ingrese documento"
        required
    >

    <button 
        type="submit" 
        class="block w-full mt-2 bg-gradient-to-br from-indigo-300 to-indigo-400 hover:from-blue-500 hover:to-blue-600 text-white px-4 py-2 rounded-xl shadow-md text-center transition-all duration-300 font-semibold"
    >
        Registrar Salida
    </button>
</form>

@endsection