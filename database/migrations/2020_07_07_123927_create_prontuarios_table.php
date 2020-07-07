<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProntuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saude_prontuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->string('numero_sus', 15)->nullable();
            $table->string('nome_mae', 80)->nullable();
            $table->string('nome_pai', 80)->nullable();
            $table->string('municipio_nascimento', 80)->nullable();
            $table->string('profissao', 80)->nullable();
            $table->string('estado_civil', 80)->nullable();
            $table->string('raca', 80)->nullable();
            $table->string('religiao', 80)->nullable();
            $table->enum('tipo_sanguineo', ['A+', 'B+', 'AB+', 'O+','A-', 'B-', 'AB-', 'O-','Não Sabe'])->nullable();
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
        Schema::dropIfExists('saude_prontuarios');
    }
}
