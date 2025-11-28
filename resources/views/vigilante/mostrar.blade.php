@extends('vigilante.index')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">
        Detalle de Acceso de Usuario
    </h2>
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

    {{-- Validación --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Información del Acceso --}}
    <div class="bg-blue-100 text-blue-900 p-4 rounded-lg shadow mb-4">
        <h3 class="font-bold text-lg mb-3">Información del Registro</h3>

        <ul class="space-y-1">
            <li><strong>Nombre:</strong> {{ $acceso->user->name }}</li>
            <li><strong>Documento:</strong> {{ $acceso->user->documento ?? 'N/D' }}</li>
            <li><strong>Empresa:</strong> {{ $acceso->user->empresa->nombre ?? 'N/D' }}</li>

            <hr class="my-2">

            <li><strong>Tipo de Acceso:</strong> {{ ucfirst($acceso->tipo) }}</li>
            <li><strong>Hora de Entrada:</strong> {{ $acceso->hora_entrada ?? 'N/D' }}</li>
            <li><strong>Hora de Salida:</strong> {{ $acceso->hora_salida ?? 'N/D' }}</li>

            <hr class="my-2">

            <li><strong>Registrado por:</strong> {{ $acceso->vigilante->name ?? 'N/D' }}</li>
        </ul>
    </div>

@endsection
