@extends('funcionario.index')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Solicitudes de Vehículos') }}
    </h2>
@endsection

@section('contenido')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl sm:rounded-lg p-6">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- =================== -->
            <!-- FORMULARIO (IZQUIERDA) -->
            <!-- =================== -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Registrar Nuevo Vehículo</h3>

                <form action="{{ route('vehiculos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- PLACA -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Placa</label>
                        <input type="text" name="placa" 
                            class="w-full border rounded-lg p-2 focus:ring-indigo-500" required>
                    </div>

                    <!-- MARCA -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Marca</label>
                        <input type="text" name="marca" 
                            class="w-full border rounded-lg p-2 focus:ring-indigo-500" required>
                    </div>

                    <!-- MODELO -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Modelo (Corolla, TXL, i10…)</label>
                        <input type="text" name="modelo" 
                            class="w-full border rounded-lg p-2 focus:ring-indigo-500"
                            placeholder="Ej: Corolla, TXL, i10" required>
                    </div>

                    <!-- TIPO -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Tipo</label>
                        <select name="tipo" class="w-full border rounded-lg p-2 focus:ring-indigo-500" required>
                            <option value="">Seleccione el tipo</option>
                            <option value="CARRO">Carro</option>
                            <option value="MOTO">Moto</option>
                            <option value="CAMION">Camión</option>
                        </select>
                    </div>

                    <!-- ESTADO OCULTO -->
                    <input type="hidden" name="estado" value="PENDIENTE">

                    <!-- FUNCIONARIO ACTUAL -->
                    <input type="hidden" name="funcionario_id" value="{{ Auth::id() }}">

                    <!-- EMPLEADO -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Empleado</label>
                        <select name="user_id"  class="w-full border rounded-lg p-2">
                            <option value="">Seleccione un empleado</option>
                            @foreach($trabajadores as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- BOTÓN -->
                    <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                        Registrar Vehículo
                    </button>

                </form>
            </div>

            <!-- =================== -->
            <!-- TABLA (DERECHA) -->
            <!-- =================== -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Mis Solicitudes</h3>

                @if($vehiculos->isEmpty())
                    <p class="text-gray-500 text-center">No has registrado vehículos aún.</p>
                @else
                    <table class="min-w-full border border-gray-200 text-center">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-3 py-2">Placa</th>
                                <th class="border px-3 py-2">Marca</th>
                                <th class="border px-3 py-2">Modelo</th>
                                <th class="border px-3 py-2">Tipo</th>
                                <th class="border px-3 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculos as $v)
                                <tr class="border hover:bg-indigo-50 transition">
                                    <td class="px-3 py-2">{{ $v->placa }}</td>
                                    <td class="px-3 py-2">{{ $v->marca }}</td>
                                    <td class="px-3 py-2">{{ $v->modelo }}</td>
                                    <td class="px-3 py-2">{{ $v->tipo }}</td>
                                    <td class="px-3 py-2 font-semibold 
                                        @if($v->estado=='PENDIENTE') text-yellow-600
                                        @elseif($v->estado=='APROBADO') text-green-600
                                        @else text-red-600 @endif">
                                        {{ $v->estado }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
