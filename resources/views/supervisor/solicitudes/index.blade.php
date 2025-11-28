@extends('supervisor.index')

@section('header')
<h2 class="text-xl font-semibold text-gray-800 leading-tight">
    📝 Solicitudes Pendientes
</h2>
@endsection

@section('contenido')

<div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-xl shadow-md">

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($solicitudes->isEmpty())
            <p class="text-gray-600">No hay solicitudes pendientes.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Funcionario</th>
                            <th class="px-4 py-2 text-left">Empleado Solicitado</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Documento</th>
                            <th class="px-4 py-2 text-left">Motivo</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($solicitudes as $s)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $s->funcionario->name }}</td>
                                <td class="px-4 py-2">{{ $s->nombre_empleado }}</td>
                                <td class="px-4 py-2">{{ $s->email }}</td>
                                <td class="px-4 py-2">{{ $s->documento }}</td>
                                <td class="px-4 py-2">{{ $s->motivo ?? 'N/A' }}</td>

                                <td class="px-4 py-2">
                                    <div class="flex gap-2">

                                        {{-- Botón Aprobar --}}
                                        <form action="{{ route('solicitudes.aprobar', $s->id) }}" method="POST">
                                            @csrf
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                Aprobar
                                            </button>
                                        </form>

                                        {{-- Botón Rechazar --}}
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                            onclick="document.getElementById('modal-{{ $s->id }}').showModal();">
                                            Rechazar
                                        </button>

                                    </div>

                                    {{-- Modal Rechazo --}}
                                    <dialog id="modal-{{ $s->id }}" class="rounded-lg p-4">
                                        <h3 class="text-lg font-semibold mb-2">Motivo del rechazo</h3>

                                        <form method="POST" action="{{ route('solicitudes.rechazar', $s->id) }}">
                                            @csrf
                                            <textarea name="motivo_rechazo" class="w-full border rounded p-2 mb-3" required></textarea>

                                            <div class="flex justify-end gap-2">
                                                <button type="button" class="px-3 py-1 bg-gray-300 rounded"
                                                    onclick="document.getElementById('modal-{{ $s->id }}').close();">
                                                    Cancelar
                                                </button>
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                    Rechazar
                                                </button>
                                            </div>
                                        </form>
                                    </dialog>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</div>

@endsection
