<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'carga_laboral',
    ];

    // Relación con el modelo Denuncia (como auditor de recepción)
    public function denunciasRecepcion()
    {
        return $this->hasMany(Denuncia::class, 'auditor_recepcion_id');
    }

    // Relación con el modelo Evaluacion (como auditor de evaluación)
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'auditor_evaluacion_id');
    }
}
