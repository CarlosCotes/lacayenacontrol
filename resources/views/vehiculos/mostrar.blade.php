@extends('vigilante.index')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">
        Información del Vehículo – {{ ucfirst($acceso->tipo) }}
    </h2>
@endsection

@section('contenido')

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Información del vehículo --}}
    <div class="bg-blue-100 text-blue-900 p-4 rounded-lg shadow mb-4">
        <h3 class="font-bold text-lg mb-2">Datos del Vehículo</h3>

        <ul class="space-y-1">
            <li><strong>Placa:</strong> {{ $vehiculo->placa }}</li>
            <li><strong>Marca:</strong> {{ $vehiculo->marca ?? 'N/D' }}</li>
            <li><strong>Modelo:</strong> {{ $vehiculo->modelo ?? 'N/D' }}</li>
            <li><strong>Color:</strong> {{ $vehiculo->color ?? 'N/D' }}</li>
            <li><strong>Propietario:</strong> {{ $vehiculo->propietario ?? 'N/D' }}</li>
            <li><strong>Empresa:</strong> {{ $vehiculo->empresa->nombre ?? 'N/D' }}</li>
        </ul>
    </div>

    {{-- Información del acceso --}}
    <div class="bg-gray-100 text-gray-900 p-4 rounded-lg shadow mb-4">
        <h3 class="font-bold text-lg mb-2">Datos del Registro</h3>

        <ul class="space-y-1">
            <li><strong>Tipo:</strong> {{ ucfirst($acceso->tipo) }}</li>

            @if($acceso->hora_entrada)
                <li><strong>Hora de Entrada:</strong> {{ $acceso->hora_entrada }}</li>
            @endif

            @if($acceso->hora_salida)
                <li><strong>Hora de Salida:</strong> {{ $acceso->hora_salida }}</li>
            @endif

            <li><strong>Vigilante:</strong> {{ $acceso->vigilante->name ?? 'N/D' }}</li>
        </ul>
    </div>

    {{-- Botón para volver --}}
    <a href="{{ route('vehiculos.entrada') }}"
        class="block w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 mt-4 rounded-xl shadow-md text-center transition-all duration-300 font-semibold">
        Registrar otro vehículo
    </a>

@endsection
