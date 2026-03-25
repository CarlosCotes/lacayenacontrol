@extends('vigilante.index')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Registrar Entrada Vehículo</h2>
@endsection

@section('contenido')

    {{-- Éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Error --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Errores --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehiculos.storeEntrada') }}" method="POST" class="space-y-4">
        @csrf

        <div x-data="{ placa: '' }">
            <label class="block font-semibold mb-1">Placa del vehículo</label>
            <input 
                type="text" 
                name="placa" 
                class="w-full border rounded p-2 focus:ring-2 focus:ring-sky-400"
                maxlength="10" x-model="placa" required
            >
            <p class="text-right text-xs text-gray-400 mt-1" x-text="placa.length + '/10'"></p>
        </div>

        <button 
            type="submit" 
            class="block w-full mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl shadow-md text-center transition-all duration-300 font-semibold">
            Registrar Entrada
        </button>
    </form>

    {{-- Información del vehículo luego de registrar el acceso --}}
@if(session('vehiculo_info'))
    @php $v = session('vehiculo_info'); @endphp

    <div class="bg-blue-100 text-blue-900 p-4 rounded-lg shadow mb-4">
        <h3 class="font-bold text-lg mb-2">
            Información del Vehículo ({{ session('tipo') }})
        </h3>

        <ul class="space-y-1">
            <li><strong>Placa:</strong> {{ $v->placa }}</li>
            <li><strong>Marca:</strong> {{ $v->marca ?? 'N/D' }}</li>
            <li><strong>Modelo:</strong> {{ $v->modelo ?? 'N/D' }}</li>
            <li><strong>Color:</strong> {{ $v->color ?? 'N/D' }}</li>
            <li><strong>Propietario:</strong> {{ $v->propietario ?? 'N/D' }}</li>
            <li><strong>Empresa:</strong> {{ $v->empresa->nombre ?? 'N/D' }}</li>
        </ul>
    </div>
@endif

@endsection
