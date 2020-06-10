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
                      <a class="nav-item nav-link" id="nav-infohistorico-tab" data-toggle="tab" href="#nav-infohistorico" role="tab" aria-controls="nav-infohistorico" aria-selected="false">Histórico</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-infopessoais" role="tabpanel" aria-labelledby="nav-infopessoais-tab">
                      <div class="row py-3">
                          <div class="container">
                            <div class="form-group">
                                <div class="form-row">
                                    {{-- cpf --}}
                                    <div class="form-group col-md-3">
                                        <label id="lbl_cpf" for="cpf"><small>CPF</small></label>
                                        <input type="text" class="form-control" id="cpf" data-mask="000.000.000-00" maxlength="14" value="{{ $assistido->cpf }}" name="cpf" readonly>
                                    </div>

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
                                    <div class="form-group col-md-6">
                                        <label for="data_nascimento"><small>Data de Nascimento</small></label>
                                        <input type="text" class="form-control" id="data_nascimento" maxlength="80" value="{{ Carbon::parse($assistido->data_nascimento)->format('d/m/Y') }}" name="data_nascimento" readonly>
                                    </div>
                                </div>  {{-- fecha form-row --}}
                            </div>  {{-- fecha form-group --}}
                          </div>  {{-- fecha container --}}
                      </div>
                    </div>
                    <div class="tab-pane fade" id="nav-infocontato" role="tabpanel" aria-labelledby="nav-infocontato-tab">Contato</div>
                    <div class="tab-pane fade" id="nav-infoendereco" role="tabpanel" aria-labelledby="nav-infoendereco-tab">Endereço</div>
                    <div class="tab-pane fade" id="nav-infoperfil" role="tabpanel" aria-labelledby="nav-infoperfil-tab">Perfil</div>
                    <div class="tab-pane fade" id="nav-infohistorico" role="tabpanel" aria-labelledby="nav-infohistorico-tab">Historico</div>
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