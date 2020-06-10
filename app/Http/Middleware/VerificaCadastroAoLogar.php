<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Auth;

use App\Usuario;

/**
 * O seguinte middleware é responsável por redirecionar
 * o usuário ao cadastro das informações caso ele ainda 
 * não tenha preenchido o formulário.
 */

class VerificaCadastroAoLogar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::debug("Passei pelo middleware VerificaCadastroAoLogar");
        Log::debug(Auth::user()->cpf);
        $papelInativo = Auth::user()->papeis->firstWhere('nome', 'inabilitado');

        if(!empty($papelInativo)){
          return redirect()->route('UsuarioCreate');
        } else {
          return $next($request);
        }
    }
}
