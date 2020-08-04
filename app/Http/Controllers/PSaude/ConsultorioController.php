<?php

namespace App\Http\Controllers\PSaude;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PSaude\Consultorio;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Session;

class ConsultorioController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $registros = Consultorio::all();
    return view('PSaude.consultorio.index', compact('registros'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('PSaude.consultorio.adicionar');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Consultorio::create($request->all());

    Session::flash('tipo', 'success');
    Session::flash('mensagem', 'Consultório Adicionado com Sucesso!');
    return redirect()->route('consultorios.index');
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
      $registro = Consultorio::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Consultório Não Encontrado!');
    }

    return view('PSaude.consultorio.editar', compact('registro'));
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
      $registro = Consultorio::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Consultório Não Encontrado!');
    }
    $registro->update($request->all());
    Session::flash('tipo', 'success');
    Session::flash('mensagem', 'Consultório Atualizado com Sucesso!');

    return redirect()->route('consultorios.index');
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
      $registro = Consultorio::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Consultório Não Encontrado!');
    }
    $registro->delete();
    Session::flash('tipo', 'warning');
    Session::flash('mensagem', 'Consultório Removido com Sucesso!');
    return redirect()->route('consultorios.index');
  }
}
