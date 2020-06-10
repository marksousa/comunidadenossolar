<?php

use Illuminate\Database\Seeder;
use App\Permissao;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios1 = Permissao::firstOrCreate([
            'nome' =>'user-view',
            'descricao' =>'Acesso a lista de Users'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'user-create',
            'descricao' =>'Adicionar User'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'user-edit',
            'descricao' =>'Editar User'
        ]);
        $usuarios3 = Permissao::firstOrCreate([
            'nome' =>'user-delete',
            'descricao' =>'Deletar User'
        ]);
  
        $papeis1 = Permissao::firstOrCreate([
            'nome' =>'papel-view',
            'descricao' =>'Listar Papéis'
        ]);
        $papeis2 = Permissao::firstOrCreate([
            'nome' =>'papel-create',
            'descricao' =>'Adicionar Papéis'
        ]);
        $papeis3 = Permissao::firstOrCreate([
            'nome' =>'papel-edit',
            'descricao' =>'Editar Papéis'
        ]);
  
        $papeis4 = Permissao::firstOrCreate([
            'nome' =>'papel-delete',
            'descricao' =>'Deletar Papéis'
        ]);

        $papeis5 = Permissao::firstOrCreate([
          'nome' =>'usuarios-create',
          'descricao' =>'Criar Usuários para alimentar o sistema'
        ]);

        $papeis6 = Permissao::firstOrCreate([
          'nome' =>'usuarios-view',
          'descricao' =>'Ver as informações dos usuários cadastrados'
        ]);

        $papeis7 = Permissao::firstOrCreate([
          'nome' =>'admin-resources',
          'descricao' =>'Acesso a lista de recursos exclusivas aos administradores e outras lideranças'
        ]);
        
        echo "Registros de Permissoes criados no sistema";
        echo "\n";
      }
}
