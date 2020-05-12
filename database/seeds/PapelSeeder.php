<?php

use Illuminate\Database\Seeder;
use App\Papel;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Papel::firstOrCreate([
            'nome' =>'Admin',
            'descricao' =>'Acesso total ao sistema'
        ]);
  
        $p2 = Papel::firstOrCreate([
            'nome' =>'Master',
            'descricao' =>'Gerenciamento do sistema'
        ]);
  
        $p3 = Papel::firstOrCreate([
            'nome' =>'Lider',
            'descricao' =>'Líderes dos Pilares'
        ]);
  
        $p4 = Papel::firstOrCreate([
            'nome' =>'Trabalhador',
            'descricao' =>'Trabalhadores'
        ]);
  
        $p5 = Papel::firstOrCreate([
            'nome' =>'Voluntario',
            'descricao' =>'Voluntarios'
        ]);
  
        $p6 = Papel::firstOrCreate([
            'nome' =>'Doador',
            'descricao' =>'Doadores'
        ]);
  
        $p7 = Papel::firstOrCreate([
            'nome' =>'Assistido',
            'descricao' =>'Assistidos'
        ]);
  
        echo "Papeis criados com Sucesso";
        echo "\n";
      }
}
