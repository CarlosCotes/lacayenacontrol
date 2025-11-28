@extends('vigilante.index')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">
        Registrar Incidente
    </h2>
@endsection

@section('contenido')

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
            class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-violet-400">
        <option value="">-- Ninguno --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->name }} - {{ $usuario->documento ?? 'Sin documento' }}
            </option>
        @endforeach
    </select>

    <label class="block mb-2 font-semibold">Tipo de Incidente:</label>
    <input 
        type="text" 
        name="tipo" 
        value="{{ old('tipo') }}" 
        class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-violet-400"
        placeholder="Ej: Accidente, Alerta, etc." 
        required
    >

    <label class="block mb-2 font-semibold">Descripción:</label>
    <textarea 
        name="descripcion" 
        rows="4"
        class="w-full border rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-violet-400"
        placeholder="Detalle del incidente" 
        required
    >{{ old('descripcion') }}</textarea>

    <!-- Botón Registrar Incidente -->
    <button type="submit" 
            class="block bg-violet-400 hover:bg-violet-500 text-white px-4 py-2 rounded-xl shadow-md text-center transition-all duration-300 font-semibold w-full mb-3">
        Registrar Incidente
    </button>
</form>


@endsection