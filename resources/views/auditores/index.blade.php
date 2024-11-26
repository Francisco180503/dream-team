@extends('layouts.guest')

@section('title', 'Auditores')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Auditores</h2>
        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            onclick="openModal('createModal')"
        >
            Nuevo Auditor
        </button>
    </div>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Teléfono</th>
                <th class="border border-gray-300 px-4 py-2">Carga Laboral</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditores as $auditor)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $auditor->nombre }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $auditor->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $auditor->telefono }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $auditor->carga_laboral }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                        onclick="openModal('editModal-{{ $auditor->id }}')"
                    >
                        Editar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal: Crear Auditor -->
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Nuevo Auditor</h2>
        <form action="{{ route('auditores.store') }}" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Teléfono:</label>
                <input type="text" name="telefono" class="w-full border rounded px-4 py-2">
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

<!-- Modal: Editar Auditor -->
@foreach ($auditores as $auditor)
<div id="editModal-{{ $auditor->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Editar Auditor</h2>
        <form action="{{ route('auditores.update', $auditor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" value="{{ $auditor->nombre }}" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" value="{{ $auditor->email }}" class="w-full border rounded px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Teléfono:</label>
                <input type="text" name="telefono" value="{{ $auditor->telefono }}" class="w-full border rounded px-4 py-2">
            </div>
            <!-- Botones -->
            <div class="flex justify-end">
                <button type="button" class="mr-2 bg-gray-300 px-4 py-2 rounded" onclick="closeModal('editModal-{{ $auditor->id }}')">
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
