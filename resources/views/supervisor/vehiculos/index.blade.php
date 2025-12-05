@extends('supervisor.index')

@section('header')
    <h2 class="font-bold text-2xl text-gray-800">
        🚗 Solicitudes de Vehículos Pendientes
    </h2>
@endsection

@section('contenido')
<div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">

    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-200 text-red-800 p-4 rounded mb-6 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @forelse($solicitudes as $sol)
        <div class="bg-white shadow-md p-6 mb-4 rounded-lg border">

        <p class="font-bold text-lg text-gray-700">
            👤 {{ $sol->empleado?->name ?? 'Usuario no encontrado' }}
        </p>

            <p><strong>Placa:</strong> {{ $sol->placa }}</p>
            <p><strong>Marca:</strong> {{ $sol->marca }}</p>
            <p><strong>Modelo:</strong> {{ $sol->modelo }}</p>

            <p class="mt-2"><strong>Motivo:</strong></p>
            <p class="bg-gray-100 p-3 rounded">{{ $sol->motivo ?? 'Sin motivo especificado' }}</p>

            <div class="flex gap-3 justify-end mt-4">

                <form action="{{ route('supervisor.vehiculos.aprobar', $sol->id) }}" method="POST">
                    @csrf
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow">
                        ✔ Aprobar
                    </button>
                </form>

                <form action="{{ route('supervisor.vehiculos.rechazar', $sol->id) }}" method="POST">
                    @csrf
                    <input type="text" name="razon_rechazo" 
                           placeholder="Razón del rechazo" 
                           required
                           class="border rounded p-2 mr-2">

                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">
                        ✖ Rechazar
                    </button>
                </form>

            </div>

        </div>
    @empty
        <div class="bg-yellow-200 text-yellow-800 p-4 rounded shadow">
            No hay solicitudes vehiculares pendientes.
        </div>
    @endforelse

</div>
@endsection
