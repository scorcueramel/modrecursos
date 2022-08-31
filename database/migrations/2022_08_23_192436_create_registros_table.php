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
            $table->unsignedBigInteger('tipo_permiso_id');
            $table->foreign('tipo_permiso_id')->references('id')->on('tipo_permisos');
            $table->unsignedBigInteger('concepto_id');
            $table->foreign('concepto_id')->references('id')->on('conceptos');
            $table->unsignedBigInteger('id_dias');
            $table->foreign('id_dias')->references('id')->on('dias_personals');
            $table->date('fecha_inicio')->nullable(false);
            $table->date('fecha_fin')->nullable(false);
            $table->string('documento',40)->nullable(false);
            $table->string('comentario')->nullable();
            $table->string('usuario_creador')->nullable();
            $table->string('usuario_editor')->nullable();
            $table->string('ip_usuario')->nullable();
            $table->boolean('estado')->default(1);
            $table->boolean('flag_exportar')->default(0);

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
