<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Permissao;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
      // 'App\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    foreach($this->listaPermissoes() as $permissao){
      Gate::define($permissao->nome, function($user) use($permissao){
        return $user->temUmPapelDestes($permissao->papeis) || $user->eAdmin();
      });
    }
  }

  /**
   * Retorna todas as permissões presentes no banco
   *
   * @return object
   */
  public function listaPermissoes(){
    // o método with traz os papeis junto com as pemissões
    return Permissao::with('papeis')->get();
  }
}
