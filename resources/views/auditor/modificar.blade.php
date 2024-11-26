
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Modificar Auditor</h2>
    <form action="/Auditores/Actualizar" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $auditor->id }}">
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
        <div class="mb-4">
            <label class="block text-gray-700">Carga Laboral:</label>
            <input type="number" name="carga_laboral" value="{{ $auditor->carga_laboral }}" class="w-full border rounded px-4 py-2" min="0">
        </div>
        <div class="flex justify-end">
            <a href="/Auditores/lista" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>
</div>
