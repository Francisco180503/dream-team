<?php

namespace App\Imports;

use App\Models\Denuncia;
use Maatwebsite\Excel\Concerns\ToModel;

class DenunciasImport implements ToModel
{
    public function model(array $row)
    {
        // Aquí debes ajustar cómo se asignan las columnas del Excel a los atributos de la base de datos
        return new Denuncia([
            'canal' => $row[1],  // Ajusta los índices según la estructura de tu archivo Excel
            'fecha_recepcion' => $row[2],
            'anio_ingreso' => $row[3],
            'entidad' => $row[4],
            'ambito_geografico' => $row[5],
            'provincia' => $row[6],
            'distrito' => $row[7],
            'fecha_registro' => $row[8],
            'auditor_recepcion' => $row[9],
            'fecha_evaluacion' => $row[10],
            'estado_recepcion' => $row[11],
            'auditor_evaluacion' => $row[12],
            'fecha_culminacion' => $row[13],
            'resultado_evaluacion' => $row[14],
        ]);
    }
}
