<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_personals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_registro');
            $table->foreign('id_registro')->references('id')->on('registros');
            $table->integer('inicial');
            $table->integer('saldo');
            $table->integer('adicional');
            $table->integer('total');
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
        Schema::dropIfExists('dias_personals');
    }
}
