<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    // Indica que la tabla asociada es 'auditores'
    protected $table = 'auditores';

    // Desactiva automáticamente las columnas de timestamps si no se usan
    public $timestamps = false;

    // Define los campos que pueden ser asignados en masa
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'carga_laboral',
    ];

    /**
     * Relación con el modelo Denuncia como auditor de recepción
     * Un auditor puede estar relacionado con muchas denuncias.
     */
    public function denunciasRecepcion()
    {
        return $this->hasMany(Denuncia::class, 'auditor_recepcion_id', 'id');
    }

    /**
     * Relación con el modelo Evaluacion como auditor de evaluación
     * Un auditor puede estar relacionado con muchas evaluaciones.
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'auditor_evaluacion_id', 'id');
    }
}
