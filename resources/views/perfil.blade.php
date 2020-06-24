@extends('admin.layouts.principal')

@section('page-level-css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="jumbotron">
            <h1 class="display-5">Usuário <span class="text-primary">{{ $assistido->nome }}</span></h1>
            <p class="lead">Aqui você encontra informações do cadastro, contatos, perfil e foto.</p>
          </div>

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <kbd>Lembrete: Espaço para incluir um componente de breadcrumb </kbd>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-edit fa-sm text-white-50"></i> Editar</a>
          </div>

          <div class="row">
            <div class="col-md-4">
              <!-- Nav Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ $assistido->nome }}</h6>
                </div>
                <div class="card-body">
                  <div class="row py-3">
                    <div class="py-1">
                      @empty($assistido->perfil->foto_path)
                        <img src="{{ asset('img/logo.png') }}" alt="Foto de Cadastro Não Enviada" width="80%" class="mx-auto d-block">
                        <hr class="py-1">
                        <div class="text-center">
                          <p>Esse usuário ainda não enviou uma foto de perfil.</p>
                          <a class="btn btn-success" href="{{ route('FotoCreate', ['id' => $assistido->id]) }}">Enviar Foto de Perfil</a>
                        </div>
                        @else
                        <img src="{{ asset('storage')."/".$assistido->perfil->foto_path }}" alt="Foto de Cadastro" width="80%" class="mx-auto d-block">
                        <hr class="py-1">
                        <div class="text-center">
                          <a class="btn btn-primary" href="{{ route('FotoCreate', ['id' => $assistido->id]) }}">Alterar Foto</a>
                        </div>
                      @endif
                    </div> {{-- fecha coluna da foto --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <!-- Nav Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
                </div>
                <div class="card-body">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-infopessoais-tab" data-toggle="tab" href="#nav-infopessoais" role="tab" aria-controls="nav-infopessoais" aria-selected="true">Dados Pessoais</a>
                      <a class="nav-item nav-link" id="nav-infocontato-tab" data-toggle="tab" href="#nav-infocontato" role="tab" aria-controls="nav-infocontato" aria-selected="false">Contato</a>
                      <a class="nav-item nav-link" id="nav-infoendereco-tab" data-toggle="tab" href="#nav-infoendereco" role="tab" aria-controls="nav-infoendereco" aria-selected="false">Endereço</a>
                      <a class="nav-item nav-link" id="nav-infoperfil-tab" data-toggle="tab" href="#nav-infoperfil" role="tab" aria-controls="nav-infoperfil" aria-selected="false">Perfil</a>
                      {{--<a class="nav-item nav-link" id="nav-infohistorico-tab" data-toggle="tab" href="#nav-infohistorico" role="tab" aria-controls="nav-infohistorico" aria-selected="false">Histórico</a>--}}
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-infopessoais" role="tabpanel" aria-labelledby="nav-infopessoais-tab">
                      <div class="row py-3">
                          <div class="container">
                            <div class="form-group">
                                <div class="form-row">
                                    {{-- cpf --}}
                                    @if (!empty($assistido->cpf))
                                      <div class="form-group col-md-3">
                                          <label id="lbl_cpf" for="cpf"><small>CPF</small></label>
                                          <input type="text" class="form-control" id="cpf" data-mask="000.000.000-00" maxlength="14" value="{{ $assistido->cpf }}" name="cpf" readonly>
                                      </div>
                                    @endif
                                    {{-- nome --}}
                                    <div class="form-group col-md-9">
                                        <label for="nome"><small>Nome Completo</small></label>
                                        <input type="text" class="form-control text-capitalize" id="nome" maxlength="80" value="{{ $assistido->nome }}" name="nome" readonly>
                                    </div>
                                </div> {{-- fecha form-row --}}

                                <div class="form-row">
                                    {{-- genero --}}
                                    <div class="form-group col-md-6">
                                        <label for="genero"><small>Gênero</small></label>
                                        <input type="text" class="form-control" id="genero" maxlength="80" value="{{ $assistido->genero->nome }}" name="genero" readonly>
                                    </div>
                                    {{-- data_nascimento --}}
                                    @if (!empty($assistido->data_nascimento))
                                      <div class="form-group col-md-6">
                                          <label for="data_nascimento"><small>Data de Nascimento</small></label>
                                          <input type="text" class="form-control" id="data_nascimento" maxlength="80" value="{{ Carbon::parse($assistido->data_nascimento)->format('d/m/Y') }}" name="data_nascimento" readonly>
                                      </div>
                                    @endif
                                </div>  {{-- fecha form-row --}}
                            </div>  {{-- fecha form-group --}}
                          </div>  {{-- fecha container --}}
                      </div>
                    </div>
                    <div class="tab-pane fade" id="nav-infocontato" role="tabpanel" aria-labelledby="nav-infocontato-tab">
                      <div class="row py-3">
                        <div class="container">
                          <div class="form-group">
                            <div class="form-row">
                              {{-- telefone residencial --}}
                              @if (!empty($assistido->telefone_residencial))
                                <div class="form-group col-md-3">
                                  <label id="lbl_tel_residencial_ddd" for="telefone_residencial_ddd"><small>DDD</small></label>
                                  <input type="text" class="form-control" id="telefone_residencial_ddd" maxlength="2" value="{{ $assistido->telefone_residencial_ddd }}" name="telefone_residencial_ddd" readonly>
                                </div>
                                <div class="form-group col-md-9">
                                  <label id="lbl_tel_residencial" for="telefone_residencial"><small>Telefone Residencial</small></label>
                                  <input type="text" class="form-control" id="telefone_residencial" maxlength="2" value="{{ $assistido->telefone_residencial }}" name="telefone_residencial" readonly>
                                </div>
                              @endif
                            </div> {{--fecha form row--}}
                            <div class="form-row">
                              {{-- telefone celular --}}
                              @if (!empty($assistido->telefone_celular))
                                <div class="form-group col-md-3">
                                  <label id="lbl_tel_celular_ddd" for="telefone_celular_ddd"><small>DDD</small></label>
                                  <input type="text" class="form-control" id="telefone_celular_ddd" maxlength="2" value="{{ $assistido->telefone_celular_ddd }}" name="telefone_celular_ddd" readonly>
                                </div>
                                <div class="form-group col-md-9">
                                  <label id="lbl_tel_celular" for="telefone_celular"><small>Telefone Celular</small></label>
                                  <input type="text" class="form-control" id="telefone_celular" maxlength="2" value="{{ $assistido->telefone_celular }}" name="telefone_celular" readonly>
                                </div>
                              @endif
                            </div> {{--fecha form row--}}
                            <div class="form-row">
                              {{-- email --}}
                              @if (!empty($assistido->email))
                                <div class="form-group col-md-12">
                                  <label id="lbl_email" for="email"><small>Email</small></label>
                                  <input type="text" class="form-control" id="email" value="{{ $assistido->email }}" name="email" readonly>
                                </div>
                              @endif
                            </div>  {{-- fecha form-row --}}
                          </div>  {{-- fecha form-group --}}
                        </div>  {{-- fecha container --}}
                      </div>
                    </div>
                    <div class="tab-pane fade" id="nav-infoendereco" role="tabpanel" aria-labelledby="nav-infoendereco-tab">
                      <div class="row py-3">
                        <div class="container">
                          <div class="form-group">
                            @if(!empty($assistido->endereco->endereco && $assistido->endereco->bairro && $assistido->endereco->municipio && $assistido->endereco->uf && $assistido->endereco->pais && $assistido->endereco->cep ))
                            {{dd($assistido->endereco)}}
                              <div class="form-row">
                                {{--Endereço--}}
                                @if (!empty($assistido->endereco->endereco))
                                  <div class="form-group col-md-9">
                                    <label id="lbl_endereco" for="endereco"><small>Endereço</small></label>
                                    <input type="text" class="form-control" id="endereco" value="{{ $assistido->endereco->endereco}}" name="endereco" readonly>
                                  </div>
                                  {{--Numero--}}
                                  <div class="form-group col-md-3">
                                    <label id="lbl_numero" for="numero"><small>Número</small></label>
                                    <input type="text" class="form-control" id="numero" value="{{ $assistido->endereco->numero}}" name="numero" readonly>
                                  </div>
                                @endif
                              </div> {{--fecha form row--}}
                              <div class="form-row">
                                {{--complemento--}}
                                @if (!empty($assistido->endereco->complemento))
                                  <div class="form-group col-md-6">
                                    <label id="lbl_complemento" for="complemento"><small>Complemento</small></label>
                                    <input type="text" class="form-control" id="complemento" value="{{ $assistido->endereco->complemento}}" name="complemento" readonly>
                                  </div>
                                @endif
                                {{--cep--}}
                                @if (!empty($assistido->endereco->cep))
                                  <div class="form-group col-md-6">
                                    <label id="lbl_cep" for="cep"><small>Cep</small></label>
                                    <input type="text" class="form-control" id="cep" value="{{ $assistido->endereco->cep}}" name="cep" readonly>
                                  </div>
                                @endif
                              </div> {{--fecha form row--}}
                              {{--forçar quebra--}}
                              {{-- <div class="w-100"></div> --}}
                              <div class="form-row">
                                {{--municipio--}}
                                @if (!empty($assistido->endereco->municipio))
                                  <div class="form-group col-md-5">
                                    <label id="lbl_municipio" for="municipio"><small>Município</small></label>
                                    <input type="text" class="form-control" id="municipio" value="{{ $assistido->endereco->municipio}}" name="municipio" readonly>
                                  </div>
                                @endif
                                {{--uf--}}
                                @if (!empty($assistido->endereco->uf))
                                  <div class="form-group col-md-3">
                                    <label id="lbl_uf" for="uf"><small>Estado</small></label>
                                    <input type="text" class="form-control" id="uf" value="{{ $assistido->endereco->uf}}" name="uf" readonly>
                                  </div>
                                @endif
                                {{--pais--}}
                                @if (!empty($assistido->endereco->pais))
                                  <div class="form-group col-md-4">
                                    <label id="lbl_pais" for="pais"><small>País</small></label>
                                    <input type="text" class="form-control" id="pais" value="{{ $assistido->endereco->pais}}" name="pais" readonly>
                                  </div>
                                @endif
                              </div>  {{-- fecha form-row --}}
                            @else
                              <p><h4>Não há informações cadastradas.</h4></p>
                            @endif
                          </div>  {{-- fecha form-group --}}
                        </div>  {{-- fecha container --}}
                      </div>
                    </div>
                    <div class="tab-pane fade" id="nav-infoperfil" role="tabpanel" aria-labelledby="nav-infoperfil-tab">
                      <div class="row py-3">
                        <div class="container">
                          <div class="form-group">
                            <div class="form-row">
                              {{-- data de inicio --}}
                              @if (!empty($assistido->perfil->data_inicio_nl))
                                <div class="form-group col-md-6">
                                    <label id="lbl_data_inicio_nl" for="data_inicio_nl"><small>Data de Início</small></label>
                                    <input type="text" class="form-control" id="data_inicio_nl" value="{{ $assistido->perfil->data_inicio_nl }}" name="data_inicio_nl" readonly>
                                </div>
                              @endif
                            </div>
                            <div class = "form-row">
                              {{-- motivo --}}
                              <div class="form-group col-md-12">
                                <label for="motivo"><small>Motivo para procura do Nosso Lar</small></label>
                                <input type="text" class="form-control" id="motivo" value="{{ $assistido->perfil->motivo->nome }}" name="motivo" readonly>
                              </div>
                            </div> {{-- fecha form-row --}}
                            <div class="form-row">
                              {{-- Pilar --}}
                              <div class="form-group col-md-12">
                                <label for="pilar"><small>Primeiro Pilar</small></label>
                                <input type="text" class="form-control text-capitalize" id="pilar" value="{{ $assistido->perfil->pilar->nome }}" name="pilar" readonly>
                              </div> 
                            </div>  {{-- fecha form-row --}}
                            <div class="form-row">
                              {{-- Observacao --}}
                              @if (!empty($assistido->perfil->observacao))
                                <div class="form-group col-md-12">
                                  <label for="observacao"><small>Observação</small></label>
                                  <input type="text" class="form-control text-capitalize" id="observacao" value="{{ $assistido->perfil->observacao }}" name="observacao" readonly>
                                </div> 
                              @endif
                            </div>  {{-- fecha form-row --}}
                          </div>  {{-- fecha form-group --}}
                        </div>  {{-- fecha container --}}
                      </div>  
                    </div>
                    {{--<div class="tab-pane fade" id="nav-infohistorico" role="tabpanel" aria-labelledby="nav-infohistorico-tab">Historico</div>--}}
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
@endsection

@section('page-level-scripts')
  
<!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
  @endsection