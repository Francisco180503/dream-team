<?php

namespace App\Models;

use App\Http\Controllers\DenunciasController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

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

    // Relación con el modelo Auditor
    public function auditorRecepcion()
    {
        return $this->belongsTo(Auditor::class, 'auditor_recepcion_id');
    }

    // Relación con el modelo Evaluacion
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
}
