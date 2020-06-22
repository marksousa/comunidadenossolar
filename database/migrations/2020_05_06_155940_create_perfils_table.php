<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfis', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->integer('motivo_id')->unsigned();
            $table->foreign('motivo_id')->references('id')->on('motivos');
            $table->string('data_inicio_nl', 7)->nullable()->comment('Data de Inicio no Nosso Lar');
            $table->integer('pilar_id')->unsigned();
            $table->foreign('pilar_id')->references('id')->on('pilares');
            $table->mediumText('observacao')->nullable()->comment('Observacao');
            $table->string('foto_path')->nullable()->comment('path da foto de perfil');
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
        Schema::dropIfExists('perfis');
    }
}
