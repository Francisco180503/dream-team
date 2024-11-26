<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    // Indica que la tabla no utiliza timestamps automáticamente
    public $timestamps = false;

    // Define los campos que pueden ser asignados en masa
    protected $fillable = [
        'canal',
        'fecha_recepcion',
        'año_ingreso',
        'entidad_sujeta_control',
        'ambito_geografico',
        'provincia',
        'distrito',
        'descripcion',
        'funcionarios_involucrados',
        'estado_recepcion',
        'auditor_recepcion_id',
    ];

    /**
     * Relación con el modelo Auditor
     * Una denuncia pertenece a un auditor (como auditor de recepción).
     */
    public function auditorRecepcion()
    {
        return $this->belongsTo(Auditor::class, 'auditor_recepcion_id', 'id');
    }

    /**
     * Relación con el modelo Evaluacion
     * Una denuncia puede tener muchas evaluaciones asociadas.
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'denuncia_id', 'id');
    }
}
