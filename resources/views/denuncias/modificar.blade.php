<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modificar Denuncia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Modificar Denuncia</h2>
            <form action="/Denuncias/Actualizar" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $denuncia->id }}">
                <div class="mb-4">
                    <label class="block text-gray-700">Canal:</label>
                    <select name="canal" class="w-full border rounded px-4 py-2" required>
                        <option value="Formulario Web" @if($denuncia->canal == 'Formulario Web') selected @endif>Formulario Web</option>
                        <option value="Expediente" @if($denuncia->canal == 'Expediente') selected @endif>Expediente</option>
                    </select>
                </div>
                <!-- Campos similares al formulario de registro -->
                <div class="mb-4">
                    <label class="block text-gray-700">Ámbito Geográfico:</label>
                    <input type="text" name="ambito_geografico" value="{{ $denuncia->ambito_geografico }}" class="w-full border rounded px-4 py-2" required>
                </div>
                <div class="flex justify-end">
                    <a href="/Denuncias/lista" class="mr-2 bg-gray-300 px-4 py-2 rounded">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
