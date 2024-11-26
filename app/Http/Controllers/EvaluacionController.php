<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Denuncia;
use App\Models\Auditor;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    // Mostrar todas las evaluaciones
    public function lista()
    {
        $evaluaciones = Evaluacion::with(['denuncia', 'auditorEvaluacion'])->get();
        return view('evaluaciones.lista', compact('evaluaciones'));
    }

    // Formulario para registrar una nueva evaluación
    public function registro()
    {
        $denuncias = Denuncia::where('estado_recepcion', 'Admitido')->get();
        $auditores = Auditor::all();
        return view('evaluaciones.registro', compact('denuncias', 'auditores'));
    }

    // Guardar una nueva evaluación
    public function guardar(Request $request)
    {
        $request->validate([
            'denuncia_id' => 'required|exists:denuncias,id',
            'auditor_evaluacion_id' => 'required|exists:auditores,id',
            'fecha_evaluacion_inicio' => 'required|date',
            'fecha_evaluacion_fin' => 'nullable|date|after_or_equal:fecha_evaluacion_inicio',
            'resultado_evaluacion' => 'nullable|in:Desestimado,Pasa a Auditoría',
        ]);

        $evaluacion = new Evaluacion();
        $evaluacion->denuncia_id = $request->input('denuncia_id');
        $evaluacion->auditor_evaluacion_id = $request->input('auditor_evaluacion_id');
        $evaluacion->fecha_evaluacion_inicio = $request->input('fecha_evaluacion_inicio');
        $evaluacion->fecha_evaluacion_fin = $request->input('fecha_evaluacion_fin');
        $evaluacion->resultado_evaluacion = $request->input('resultado_evaluacion');
        $evaluacion->save();

        return redirect('/Evaluaciones/lista')->with('success', 'Evaluación registrada exitosamente.');
    }

    // Formulario para modificar una evaluación existente
    public function modificar(int $id)
    {
        $evaluacion = Evaluacion::find($id);
        $denuncias = Denuncia::where('estado_recepcion', 'Admitido')->get();
        $auditores = Auditor::all();

        if (!$evaluacion) {
            return redirect('/Evaluaciones/lista')->with('error', 'Evaluación no encontrada.');
        }

        return view('evaluaciones.actualizar', compact('evaluacion', 'denuncias', 'auditores'));
    }

    // Actualizar una evaluación existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:evaluaciones,id',
            'denuncia_id' => 'required|exists:denuncias,id',
            'auditor_evaluacion_id' => 'required|exists:auditores,id',
            'fecha_evaluacion_inicio' => 'required|date',
            'fecha_evaluacion_fin' => 'nullable|date|after_or_equal:fecha_evaluacion_inicio',
            'resultado_evaluacion' => 'nullable|in:Desestimado,Pasa a Auditoría',
        ]);

        $evaluacion = Evaluacion::find($request->input('id'));
        $evaluacion->denuncia_id = $request->input('denuncia_id');
        $evaluacion->auditor_evaluacion_id = $request->input('auditor_evaluacion_id');
        $evaluacion->fecha_evaluacion_inicio = $request->input('fecha_evaluacion_inicio');
        $evaluacion->fecha_evaluacion_fin = $request->input('fecha_evaluacion_fin');
        $evaluacion->resultado_evaluacion = $request->input('resultado_evaluacion');
        $evaluacion->save();

        return redirect('/Evaluaciones/lista')->with('success', 'Evaluación actualizada exitosamente.');
    }

    // Eliminar una evaluación
    public function eliminar(int $id)
    {
        $evaluacion = Evaluacion::find($id);

        if ($evaluacion) {
            $evaluacion->delete();
            return redirect('/Evaluaciones/lista')->with('success', 'Evaluación eliminada exitosamente.');
        }

        return redirect('/Evaluaciones/lista')->with('error', 'Evaluación no encontrada.');
    }
}
