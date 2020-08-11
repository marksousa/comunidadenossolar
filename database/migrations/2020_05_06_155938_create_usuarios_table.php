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
      $table->increments('id')->start_from(10001);
      $table->string('nome', 80);
      $table->string('possui_cpf', 1)->comment('Possui CPF próprio?');
      $table->string('cpf', 14)->nullable();
      $table->string('possui_rg', 1)->comment('Possui RG próprio?');
      $table->string('rg_numero', 15)->nullable();
      $table->string('rg_uf', 2)->nullable();
      $table->string('nascimento_uf', 2)->nullable();
      $table->string('nascimento_municipio', 60)->nullable();
      $table->integer('genero_id')->unsigned();
      $table->foreign('genero_id')->references('id')->on('generos');
      $table->date('data_nascimento')->nullable();
      $table->string('email', 60)->nullable();
      $table->string('telefone_residencial_ddd', 2)->nullable()->comment('DDD do telefone residencial');
      $table->string('telefone_residencial', 9)->nullable()->comment('Telefone residencial');
      $table->string('telefone_celular_ddd', 2)->nullable()->comment('DDD do telefone celular');
      $table->string('telefone_celular', 10)->nullable()->comment('Telefone celular');
      $table->string('termo_adesao', 1)->comment('Termo de adesão do voluntário');
      $table->timestamps();
    });

    \DB::statement('ALTER TABLE usuarios AUTO_INCREMENT = 10000;');
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