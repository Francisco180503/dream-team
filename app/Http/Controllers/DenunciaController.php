<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\Auditor;

class DenunciasController extends Controller
{
    // Método para mostrar el formulario de registro de denuncia
    public function registro()
    {
        $auditores = Auditor::all(); // Obtenemos los auditores para el formulario
        return view("denuncias.registro", compact('auditores'));
    }

    // Método para guardar una nueva denuncia
    public function guardar(Request $request)
    {
        $request->validate([
            'canal' => 'required|string|max:50',
            'fecha_recepcion' => 'required|date',
            'año_ingreso' => 'required|integer',
            'entidad_sujeta_control' => 'required|string|max:255',
            'ambito_geografico' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'descripcion' => 'required|string|min:10',
        ]);

        // Asignación automática del auditor con menor carga laboral
        $auditor = Auditor::withCount(['denunciasRecepcion as carga'])
            ->orderBy('carga', 'asc')
            ->first();

        $denuncia = new Denuncia();
        $denuncia->canal = $request->input("canal");
        $denuncia->fecha_recepcion = $request->input("fecha_recepcion");
        $denuncia->año_ingreso = $request->input("año_ingreso");
        $denuncia->entidad_sujeta_control = $request->input("entidad_sujeta_control");
        $denuncia->ambito_geografico = $request->input("ambito_geografico");
        $denuncia->provincia = $request->input("provincia");
        $denuncia->distrito = $request->input("distrito");
        $denuncia->descripcion = $request->input("descripcion");
        $denuncia->funcionarios_involucrados = $request->input("funcionarios_involucrados");
        $denuncia->estado_recepcion = 'Pendiente';
        $denuncia->auditor_recepcion_id = $auditor->id;

        $denuncia->save();
        return redirect("/Denuncias/lista")->with('success', 'Denuncia registrada exitosamente.');
    }

    // Método para mostrar la lista de denuncias
    public function lista()
    {
        $denuncias = Denuncia::with('auditorRecepcion')->get();
        return view("denuncias.lista", compact('denuncias'));
    }

    // Método para cargar los datos de una denuncia para modificar
    public function modificar(int $id)
    {
        $denuncia = Denuncia::find($id);
        $auditores = Auditor::all(); // Obtenemos los auditores para la edición
        return view("denuncias.actualizar", compact('denuncia', 'auditores'));
    }

    // Método para actualizar una denuncia
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:denuncias,id',
            'canal' => 'required|string|max:50',
            'fecha_recepcion' => 'required|date',
            'año_ingreso' => 'required|integer',
            'entidad_sujeta_control' => 'required|string|max:255',
            'ambito_geografico' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'descripcion' => 'required|string|min:10',
        ]);

        $denuncia = Denuncia::find($request->input("id"));
        $denuncia->canal = $request->input("canal");
        $denuncia->fecha_recepcion = $request->input("fecha_recepcion");
        $denuncia->año_ingreso = $request->input("año_ingreso");
        $denuncia->entidad_sujeta_control = $request->input("entidad_sujeta_control");
        $denuncia->ambito_geografico = $request->input("ambito_geografico");
        $denuncia->provincia = $request->input("provincia");
        $denuncia->distrito = $request->input("distrito");
        $denuncia->descripcion = $request->input("descripcion");
        $denuncia->funcionarios_involucrados = $request->input("funcionarios_involucrados");
        $denuncia->auditor_recepcion_id = $request->input("auditor_recepcion_id");
        $denuncia->save();

        return redirect("/Denuncias/lista")->with('success', 'Denuncia actualizada exitosamente.');
    }

    // Método para eliminar una denuncia
    public function eliminar(int $id)
    {
        $denuncia = Denuncia::find($id);
        if ($denuncia) {
            $denuncia->delete();
        }
        return redirect("/Denuncias/lista")->with('success', 'Denuncia eliminada exitosamente.');
    }
}
