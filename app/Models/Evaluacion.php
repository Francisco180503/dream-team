<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table = 'evaluaciones';
    public $timestamps = false;
    protected $fillable = [
        'denuncia_id',
        'fecha_evaluacion_inicio',
        'fecha_evaluacion_fin',     
        'resultado_evaluacion',
        'auditor_evaluacion_id',
    ];

    // Relación con el modelo Denuncia
    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    // Relación con el modelo Auditor
    public function auditorEvaluacion()
    {
        return $this->belongsTo(Auditor::class, 'auditor_evaluacion_id');
    }
}
