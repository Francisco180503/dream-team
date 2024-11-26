<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lista de Denuncias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Lista de Denuncias</h2>
                <a href="/Denuncias/Registro" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nueva Denuncia</a>
            </div>

            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Canal</th>
                        <th class="border border-gray-300 px-4 py-2">Entidad</th>
                        <th class="border border-gray-300 px-4 py-2">Estado</th>
                        <th class="border border-gray-300 px-4 py-2">Auditor</th>
                        <th class="border border-gray-300 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($denuncias as $denuncia)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $denuncia->canal }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $denuncia->entidad_sujeta_control }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $denuncia->estado_recepcion }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $denuncia->auditorRecepcion->nombre ?? 'Sin asignar' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="/Denuncias/modificar/{{ $denuncia->id }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
                            <form action="/Denuncias/eliminar/{{ $denuncia->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                                <a href="{{ route('denuncias.evaluar', $denuncia->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Evaluar
                                 </a>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center border border-gray-300 px-4 py-2">No hay denuncias registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
