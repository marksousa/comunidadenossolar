<?php

namespace App\Http\Controllers\Saude;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Usuario;

class ProntuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Index para Listar Os Prontuários dos Pacientes
        // Restrito aos médicos e outros profissionais do atendimento
        return view('saude.prontuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $usuario_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $usuario_id)
    {
        //Precisamos do Id do Usuário ao qual pertencerá o Prontuário que será criado
        $usuario = Usuario::find($usuario_id);
        //Enviar essas informações para um formulario de preenchimento das informações do pronturario
        return view('saude.prontuario.adicionar', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
