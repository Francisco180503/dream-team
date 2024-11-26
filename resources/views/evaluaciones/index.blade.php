@extends('layouts.guest')

@section('title', 'Evaluaciones')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Evaluaciones</h2>
        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            onclick="openModal('createModal')"
        >
            Nueva Evaluación
        </button>
    </div>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Denuncia</th>
                <th class="border border-gray-300 px-4 py-2">Auditor</th>
                <th class="border border-gray-300 px-4 py-2">Inicio</th>
                <th class="border border-gray-300 px-4 py-2">Fin</th>
                <th class="border border-gray-300 px-4 py-2">Resultado</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($evaluaciones as $evaluacion)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->denuncia->entidad_sujeta_control }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->auditorEvaluacion->nombre }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->fecha_evaluacion_inicio }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->fecha_evaluacion_fin ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->resultado_evaluacion ?? 'Pendiente' }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                        onclick="openModal('editModal-{{ $evaluacion->id }}')"
                    >
                        Editar
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center border border-gray-300 px-4 py-2">No hay evaluaciones registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal: Crear Evaluación -->
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Nueva Evaluación</h2>
        <form action="{{ route('evaluaciones.store') }}" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Denuncia:</label>
                <select name="denuncia_id" class="w-full border rounded px-4 py-2" required>
                    @forelse ($denuncias as $denuncia)
                    <option value="{{ $denuncia->id }}">{{ $denuncia->entidad_sujeta_control }}</option>
                    @empty
                    <option value="" disabled>No hay denuncias admitidas disponibles</option>
                    @endforelse
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Auditor:</label>
                <select name="auditor_evaluacion_id" class="w-full border rounded px-4 py-2" required>
                    @forelse ($auditores as $auditor)
                    <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                    @empty
                    <option value="" disabled>No hay auditores disponibles</option>
                    @endforelse
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Inicio:</label>
                <input type="date" name="fecha_evaluacion_inicio" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Fin:</label>
                <input type="date" name="fecha_evaluacion_fin" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Resultado:</label>
                <select name="resultado_evaluacion" class="w-full border rounded px-4 py-2">
                    <option value="Desestimado">Desestimado</option>
                    <option value="Pasa a Auditoría">Pasa a Auditoría</option>
                </select>
            </div>
            <!-- Botones -->
            <div class="flex justify-end">
                <button type="button" class="mr-2 bg-gray-300 px-4 py-2 rounded" onclick="closeModal('createModal')">
                    Cancelar
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Editar Evaluación -->
@foreach ($evaluaciones as $evaluacion)
<div id="editModal-{{ $evaluacion->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Editar Evaluación</h2>
        <form action="{{ route('evaluaciones.update', $evaluacion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Denuncia:</label>
                <select name="denuncia_id" class="w-full border rounded px-4 py-2" required>
                    @foreach ($denuncias as $denuncia)
                    <option value="{{ $denuncia->id }}" @if($denuncia->id == $evaluacion->denuncia_id) selected @endif>
                        {{ $denuncia->entidad_sujeta_control }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Auditor:</label>
                <select name="auditor_evaluacion_id" class="w-full border rounded px-4 py-2" required>
                    @foreach ($auditores as $auditor)
                    <option value="{{ $auditor->id }}" @if($auditor->id == $evaluacion->auditor_evaluacion_id) selected @endif>
                        {{ $auditor->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Inicio:</label>
                <input type="date" name="fecha_evaluacion_inicio" value="{{ $evaluacion->fecha_evaluacion_inicio }}" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Fin:</label>
                <input type="date" name="fecha_evaluacion_fin" value="{{ $evaluacion->fecha_evaluacion_fin }}" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Resultado:</label>
                <select name="resultado_evaluacion" class="w-full border rounded px-4 py-2">
                    <option value="Desestimado" @if($evaluacion->resultado_evaluacion == 'Desestimado') selected @endif>Desestimado</option>
                    <option value="Pasa a Auditoría" @if($evaluacion->resultado_evaluacion == 'Pasa a Auditoría') selected @endif>Pasa a Auditoría</option>
                </select>
            </div>
            <!-- Botones -->
            <div class="flex justify-end">
                <button type="button" class="mr-2 bg-gray-300 px-4 py-2 rounded" onclick="closeModal('editModal-{{ $evaluacion->id }}')">
                    Cancelar
                </button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection
