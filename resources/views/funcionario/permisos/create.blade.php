@extends('funcionario.index')

@section('header')
    <h2 class="font-bold text-2xl text-gray-800">
        🔑 Solicitar Permiso Temporal
    </h2>
@endsection

@section('contenido')
<div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">

        {{-- Errores --}}
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded mb-6 shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mensaje éxito --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('funcionario.permisos.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Visitante --}}
            <div x-data="{ nombre: '' }">
                <label class="block font-semibold mb-1">Nombre del Visitante</label>
                <input type="text" name="nombre_visitante" placeholder="Ej: Luis Gómez"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                       maxlength="50" x-model="nombre" required>
                <p class="text-right text-xs text-gray-400 mt-1" x-text="nombre.length + '/50'"></p>
            </div>

            {{-- Documento --}}
            <div x-data="{ documento: '' }">
                <label class="block font-semibold mb-1">Documento</label>
                <input type="text" name="documento_visitante" placeholder="Número de documento"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                       maxlength="50" x-model="documento" required>
                <p class="text-right text-xs text-gray-400 mt-1" x-text="documento.length + '/50'"></p>
            </div>

            {{-- Fechas --}}
            <div>
                <label class="block font-semibold mb-1">Fecha y hora de ingreso</label>
                <input type="datetime-local" name="fecha_ingreso"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                       required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Fecha y hora de salida</label>
                <input type="datetime-local" name="fecha_salida"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                       required>
            </div>

            {{-- Motivo --}}
            <div>
                <label class="block font-semibold mb-1">Motivo</label>
                <textarea name="motivo" rows="3" placeholder="Explica la razón del permiso"
                          class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none"></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ url()->previous() }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-rose-400 hover:bg-rose-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition transform hover:scale-105">
                    Cancelar
                </a>
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-cyan-400 hover:bg-cyan-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition transform hover:scale-105">
                    Enviar Solicitud
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
