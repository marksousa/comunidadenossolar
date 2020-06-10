<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\User;
use App\Papel;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('verifica.cadastro');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Gate::denies('admin-resources')){
        abort(403,"Não autorizado!");
      }

        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Listar Papeis do Usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function papel($id)
    {
      $user = User::find($id);
      $papeis = Papel::all();
      return view('admin.user.papeis-user', compact('user', 'papeis'));
    }

    /**
     * Adicionar Papeis ao Usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function papelStore(Request $request, $id)
    {
      // Seleciona o user
      $user = User::find($id);

      // Busca o papel pelo id
      $papel = Papel::find($request->input('papel_id'));

      // Adiciona o papel (método localizado no modelo User)
      $user->adicionaPapel($papel);

      // Volta para a tela atualizando o papel já adicionado
      return redirect()->back();
    }

    /**
     * Adicionar Papeis ao Usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function papelDestroy($id, $papel_id)
    {
      // Seleciona o user
      $user = User::find($id);

      // Busca o papel pelo id
      $papel = Papel::find($papel_id);

      // Adiciona o papel (método localizado no modelo User)
      $user->removePapel($papel);

      // Volta para a tela atualizando o papel já removido
      return redirect()->back();
    }

}
