<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Papel;
use App\Permissao;

class PapelController extends Controller
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
      $registros = Papel::all();
      return view('admin.papel.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.papel.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request['nome'] && $request['nome'] != "Admin" && $request['nome'] != "ADMIN" && $request['nome'] != "admin"){
        Papel::create($request->all());

        return redirect()->route('papeis.index');
      }

      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Método de Proteção ao Admin
     *
     * @param  Papel  $papel
     * @return \Illuminate\Http\Response
     */
    public function protegerAdmin(Papel $papel)
    {
      $papel = strtoupper($papel->nome);
      return $papel === "ADMIN" ? true : false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // Se tentar editar o Admin
      if($this->protegerAdmin(Papel::find($id))){
        return redirect()->route('papeis.index');
      }

      $registro = Papel::find($id);

      return view('admin.papel.editar',compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Se tentar editar o Admin
      if($this->protegerAdmin(Papel::find($id))){
        return redirect()->route('papeis.index');
      }

      if($request['nome'] && $request['nome'] != "Admin" && $request['nome'] != "ADMIN" && $request['nome'] != "admin"){
        Papel::find($id)->update($request->all());
      }

      return redirect()->route('papeis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Se tentar excluir o Admin
      if($this->protegerAdmin(Papel::find($id))){
        return redirect()->route('papeis.index');
      }

      Papel::find($id)->delete();
      return redirect()->route('papeis.index');
    }

    /**
     * Relaciona Papel com Permissao
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissao($id)
    {
      // if(Gate::denies('papel-edit')){
      //   abort(403,"Não autorizado!");
      // }

      $papel = Papel::find($id);
      $permissoes = Permissao::all();

      return view('admin.papel.permissao',compact('papel','permissoes'));
    }

    /**
     * Adiciona Permissão ao Papel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissaoStore(Request $request,$id)
    {
        // if(Gate::denies('papel-edit')){
        //   abort(403,"Não autorizado!");
        // }
        $papel = Papel::find($id);
        $dados = $request->all();
        $permissao = Permissao::find($dados['permissao_id']);
        $papel->adicionaPermissao($permissao);
        return redirect()->back();
    }

    /**
     * Retira Permissão do Papel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissaoDestroy($id,$permissao_id)
    {
      // if(Gate::denies('papel-edit')){
      //   abort(403,"Não autorizado!");
      // }

      $papel = Papel::find($id);
      $permissao = Permissao::find($permissao_id);
      $papel->removePermissao($permissao);
      return redirect()->back();
    }
}
