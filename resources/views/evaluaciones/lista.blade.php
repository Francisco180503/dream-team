<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lista de Evaluaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Lista de Evaluaciones</h2>
                <a href="/Evaluaciones/Registro" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nueva Evaluación</a>
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
                        <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->denuncia->entidad_sujeta_control ?? 'Sin denuncia' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->auditorEvaluacion->nombre ?? 'Sin auditor' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->fecha_evaluacion_inicio }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->fecha_evaluacion_fin }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $evaluacion->resultado_evaluacion }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="/Evaluaciones/modificar/{{ $evaluacion->id }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
                            <form action="/Evaluaciones/eliminar/{{ $evaluacion->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                            </form>
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
    </div>
</body>
</html>
