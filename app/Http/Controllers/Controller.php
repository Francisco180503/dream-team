<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Imports\DenunciasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DenunciaController extends Controller
{
    // Muestra la lista de todas las denuncias
    public function index()
    {
        // Obtener todas las denuncias (se puede agregar paginación si es necesario)
        $denuncias = Denuncia::paginate(10); // 10 denuncias por página
        return view('denuncias.index', compact('denuncias'));
    }

    // Muestra el formulario para crear una nueva denuncia
    public function create()
    {
        return view('denuncias.create');
    }

    // Guarda una nueva denuncia en la base de datos
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'canal' => 'required|string|max:50',
            'fecha_recepcion' => 'required|date',
            'año_ingreso' => 'required|integer',
            'entidad_sujeta_control' => 'required|string|max:255',
            'ambito_geografico' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado_recepcion' => 'required|in:Pendiente,Admitido,No Admitido,En Proceso',
        ]);

        // Crear una nueva denuncia
        Denuncia::create([
            'canal' => $request->canal,
            'fecha_recepcion' => $request->fecha_recepcion,
            'año_ingreso' => $request->año_ingreso,
            'entidad_sujeta_control' => $request->entidad_sujeta_control,
            'ambito_geografico' => $request->ambito_geografico,
            'provincia' => $request->provincia,
            'distrito' => $request->distrito,
            'descripcion' => $request->descripcion,
            'estado_recepcion' => $request->estado_recepcion,
        ]);

        return redirect()->route('denuncias.index')->with('success', 'Denuncia creada correctamente');
    }

    // Muestra el formulario para importar denuncias desde un archivo Excel
    public function import()
    {
        return view('denuncias.import');
    }

    // Maneja la importación de un archivo Excel
    public function importExcel(Request $request)
    {
        // Validación del archivo
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Importar las denuncias desde el archivo
        Excel::import(new DenunciasImport, $request->file('archivo'));

        return redirect()->route('denuncias.index')->with('success', 'Denuncias importadas correctamente');
    }

    // Muestra los detalles de una denuncia específica
    public function show($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        return view('denuncias.show', compact('denuncia'));
    }

    // Muestra el formulario para editar una denuncia
    public function edit($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        return view('denuncias.edit', compact('denuncia'));
    }

    // Actualiza una denuncia en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'canal' => 'required|string|max:50',
            'fecha_recepcion' => 'required|date',
            'año_ingreso' => 'required|integer',
            'entidad_sujeta_control' => 'required|string|max:255',
            'ambito_geografico' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado_recepcion' => 'required|in:Pendiente,Admitido,No Admitido,En Proceso',
        ]);

        // Buscar la denuncia y actualizarla
        $denuncia = Denuncia::findOrFail($id);
        $denuncia->update($request->all());

        return redirect()->route('denuncias.index')->with('success', 'Denuncia actualizada correctamente');
    }

    // Elimina una denuncia de la base de datos
    public function destroy($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        $denuncia->delete();

        return redirect()->route('denuncias.index')->with('success', 'Denuncia eliminada correctamente');
    }
}
