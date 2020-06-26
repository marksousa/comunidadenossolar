<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Papel;
use App\Permissao;

use Session;

class PermissaoController extends Controller
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
      $registros = Permissao::all();
      return view('admin.permissao.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.permissao.adicionar');
    }

    /**
     * Verifica se já possui permissao com o mesmo nome.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function jaExistePermissao(Request $request)
    {
      $permissao = Permissao::firstWhere('nome', $request->nome);
      return empty($permissao) ? false : true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$this->jaExistePermissao($request)){
        Permissao::create($request->all());
        Session::flash('tipo', 'success');
        Session::flash('mensagem', 'Permissão Adicionada com Sucesso!');
        return redirect()->route('permissoes.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $registro = Permissao::find($id);

      return view('admin.permissao.editar',compact('registro'));
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
      if(!$this->jaExistePermissao($request)){
        Permissao::find($id)->update($request->all());
        Session::flash('tipo', 'success');
        Session::flash('mensagem', 'Permissão Atualizada com Sucesso!');
      }

      return redirect()->route('permissoes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Permissao::find($id)->delete();
      Session::flash('tipo', 'warning');
      Session::flash('mensagem', 'Permissão Removida com Sucesso!');
      return redirect()->route('permissoes.index');
    }
}
