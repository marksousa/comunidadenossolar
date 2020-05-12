<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '12', 'sigla' => 'AC', 'nome' => 'Acre']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '27', 'sigla' => 'AL', 'nome' => 'Alagoas']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '16', 'sigla' => 'AP', 'nome' => 'Amapá']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '13', 'sigla' => 'AM', 'nome' => 'Amazonas']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '29', 'sigla' => 'BA', 'nome' => 'Bahia']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '23', 'sigla' => 'CE', 'nome' => 'Ceará']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '53', 'sigla' => 'DF', 'nome' => 'Distrito Federal']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '32', 'sigla' => 'ES', 'nome' => 'Espírito Santo']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '52', 'sigla' => 'GO', 'nome' => 'Goiás']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '21', 'sigla' => 'MA', 'nome' => 'Maranhão']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '51', 'sigla' => 'MT', 'nome' => 'Mato Grosso']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '50', 'sigla' => 'MS', 'nome' => 'Mato Grosso do Sul']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '31', 'sigla' => 'MG', 'nome' => 'Minas Gerais']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '15', 'sigla' => 'PA', 'nome' => 'Pará']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '25', 'sigla' => 'PB', 'nome' => 'Paraíba']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '41', 'sigla' => 'PR', 'nome' => 'Paraná']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '26', 'sigla' => 'PE', 'nome' => 'Pernambuco']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '22', 'sigla' => 'PI', 'nome' => 'Piauí']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '33', 'sigla' => 'RJ', 'nome' => 'Rio de Janeiro']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '24', 'sigla' => 'RN', 'nome' => 'Rio Grande do Norte']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '43', 'sigla' => 'RS', 'nome' => 'Rio Grande do Sul']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '11', 'sigla' => 'RO', 'nome' => 'Rondônia']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '14', 'sigla' => 'RR', 'nome' => 'Roraima']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '42', 'sigla' => 'SC', 'nome' => 'Santa Catarina']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '35', 'sigla' => 'SP', 'nome' => 'São Paulo']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '28', 'sigla' => 'SE', 'nome' => 'Sergipe']);
		DB::table('estados')->insert(['pais_id' => '1', 'ibge' => '17', 'sigla' => 'TO', 'nome' => 'Tocantins']);
    }
}
