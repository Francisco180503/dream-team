<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    // Mostrar todos los auditores
    public function lista()
    {
        $auditores = Auditor::all();
        return view('auditores.lista', compact('auditores'));
    }

    // Formulario para registrar un nuevo auditor
    public function registro()
    {
        return view('auditores.registro');
    }

    // Guardar un nuevo auditor
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:auditores,email',
            'telefono' => 'nullable|string|max:20',
        ]);

        $auditor = new Auditor();
        $auditor->nombre = $request->input('nombre');
        $auditor->email = $request->input('email');
        $auditor->telefono = $request->input('telefono');
        $auditor->save();

        return redirect('/Auditores/lista')->with('success', 'Auditor registrado exitosamente.');
    }

    // Formulario para modificar un auditor existente
    public function modificar(int $id)
    {
        $auditor = Auditor::find($id);

        if (!$auditor) {
            return redirect('/Auditores/lista')->with('error', 'Auditor no encontrado.');
        }

        return view('auditores.actualizar', compact('auditor'));
    }

    // Actualizar un auditor existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:auditores,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:auditores,email,' . $request->input('id'),
            'telefono' => 'nullable|string|max:20',
        ]);

        $auditor = Auditor::find($request->input('id'));
        $auditor->nombre = $request->input('nombre');
        $auditor->email = $request->input('email');
        $auditor->telefono = $request->input('telefono');
        $auditor->save();

        return redirect('/Auditores/lista')->with('success', 'Auditor actualizado exitosamente.');
    }

    // Eliminar un auditor
    public function eliminar(int $id)
    {
        $auditor = Auditor::find($id);

        if ($auditor) {
            $auditor->delete();
            return redirect('/Auditores/lista')->with('success', 'Auditor eliminado exitosamente.');
        }

        return redirect('/Auditores/lista')->with('error', 'Auditor no encontrado.');
    }
}
