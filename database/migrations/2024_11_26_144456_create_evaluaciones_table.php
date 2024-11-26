<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('denuncia_id');
            $table->date('fecha_evaluacion_inicio');
            $table->date('fecha_evaluacion_fin')->nullable();
            $table->enum('resultado_evaluacion', ['Desestimado', 'Pasa a Auditoría'])->nullable();
            $table->unsignedBigInteger('auditor_evaluacion_id');
            $table->timestamps();

            // Relaciones
            $table->foreign('denuncia_id')->references('id')->on('denuncias')->onDelete('cascade');
            $table->foreign('auditor_evaluacion_id')->references('id')->on('auditores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
}
