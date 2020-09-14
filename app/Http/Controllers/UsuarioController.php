<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\User;
use App\Endereco;
use App\Perfil;

use App\Http\Requests\UsuarioSanitizedRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Session;
use Auth;

class UsuarioController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('verifica.cadastro')->except('create', 'store');
  }

  /**
   * Verifica se o User logado possui papel inativo
   *
   * @return void
   */
  public function papelInativo()
  {
    $papelInativo = Auth::user()->papeis->firstWhere('nome', 'inabilitado');

    if (!empty($papelInativo)) {
      return true;
    }

    return false;
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $usuarios = Usuario::all();
    return view('admin.usuario.index', compact('usuarios'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $usuario = new Usuario();
    $bloquearEdicao = '';

    if ($this->papelInativo()) {
      $usuario->cpf = Auth::user()->cpf;
      $usuario->nome = Auth::user()->name;
      $usuario->email = Auth::user()->email;
      $bloquearEdicao = 'readonly';
      $assistido = false;
    } else {
      $assistido = true;
    }

    return view('admin.usuario.adicionar', compact('assistido', 'bloquearEdicao', 'usuario'));
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
    //dd($validated);

    $usuario = new Usuario();
    $endereco = new Endereco();
    $perfil = new Perfil();

    // Dados Pessoais
    $usuario->nome = $validated["nome"];

    //if ($request->assistido == 1) {
    $usuario->possui_cpf = $validated["possui_cpf"];
    $usuario->possui_rg = $validated["possui_rg"];
    $usuario->nascimento_uf = $validated["nascimento_uf"];
    $usuario->nascimento_municipio = $validated["nascimento_municipio"];
    //} else {
    //$usuario->possui_cpf = 'S';
    //$usuario->possui_rg = 'S';
    //}

    $usuario->cpf = $validated["cpf"];
    $usuario->rg_numero = $validated["rg_numero"];
    $usuario->rg_uf = $validated["rg_uf"];
    $usuario->genero_id = $validated["genero_id"];
    $usuario->data_nascimento = $validated["data_nascimento"];

    //Termo de adesão que vai para 
    $usuario->termo_adesao = $validated["termo_adesao"];

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
    $perfil->pilar_id = $validated["pilar_id"];
    $perfil->observacao = $validated["observacao"];
    $perfil->religiao_id = $validated["formacao_religiosa"];

    // verifica se o usuario possui um user associado para atualizar o id de usuario na tabela users tb
    $user = User::where('cpf', $usuario->cpf)->first();

    try {
      $usuario->save();
      $endereco->usuario_id = $usuario->id;
      $endereco->save();
      $perfil->usuario_id = $usuario->id;
      $perfil->save();
      if (!empty($user)) {
        $user->usuario_id = $usuario->id;
        $user->save();
      }

      if ($this->papelInativo()) {
        Auth::user()->removePapel('inabilitado');
        Auth::user()->adicionaPapel('Trabalhador');
      }

      Session::flash('tipo', 'success');
      Session::flash('mensagem', 'Cadastro realizado com Sucesso!');
    } catch (\Exception $e) {
      info($e);
      Session::flash('tipo', 'danger');
      Session::flash('mensagem', 'Ocorreu um erro ao salvar o novo usuário. Tente Novamente.');
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
    if ($id != Auth::user()->usuario_id) {
      if (Gate::denies('usuarios-view')) {
        abort(403, "Não autorizado!");
      }
    }

    try {
      $usuario = Usuario::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Usuário Não Encontrado!');
    }
    return view('admin.usuario.perfil', compact('usuario'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id usuario
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id)
  {
    try {
      $usuario = Usuario::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Usuário Não Encontrado!');
    }

    $bloquearEdicao = '';

    if ($this->papelInativo()) {
      $bloquearEdicao = 'readonly';
    }

    $user = User::where('usuario_id', $usuario->id)->get();

    if ($user->isEmpty()) {
      $assistido = true;
    } else {
      $assistido = false;
    }

    return view('admin.usuario.editar', compact('assistido', 'bloquearEdicao', 'usuario'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id usuario
   * @return \Illuminate\Http\Response
   */
  public function update(UsuarioSanitizedRequest $request, int $id)
  {
    // Esse vetor $validated possui todos os dados que foram validados pela classe UsuarioSanitizedRequest.
    $validated = $request->validated();
    // Se algum dado nao foi validado, nem chega aqui. O script encaminha de volta para o formulário
    // e informa o erro através da variável $errors (na view)
    // dd($validated);

    try {
      $usuario = Usuario::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Usuário Não Encontrado!');
    }

    $cpfAux = $usuario->cpf; // cpf antigo (caso o usuario altere)

    // Dados Pessoais
    $usuario->nome = $validated["nome"];
    $usuario->possui_cpf = $validated["possui_cpf"];
    $usuario->cpf = $validated["cpf"];
    $usuario->possui_rg = $validated["possui_rg"];
    $usuario->rg_numero = $validated["rg_numero"];
    $usuario->rg_uf = $validated["rg_uf"];
    $usuario->genero_id = $validated["genero_id"];
    $usuario->data_nascimento = $validated["data_nascimento"];
    $usuario->nascimento_uf = $validated["nascimento_uf"];
    $usuario->nascimento_municipio = $validated["nascimento_municipio"];

    // Endereço
    $usuario->endereco->endereco = $validated["endereco"];
    $usuario->endereco->numero = $validated["numero"];
    $usuario->endereco->complemento = $validated["complemento"];
    $usuario->endereco->cep = $validated["cep"];
    $usuario->endereco->bairro = $validated["bairro"];
    $usuario->endereco->municipio = $validated["municipio"];
    $usuario->endereco->uf = $validated["uf"];
    $usuario->endereco->pais = $validated["pais"];

    // Dados de Contato
    $usuario->telefone_residencial_ddd = $validated["telefone_residencial_ddd"];
    $usuario->telefone_residencial = $validated["telefone_residencial"];
    $usuario->telefone_celular_ddd = $validated["telefone_celular_ddd"];
    $usuario->telefone_celular = $validated["telefone_celular"];
    $usuario->email = $validated["email"];

    // Entrevista
    $usuario->perfil->motivo_id = $validated["motivo_id"];
    $usuario->perfil->data_inicio_nl = $validated["data_inicio_nl"];
    $usuario->perfil->pilar_id = $validated["pilar_id"];
    $usuario->perfil->observacao = $validated["observacao"];
    $usuario->perfil->religiao_id = $validated["formacao_religiosa"];

    // verifica se o usuario possui um user associado para atualiza na tabela users tb
    $user = User::where('cpf', $cpfAux)->first();

    try {
      $usuario->save();
      $usuario->endereco->save();
      $usuario->perfil->save();
      if (!empty($user)) {
        $user->cpf = $usuario->cpf;
        $user->name = $usuario->nome;
        $user->email = $usuario->email;
        $user->save();
      }
      Session::flash('tipo', 'success');
      Session::flash('mensagem', 'Cadastro Atualizado com Sucesso!');
    } catch (QueryException $e) {
      info($e);
      if ($e->errorInfo[1] == '1062') {
        Session::flash('tipo', 'danger');
        Session::flash('mensagem', 'Já existe um usuário com esse CPF! Verifique se está correto ou se já existe algum cadastro com esse cpf.');
      } else {
        Session::flash('tipo', 'danger');
        Session::flash('mensagem', 'Ocorreu um erro na atualização do Cadastro. Tente novamente!');
      }
      return redirect()->back()->withInput();
    }
    return redirect()->route('UsuarioShow', ['id' => $usuario->id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (Gate::denies('usuarios-delete')) {
      abort(403, "Não autorizado!");
    }

    try {
      $usuario = Usuario::findOrFail($id);
    } catch (ModelNotFoundException $exception) {
      abort(404, 'Usuário Não Encontrado!');
    }

    $usuario->endereco()->delete();
    $usuario->perfil()->delete();
    $usuario->delete();

    Session::flash('tipo', 'warning');
    Session::flash('mensagem', 'Usuário Excluído com Sucesso!');

    return redirect()->route('UsuarioIndex');
  }
}
