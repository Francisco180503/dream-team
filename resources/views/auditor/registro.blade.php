
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Registrar Nuevo Auditor</h2>
    <form action="/Auditores/Guardar" method="POST">
        @csrf
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
        <div class="mb-4">
            <label class="block text-gray-700">Carga Laboral:</label>
            <input type="number" name="carga_laboral" class="w-full border rounded px-4 py-2" min="0">
        </div>
        <div class="flex justify-end">
            <button type="reset" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
        </div>
    </form>
</div>
