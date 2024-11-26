<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('canal', 50); // Formulario Web, Expediente
            $table->date('fecha_recepcion');
            $table->integer('año_ingreso');
            $table->string('entidad_sujeta_control', 255);
            $table->string('ambito_geografico', 100);
            $table->string('provincia', 100);
            $table->string('distrito', 100);
            $table->text('descripcion');
            $table->text('funcionarios_involucrados')->nullable();
            $table->enum('estado_recepcion', ['Pendiente', 'Admitido', 'No Admitido', 'En Proceso']);
            $table->unsignedBigInteger('auditor_recepcion_id')->nullable(); // Relación con auditores
            $table->timestamps();

            // Relaciones
            $table->foreign('auditor_recepcion_id')->references('id')->on('auditores')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('denuncias');
    }
}
