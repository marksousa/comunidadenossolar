@extends('admin.layouts.principal')

@section('page-level-css')
@endsection

@section('conteudo')
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Prontuário Médico de {{ $usuario->nome }}</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Teste</a>
    </div>

    <div class="row">
      <div class="col-md-8">
        <!-- Nav Example -->
        <div class="card h-100 shadow mb-4">
          <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-success">Prontuário do Paciente {{ $usuario->nome }}</h6>
          </div>
          <div class="card-body">
              <div class="container">
                  <div class="form-group">
                      <div class="form-row">
                          {{-- cpf --}}
                          <div class="form-group col-md-2">
                              <label id="lbl_cpf" for="cpf">CPF</label>
                              <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" maxlength="14" value="{{ old('cpf', $usuario->cpf ?? '') }}" name="cpf" {{ $bloquearEdicao ?? '' }} >
                              <div class="invalid-feedback">
                                  {{$errors->first('cpf')}}
                              </div>
                          </div>

                          {{-- nome --}}
                          <div class="form-group col-md-10">
                              <label for="nome">Nome Completo <span class="text-danger"><strong>*</strong></span></label>
                              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome', $usuario->nome ?? '') }}" name="nome" required {{ $bloquearEdicao ?? '' }}>
                              <div class="invalid-feedback">
                                  {{$errors->first('nome')}}
                              </div>
                          </div>
                      </div> {{-- fecha form-row --}}

                      <div class="form-row">
                          {{-- genero --}}
                          @inject('generos', 'App\Genero')
                          <div class="form-group col-md-5">
                              <label for="genero_id">Gênero <span class="text-danger"><strong>*</strong></span></label>
                              <select class="custom-select {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" name="genero_id" required>
                                  <option selected value="">Selecione</option>
                                  @foreach ($generos->all() as $genero)
                                      <option value="{{ $genero->id }}" 
                                        @if(old('genero_id', $usuario->genero_id) == $genero->id)
                                          selected
                                        @endif>
                                        {{ $genero->nome }}
                                      </option>                                    
                                  @endforeach
                              </select>
                              <div class="invalid-feedback">
                                  {{$errors->first('genero_id')}}
                              </div>
                          </div>

                          {{-- data_nascimento --}}
                          <div class="form-group col-md-4">
                              <label for="data_nascimento">Data de Nascimento</label>
                              <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" id="data_nascimento"  name="data_nascimento" value="{{old('data_nascimento', $usuario->data_nascimento ?? '')}}">
                              <div class="invalid-feedback">
                                  {{$errors->first('data_nascimento')}}
                              </div>
                          </div>
                      </div>  {{-- fecha form-row --}}
                  </div>  {{-- fecha form-group --}}
              </div>  {{-- fecha container --}}
          </div>{{-- fecha card-body --}}
        </div>
      </div>
      <div class="col-md-4">
        <!-- Nav Example -->
        <div class="card h-100 shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $usuario->nome }}</h6>
          </div>
          <div class="card-body">
            <div class="row py-3">
              <div class="py-1">
                @empty($usuario->perfil->foto_path)
                  <img src="{{ asset('img/logo.png') }}" alt="Foto de Cadastro Não Enviada" width="80%" class="mx-auto d-block">
                  <hr class="py-1">
                  <div class="text-center">
                    <p>Esse usuário ainda não enviou uma foto de perfil.</p>
                    <a class="btn btn-success" href="{{ route('FotoCreate', ['id' => $usuario->id]) }}">Enviar Foto de Perfil</a>
                  </div>
                  @else
                  <img src="{{ asset('storage')."/".$usuario->perfil->foto_path }}" alt="Foto de Cadastro" width="80%" class="mx-auto d-block">
                @endif
              </div> {{-- fecha coluna da foto --}}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('page-level-scripts')
@endsection