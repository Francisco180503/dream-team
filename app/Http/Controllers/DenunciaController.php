<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Auditor;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    // Mostrar todas las denuncias
    public function lista()
    {
        $denuncias = Denuncia::with('auditorRecepcion')->get();
        return view('denuncias.lista', compact('denuncias'));
    }

    // Formulario para registrar una nueva denuncia
    public function registro()
    {
        $auditores = Auditor::all(); // Obtiene todos los auditores para asignación
        return view('denuncias.registro', compact('auditores'));
    }

    // Guardar una nueva denuncia
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
            'descripcion' => 'required|string',
            'estado_recepcion' => 'required|in:Pendiente,Admitido,No Admitido,En Proceso',
            'auditor_recepcion_id' => 'nullable|exists:auditores,id',
        ]);

        $denuncia = new Denuncia();
        $denuncia->fill($request->all());
        $denuncia->save();

        return redirect('/Denuncias/lista')->with('success', 'Denuncia registrada exitosamente.');
    }

    // Formulario para modificar una denuncia existente
    public function modificar($id)
    {
        $denuncia = Denuncia::find($id);
        $auditores = Auditor::all();

        if (!$denuncia) {
            return redirect('/Denuncias/lista')->with('error', 'Denuncia no encontrada.');
        }

        return view('denuncias.modificar', compact('denuncia', 'auditores'));
    }

    // Actualizar una denuncia existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:denuncias,id',
            'canal' => 'required|string|max:50',
            'fecha_recepcion' => 'required|date',
            'año_ingreso' => 'required|integer',
            'entidad_sujeta_control' => 'required|string|max:255',
            'ambito_geografico' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'distrito' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado_recepcion' => 'required|in:Pendiente,Admitido,No Admitido,En Proceso',
            'auditor_recepcion_id' => 'nullable|exists:auditores,id',
        ]);

        $denuncia = Denuncia::find($request->input('id'));
        $denuncia->fill($request->all());
        $denuncia->save();

        return redirect('/Denuncias/lista')->with('success', 'Denuncia actualizada exitosamente.');
    }

        
    public function evaluar($id)
    {
        $denuncia = Denuncia::findOrFail($id); // Encuentra la denuncia
        $auditores = Auditor::all(); // Todos los auditores disponibles
        return view('denuncias.evaluar', compact('denuncia', 'auditores'));
    }

    public function guardarEvaluacion(Request $request, $id)
    {
    $request->validate([
        'fecha_evaluacion_inicio' => 'required|date',
        'fecha_evaluacion_fin' => 'nullable|date|after_or_equal:fecha_evaluacion_inicio',
        'resultado_evaluacion' => 'required|in:Desestimado,Pasa a Auditoría',
        'auditor_evaluacion_id' => 'required|exists:auditores,id',
    ]);

    $evaluacion = new \App\Models\Evaluacion();
    $evaluacion->denuncia_id = $id; // Relaciona la evaluación con la denuncia
    $evaluacion->fecha_evaluacion_inicio = $request->input('fecha_evaluacion_inicio');
    $evaluacion->fecha_evaluacion_fin = $request->input('fecha_evaluacion_fin');
    $evaluacion->resultado_evaluacion = $request->input('resultado_evaluacion');
    $evaluacion->auditor_evaluacion_id = $request->input('auditor_evaluacion_id');
    $evaluacion->save();

    return redirect('/Denuncias/lista')->with('success', 'Evaluación guardada exitosamente.');
}

    // Eliminar una denuncia
    public function eliminar($id)
    {
        $denuncia = Denuncia::find($id);

        if ($denuncia) {
            $denuncia->delete();
            return redirect('/Denuncias/lista')->with('success', 'Denuncia eliminada exitosamente.');
        }

        return redirect('/Denuncias/lista')->with('error', 'Denuncia no encontrada.');
    }
}
