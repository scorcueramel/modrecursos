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
            $table->string('codigo_persona',6)->nullable(false);
            $table->integer('tipo_permiso_id')->unsigned();
            $table->foreign('tipo_permiso_id')->references('id')->on('tipo_permisos')->onUpdate('cascade');
            $table->integer('concepto_id')->unsigned();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onUpdate('cascade');
            $table->date('fecha_inicio')->nullable(false);
            $table->date('fecha_fin')->nullable(false);
            $table->string('documento',40)->nullable(false);
            $table->boolean('estado')->default(1);
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
