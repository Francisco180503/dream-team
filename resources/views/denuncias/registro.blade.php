<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrar Denuncia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Registrar Nueva Denuncia</h2>
            <form action="/Denuncias/Guardar" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Canal:</label>
                    <select name="canal" class="w-full border rounded px-4 py-2" required>
                        <option value="Formulario Web">Formulario Web</option>
                        <option value="Expediente">Expediente</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha de Recepción:</label>
                    <input type="date" name="fecha_recepcion" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Año de Ingreso:</label>
                    <input type="number" name="año_ingreso" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Entidad Sujeta a Control:</label>
                    <input type="text" name="entidad_sujeta_control" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ámbito Geográfico:</label>
                    <input type="text" name="ambito_geografico" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Provincia:</label>
                    <input type="text" name="provincia" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Distrito:</label>
                    <input type="text" name="distrito" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Descripción:</label>
                    <textarea name="descripcion" class="w-full border rounded px-4 py-2" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Funcionarios Involucrados:</label>
                    <textarea name="funcionarios_involucrados" class="w-full border rounded px-4 py-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Estado de Recepción:</label>
                    <select name="estado_recepcion" class="w-full border rounded px-4 py-2" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Admitido">Admitido</option>
                        <option value="No Admitido">No Admitido</option>
                        <option value="En Proceso">En Proceso</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Auditor:</label>
                    <select name="auditor_recepcion_id" class="w-full border rounded px-4 py-2">
                        <option value="">Sin asignar</option>
                        @foreach ($auditores as $auditor)
                        <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <a href="/Denuncias/lista" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
