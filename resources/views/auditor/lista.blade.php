<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lista de Auditores</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Lista de Auditores</h2>
                <a href="/Auditores/Registro" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nuevo Auditor</a>
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
                    @forelse ($auditores as $auditor)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $auditor->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $auditor->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $auditor->telefono ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $auditor->carga_laboral }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="/Auditores/modificar/{{ $auditor->id }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
                            <form action="/Auditores/eliminar/{{ $auditor->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center border border-gray-300 px-4 py-2">No hay auditores registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
