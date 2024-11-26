<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoresTable extends Migration
{
    public function up()
    {
        Schema::create('auditores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('email', 255)->unique();
            $table->string('telefono', 20)->nullable();
            $table->integer('carga_laboral')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('auditores');
    }
}
