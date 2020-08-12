<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->string('endereco', 60)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 40)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('bairro', 60)->nullable();
            $table->string('municipio', 60)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('pais', 80)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
