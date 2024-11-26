<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evaluar Denuncia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Evaluar Denuncia</h2>
            <p><strong>Denuncia ID:</strong> {{ $denuncia->id }}</p>
            <p><strong>Entidad Sujeta a Control:</strong> {{ $denuncia->entidad_sujeta_control }}</p>
            <p><strong>Descripción:</strong> {{ $denuncia->descripcion }}</p>

            <form action="{{ url('/Denuncias/' . $denuncia->id . '/Evaluar') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Auditor:</label>
                    <select name="auditor_evaluacion_id" class="w-full border rounded px-4 py-2" required>
                        @foreach ($auditores as $auditor)
                        <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                        @endforeach
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
                    <select name="resultado_evaluacion" class="w-full border rounded px-4 py-2" required>
                        <option value="Desestimado">Desestimado</option>
                        <option value="Pasa a Auditoría">Pasa a Auditoría</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="/Denuncias/lista" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar Evaluación</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
