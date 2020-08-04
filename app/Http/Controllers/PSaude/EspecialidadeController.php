<?php

namespace App\Http\Controllers\PSaude;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PSaude\Especialidade;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Session;

class EspecialidadeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $registros = Especialidade::all();
    return view('PSaude.especialidade.index', compact('registros'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('PSaude.especialidade.adicionar');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Especialidade::create($request->all());

    Session::flash('tipo', 'success');
    Session::flash('mensagem', 'Especialidade Adicionada com Sucesso!');
    return redirect()->route('especialidades.index');
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
    try {
      $registro = Especialidade::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Especialidade Não Encontrada!');
    }

    return view('PSaude.especialidade.editar', compact('registro'));
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
    try {
      $registro = Especialidade::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Especialidade Não Encontrada!');
    }
    $registro->update($request->all());
    Session::flash('tipo', 'success');
    Session::flash('mensagem', 'Especialidade Atualizada com Sucesso!');

    return redirect()->route('especialidades.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $registro = Especialidade::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Especialidade Não Encontrada!');
    }
    $registro->delete();
    Session::flash('tipo', 'warning');
    Session::flash('mensagem', 'Especialidade Removida com Sucesso!');
    return redirect()->route('especialidades.index');
  }
}
