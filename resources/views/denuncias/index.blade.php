@extends('layouts.guest')

@section('title', 'Denuncias')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Denuncias</h2>
        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            onclick="openModal('createModal')"
        >
            Nueva Denuncia
        </button>
    </div>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Canal</th>
                <th class="border border-gray-300 px-4 py-2">Entidad</th>
                <th class="border border-gray-300 px-4 py-2">Provincia</th>
                <th class="border border-gray-300 px-4 py-2">Estado</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($denuncias as $denuncia)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $denuncia->canal }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $denuncia->entidad_sujeta_control }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $denuncia->provincia }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $denuncia->estado_recepcion }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                        onclick="openModal('editModal-{{ $denuncia->id }}')"
                    >
                        Editar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal: Crear Denuncia -->
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Nueva Denuncia</h2>
        <form action="/Denuncias/Guardar" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Canal:</label>
                <select name="canal" class="w-full border rounded px-4 py-2" required>
                    <option value="Formulario Web">Formulario Web</option>
                    <option value="Expediente">Expediente</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Entidad:</label>
                <input type="text" name="entidad_sujeta_control" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Provincia:</label>
                <input type="text" name="provincia" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Estado:</label>
                <select name="estado_recepcion" class="w-full border rounded px-4 py-2">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Admitido">Admitido</option>
                    <option value="No Admitido">No Admitido</option>
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

<!-- Modal: Editar Denuncia -->
@foreach ($denuncias as $denuncia)
<div id="editModal-{{ $denuncia->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Editar Denuncia</h2>
        <form action="/Denuncias/Actualizar" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $denuncia->id }}">
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Canal:</label>
                <select name="canal" class="w-full border rounded px-4 py-2">
                    <option value="Formulario Web" @if($denuncia->canal == 'Formulario Web') selected @endif>Formulario Web</option>
                    <option value="Expediente" @if($denuncia->canal == 'Expediente') selected @endif>Expediente</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Entidad:</label>
                <input type="text" name="entidad_sujeta_control" value="{{ $denuncia->entidad_sujeta_control }}" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Provincia:</label>
                <input type="text" name="provincia" value="{{ $denuncia->provincia }}" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Estado:</label>
                <select name="estado_recepcion" class="w-full border rounded px-4 py-2">
                    <option value="Pendiente" @if($denuncia->estado_recepcion == 'Pendiente') selected @endif>Pendiente</option>
                    <option value="Admitido" @if($denuncia->estado_recepcion == 'Admitido') selected @endif>Admitido</option>
                    <option value="No Admitido" @if($denuncia->estado_recepcion == 'No Admitido') selected @endif>No Admitido</option>
                </select>
            </div>
            <!-- Botones -->
            <div class="flex justify-end">
                <button type="button" class="mr-2 bg-gray-300 px-4 py-2 rounded" onclick="closeModal('editModal-{{ $denuncia->id }}')">
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
