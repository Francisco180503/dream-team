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
        $denuncias = Denuncia::where('estado_recepcion', 'Admitido')->get(); // Solo denuncias admitidas
        $auditores = Auditor::all(); // Todos los auditores disponibles
    
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

        Evaluacion::create($request->all());

        return redirect('/Evaluaciones/lista')->with('success', 'Evaluación registrada exitosamente.');
    }

    // Formulario para modificar una evaluación existente
    public function modificar($id)
    {
        $evaluacion = Evaluacion::find($id);
        $denuncias = Denuncia::where('estado_recepcion', 'Admitido')->get();
        $auditores = Auditor::all();
    
        if (!$evaluacion) {
            return redirect('/Evaluaciones/lista')->with('error', 'Evaluación no encontrada.');
        }
    
        return view('evaluaciones.modificar', compact('evaluacion', 'denuncias', 'auditores'));
    }
    

    // Actualizar una evaluación existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:evaluaciones,id',
            'denuncia_id' => 'required|exists:denuncias,id',
            'auditor_evaluacion_id' => 'required|exists:auditores,id',
            'fecha_evaluacion_inicio' => 'required|date',
            'fecha_evaluacion_fin' => 'nullable|date|after_or_equal:fecha_evaluacion_inicio',
            'resultado_evaluacion' => 'nullable|in:Desestimado,Pasa a Auditoría',
        ]);

        $evaluacion = Evaluacion::find($request->input('id'));
        $evaluacion->update($request->all());

        return redirect('/Evaluaciones/lista')->with('success', 'Evaluación actualizada exitosamente.');
    }

    // Eliminar una evaluación
    public function eliminar($id)
    {
        $evaluacion = Evaluacion::find($id);

        if ($evaluacion) {
            $evaluacion->delete();
            return redirect('/Evaluaciones/lista')->with('success', 'Evaluación eliminada exitosamente.');
        }

        return redirect('/Evaluaciones/lista')->with('error', 'Evaluación no encontrada.');
    }
}
