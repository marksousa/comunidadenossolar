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
            'descricao' =>'Acesso total ao sistema (TI)'
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
            'descricao' =>'Trabalhador'
        ]);
  
        $p5 = Papel::firstOrCreate([
          'nome' =>'inabilitado',
          'descricao' =>'Usuário que após o cadastro básico ainda não preencheu as demais informações'
      ]);
  
        echo "Papeis criados com Sucesso";
        echo "\n";
      }
}
