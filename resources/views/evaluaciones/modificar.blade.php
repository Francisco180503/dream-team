<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modificar Evaluación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Modificar Evaluación</h2>
            <form action="/Evaluaciones/Actualizar" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $evaluacion->id }}">

                <!-- Denuncia -->
                <div class="mb-4">
                    <label class="block text-gray-700">Denuncia:</label>
                    <select name="denuncia_id" class="w-full border rounded px-4 py-2" required>
                        <option value="">Seleccionar denuncia</option>
                        @foreach ($denuncias as $denuncia)
                            <option value="{{ $denuncia->id }}" @if($denuncia->id == $evaluacion->denuncia_id) selected @endif>
                                {{ $denuncia->entidad_sujeta_control }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Auditor -->
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

                <!-- Fecha de Inicio -->
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha de Inicio:</label>
                    <input type="date" name="fecha_evaluacion_inicio" value="{{ $evaluacion->fecha_evaluacion_inicio }}" class="w-full border rounded px-4 py-2" required>
                </div>

                <!-- Fecha de Fin -->
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha de Fin:</label>
                    <input type="date" name="fecha_evaluacion_fin" value="{{ $evaluacion->fecha_evaluacion_fin }}" class="w-full border rounded px-4 py-2">
                </div>

                <!-- Resultado -->
                <div class="mb-4">
                    <label class="block text-gray-700">Resultado:</label>
                    <select name="resultado_evaluacion" class="w-full border rounded px-4 py-2">
                        <option value="Desestimado" @if($evaluacion->resultado_evaluacion == 'Desestimado') selected @endif>Desestimado</option>
                        <option value="Pasa a Auditoría" @if($evaluacion->resultado_evaluacion == 'Pasa a Auditoría') selected @endif>Pasa a Auditoría</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex justify-end">
                    <a href="/Evaluaciones/lista" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
