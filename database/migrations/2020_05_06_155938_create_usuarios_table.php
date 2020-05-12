<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id')->start_from(10000);
            $table->string('cpf',11)->nullable();
            $table->string('nome');
            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->date('data_nascimento');
            $table->string('email')->nullable();
            $table->string('telefone_residencial_ddd', 2)->nullable()->comment('DDD do telefone residencial');
            $table->string('telefone_residencial', 9)->nullable()->comment('Telefone residencial');
            $table->string('telefone_celular_ddd', 2)->nullable()->comment('DDD do telefone celular');
            $table->string('telefone_celular', 9)->nullable()->comment('Telefone celular');
            $table->boolean('whatsapp')->comment('se true numero de celular possui whatsapp');
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
        Schema::dropIfExists('usuarios');
    }
}
