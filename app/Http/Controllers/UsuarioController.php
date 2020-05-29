<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Endereco;
use App\Perfil;

use Illuminate\Http\Request;

use App\Http\Requests\UsuarioSanitizedRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;

use App\Pais;
use App\Estado;
use App\Genero;
use App\Motivo;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistidos = Usuario::all();
        return view('listas.assistidos', compact('assistidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        $estados = Estado::all();
        $generos = Genero::all();
        $motivos = Motivo::all();
        return view('forms.novo-usuario', compact('paises', 'estados', 'generos','motivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioSanitizedRequest $request)
    {

        // Esse vetor $validated possui todos os dados que foram validados pela classe UsuarioSanitizedRequest.
        $validated = $request->validated();
        // Se algum dado nao foi validado, nem chega aqui. O script encaminha de volta para o formulário
        // e informa o erro através da variável $errors (na view)
        // dd($validated);

        $usuario = new Usuario();
        $endereco = new Endereco();
        $perfil = new Perfil();

        // Dados Pessoais
        $usuario->cpf = $validated["cpf"];
        $usuario->nome = $validated["nome"];
        $usuario->genero_id = $validated["genero_id"];
        $usuario->data_nascimento = $validated["data_nascimento"];

        // Endereço
        $endereco->endereco = $validated["endereco"];
        $endereco->numero = $validated["numero"];
        $endereco->complemento = $validated["complemento"];
        $endereco->cep = $validated["cep"];
        $endereco->bairro = $validated["bairro"];
        $endereco->municipio = $validated["municipio"];
        $endereco->uf = $validated["uf"];
        $endereco->pais = $validated["pais"];

        // Dados de Contato
        $usuario->telefone_residencial_ddd = $validated["telefone_residencial_ddd"];
        $usuario->telefone_residencial = $validated["telefone_residencial"];
        $usuario->telefone_celular_ddd = $validated["telefone_celular_ddd"];
        $usuario->telefone_celular = $validated["telefone_celular"];
        $usuario->email = $validated["email"];

        // Entrevista
        $perfil->motivo_id = $validated["motivo_id"];
        $perfil->data_inicio_nl = $validated["data_inicio_nl"];
        $perfil->primeira_area_nl = $validated["primeira_area_nl"];
        $perfil->observacao = $validated["observacao"];

        try {
            $usuario->save();
            $endereco->usuario_id = $usuario->id;
            $endereco->save();
            $perfil->usuario_id = $usuario->id;
            $perfil->save();
        } catch (\Exception $e){
            info($e);
            Session::flash('alert-danger', 'Ocorreu um erro ao salvar o novo usuário. Tente Novamente.');
            return redirect()->back()->withInput();
        }

        return redirect()->route('FotoCreate', ['id' => $usuario->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id usuario
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $assistido = Usuario::findOrFail($id);
            return view('perfil', compact('assistido'));
        } catch (ModelNotFoundException $exception) {
            abort(404, 'Usuário Não Encontrado!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
