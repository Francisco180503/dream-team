<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditor;

class AuditorController extends Controller
{
    // Mostrar lista de auditores
    public function lista()
    {
        // Consulta explícitamente la tabla 'auditores' sin cambiar el modelo
        $auditores = \DB::table('auditores')->get(); 
        return view('auditor.lista', compact('auditores'));
    }
    // Formulario para registrar un nuevo auditor
    public function registro()
    {
        return view('auditor.registro');
    }

    // Guardar un nuevo auditor
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:auditores,email',
            'telefono' => 'nullable|string|max:20',
            'carga_laboral' => 'nullable|integer|min:0',
        ]);

        $auditor = new Auditor();
        $auditor->nombre = $request->input('nombre');
        $auditor->email = $request->input('email');
        $auditor->telefono = $request->input('telefono');
        $auditor->carga_laboral = $request->input('carga_laboral', 0);
        $auditor->save();

        return redirect('/Auditores/lista')->with('success', 'Auditor registrado exitosamente.');
    }

    // Formulario para modificar un auditor existente
    public function modificar($id)
    {
        $auditor = Auditor::find($id);

        if (!$auditor) {
            return redirect('/Auditores/lista')->with('error', 'Auditor no encontrado.');
        }

        return view('auditor.modificar', compact('auditor'));
    }

    // Actualizar un auditor existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:auditores,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:auditores,email,' . $request->input('id'),
            'telefono' => 'nullable|string|max:20',
            'carga_laboral' => 'nullable|integer|min:0',
        ]);

        $auditor = Auditor::find($request->input('id'));
        $auditor->nombre = $request->input('nombre');
        $auditor->email = $request->input('email');
        $auditor->telefono = $request->input('telefono');
        $auditor->carga_laboral = $request->input('carga_laboral');
        $auditor->save();

        return redirect('/Auditores/lista')->with('success', 'Auditor actualizado exitosamente.');
    }

    // Eliminar un auditor
    public function eliminar($id)
    {
        $auditor = Auditor::find($id);

        if ($auditor) {
            $auditor->delete();
            return redirect('/Auditores/lista')->with('success', 'Auditor eliminado exitosamente.');
        }

        return redirect('/Auditores/lista')->with('error', 'Auditor no encontrado.');
    }
}
