@extends('admin.layouts.principal')

@section('conteudo')

@if ($errors->any())
    <div class="container-fluid">
        <div class="alert alert-danger">Verifique os erros no formulário <br> {{ dump($errors) }}</div>
    </div>
@endif

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cadastro de Novo Assistido</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Teste</a>
          </div>

          <div class="container">
            <div class="row justify-content-center">
                <form method="POST" action="{{ route('UsuarioStore') }}" id="formCadastroUsuario" novalidate>
                    @csrf
                    <div class="form-group text-center">
                        <label class="text-primary">Informações Pessoais</h4></label>
                    </div>

                    <div class="form-row">
                        {{-- cpf --}}
                        <div class="form-group col-md-2">
                            <label id="lbl_cpf" for="cpf">CPF <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" placeholder="CPF" data-mask="000.000.000-00" value="{{ old('cpf') }}" name="cpf">
                            <div class="invalid-feedback">
                            {{$errors->first('cpf')}}
                            </div>
                        </div>

                        {{-- nome --}}
                        <div class="form-group col-md-10">
                            <label for="nome">Nome Completo<span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" placeholder="Nome Completo" maxlength="60" value="{{ old('nome') }}" name="nome">
                            <div class="invalid-feedback">
                                {{$errors->first('nome')}}
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-row">
                        {{-- genero --}}
                        <div class="form-group col-md-5">
                            <label for="genero_id">Gênero <span class="text-danger"><strong>*</strong></span></label>
                            <select class="custom-select {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" name="genero_id">
                                <option selected value="">Selecione</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}" {{ old('genero_id') == "$genero->id" ? 'selected' : '' }}>{{ $genero->nome }}</option>                                    
                                @endforeach
                                {{-- <option value="F" {{ old('genero_id') == "F" ? 'selected' : '' }}>Feminino</option> --}}
                                {{-- <option value="M" {{ old('genero_id') == "M" ? 'selected' : '' }}>Masculino</option> --}}
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('genero_id')}}
                            </div>
                        </div>

                        {{-- data_nascimento --}}
                        <div class="form-group col-md-4">
                            <label for="data_nascimento">Data de Nascimento <span class="text-danger"><strong>*</strong></span></label>
                            <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" id="data_nascimento" placeholder="data_nascimento" name="data_nascimento" value="{{old('data_nascimento')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('data_nascimento')}}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group text-center">
                        <label class="text-primary"><h4>Endereço</h4></label>
                    </div>
                    <div class="form-row">
                        {{-- logradouro --}}
                        <div class="form-group col-md-8">
                            <label for="endereco">Endereço <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco" placeholder="Rua/Avenida ... " maxlength="60" value="{{ old('endereco') }}" name="endereco">
                            <div class="invalid-feedback">
                            {{$errors->first('endereco')}}
                            </div>
                        </div>

                        {{-- numero --}}
                        <div class="form-group col-md-1">
                            <label for="numero">Número <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero" placeholder="Número" maxlength="10" value="{{ old('numero') }}" name="numero">
                            <div class="invalid-feedback">
                            {{$errors->first('numero')}}
                            </div>
                        </div>

                        {{-- complemento --}}
                        <div class="form-group col-md-3">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" id="complemento" placeholder="Complemento" maxlength="40" value="{{ old('complemento') }}" name="complemento">
                            <div class="invalid-feedback">
                            {{$errors->first('complemento')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- cep --}}
                        <div class="form-group col-md-2">
                            <label for="cep">CEP <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep" placeholder="CEP" maxlength="10" value="{{ old('cep') }}" name="cep">
                            <div class="invalid-feedback">
                            {{$errors->first('cep')}}
                            </div>
                        </div>

                        {{-- bairro --}}
                        <div class="form-group col-md-3">
                            <label for="bairro">Bairro <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro" placeholder="Bairro" maxlength="60" value="{{ old('bairro') }}" name="bairro">
                            <div class="invalid-feedback">
                            {{$errors->first('bairro')}}
                            </div>
                        </div>

                        {{-- municipio --}}
                        <div class="form-group col-md-3">
                            <label for="municipio">Município <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" id="municipio" placeholder="Municipio" maxlength="60" value="{{ old('municipio') }}" name="municipio">
                            <div class="invalid-feedback">
                            {{$errors->first('municipio')}}
                            </div>
                        </div>

                        {{-- uf --}}
                        <div class="form-group col-md-2">
                            <label for="uf">UF <span class="text-danger"><strong>*</strong></span></label>
                            <select class="custom-select {{ $errors->has('uf') ? 'is-invalid' : '' }}" name="uf">
                                <option selected value="">Selecione</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->sigla }}" 
                                        {{ old('uf') == $estado->sigla ? 'selected' : '' }}
                                        >{{ $estado->sigla }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('uf')}}
                            </div>
                        </div>

                        {{-- pais --}}
                        <div class="form-group col-md-2">
                            <label for="pais">Pais <span class="text-danger"><strong>*</strong></span></label>
                            <select class="custom-select {{ $errors->has('pais') ? 'is-invalid' : '' }}" name="pais">
                                <option selected value="">Selecione</option>
                                @foreach($paises as $pais)
                                    <option value="{{ $pais->nome }}" 
                                        {{ (old('pais', 'Brasil') == $pais->nome) ? 'selected' : '' }}
                                        >{{ $pais->nome}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('pais')}}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group text-center">
                        <label class="text-primary"><h4>Informações para Contato</h4></label>
                    </div>

                    <div class="form-row">
                        {{-- telefone_residencial_ddd --}}
                        <div class="form-group col-md-1">
                            <label for="telefone_residencial_ddd">DDD</label>
                            <input type="text" class="form-control {{ $errors->has('telefone_residencial_ddd') ? 'is-invalid' : '' }}" id="telefone_residencial_ddd" placeholder="DDD" maxlength="2" name="telefone_residencial_ddd" value="{{old('telefone_residencial_ddd')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('telefone_residencial_ddd')}}
                            </div>
                        </div>

                        {{-- telefone_residencial --}}
                        <div class="form-group col-md-2">
                            <label for="telefone_residencial">Tel Residencial</label>
                            <input type="text" class="form-control {{ $errors->has('telefone_residencial') ? 'is-invalid' : '' }}" id="telefone_residencial" placeholder="Número" maxlength="60" data-mask="0000-0000" name="telefone_residencial" value="{{old('telefone_residencial')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('telefone_residencial')}}
                            </div>
                        </div>

                        <div class="form-group col-md-1">
                        </div>

                        {{-- telefone_celular_ddd --}}
                        <div class="form-group col-md-1">
                            <label for="telefone_celular_ddd">DDD <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('telefone_celular_ddd') ? 'is-invalid' : '' }}" id="DDD" placeholder="DDD" maxlength="2" name="telefone_celular_ddd" value="{{old('telefone_celular_ddd')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('telefone_celular_ddd')}}
                            </div>
                        </div>

                        {{-- telefone_celular --}}
                        <div class="form-group col-md-2">
                            <label for="telefone_celular">Tel Celular <span class="text-danger"><strong>*</strong></span></label>
                            <input type="text" class="form-control {{ $errors->has('telefone_celular') ? 'is-invalid' : '' }}" id="telefone_celular" placeholder="Número" maxlength="60" data-mask="00000-0000" name="telefone_celular" value="{{old('telefone_celular')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('telefone_celular')}}
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="whatsapp" name="whatsapp"
                                @if(old('whatsapp') == 'on') 
                                "checked"
                                @endif
                                >
                                <label class="custom-control-label" for="whatsapp"><strong>Celular com Whatsapp?</strong></label>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-row">
                        {{-- email --}}
                        <div class="form-group col-md-7">
                            <label for="email">Email <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="email" maxlength="60" value="{{ old('email') }}" name="email">
                            <div class="invalid-feedback">
                            {{$errors->first('email')}}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group text-center">
                        <label class="text-primary"><h4>Entrevista</h4></label>
                    </div>



                    <div class="form-group">
                        {{-- Motivos Para Vir ao Nosso lar --}}
                        <div class="form-group col-md-4">
                            <label for="motivo_id">O que o motivou a procurar o Nosso Lar?<span class="text-danger"><strong>*</strong></span></label>
                            <select class="custom-select {{ $errors->has('motivo_id') ? 'is-invalid' : '' }}" name="motivo_id">
                                <option selected value="">Selecione</option>
                                @foreach($motivos as $motivo)
                                <option value="{{ $motivo->id }}" 
                                    {{ (old('motivo_id') == $motivo->id) ? 'selected' : '' }}
                                    >{{ $motivo->nome}}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('motivo_id')}}
                            </div>
                        </div>
                            
                        {{-- data_inicio_nl --}}
                        <div class="form-group col-md-4">
                            <label for="data_inicio_nl">Data de Início no Nosso Lar <span class="text-danger"><strong>*</strong></span></label>
                            <input type="date" class="form-control {{ $errors->has('data_inicio_nl') ? 'is-invalid' : '' }}" id="data_inicio_nl" placeholder="data_inicio_nl" name="data_inicio_nl" value="{{old('data_inicio_nl')}}">
                            <div class="invalid-feedback">
                            {{$errors->first('data_inicio_nl')}}
                            </div>
                        </div>

                        {{-- Primeira Área --}}
                        {{-- SUGIRO QUE SEJA UM SELECT DEPOIS QUE OS PILARES ESTIVEREM DEFINIDOS  --}}
                        <div class="form-group col-md-4">
                            <label for="primeira_area_nl">Qual a 1a. área do Nosso Lar?</label>
                            <input type="text" class="form-control {{ $errors->has('primeira_area_nl') ? 'is-invalid' : '' }}" id="primeira_area_nl" placeholder="Primeira Área" maxlength="20" name="primeira_area_nl" value="{{ old('primeira_area_nl') }}">
                            <div class="invalid-feedback">
                                {{$errors->first('primeira_area_nl')}}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observacao">Observações <small>(preencher aqui caso o motivo a procurar o nosso lar seja outros)</small></label>
                            <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
          </div>
        @endsection