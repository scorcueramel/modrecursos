<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('codigo_persona');
            $table->integer('tipo_permiso_id')->nullable();
            $table->foreign('tipo_permiso_id')->references('id')->on('tipo_permisos');

            $table->integer('tipo_concepto_id')->nullable();
            $table->foreign('tipo_concepto_id')->references('id')->on('conceptos');
            
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('documento')->nullable();
            $table->string('comentario')->nullable();
            $table->boolean('estado')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
