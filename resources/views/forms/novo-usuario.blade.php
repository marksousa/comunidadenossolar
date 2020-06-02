@extends('admin.layouts.principal')

@section('conteudo')

    {{-- Comentar esse if quando estiver em produção --}}
    @if ($errors->any())
        <div class="container-fluid">
            <div class="alert alert-danger">Verifique os erros no formulário <br> {{ dump($errors) }}</div>
        </div>
    @endif

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cadastro de novo usuário</h1>
        <p class="mb-4">Informações</p>

        <form method="POST" action="{{ route('UsuarioStore') }}" id="formCadastroUsuario" novalidate>
        @csrf

            <!-- Informações Pessoais -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <div class="form-row">
                                {{-- cpf --}}
                                <div class="form-group col-md-2">
                                    <label id="lbl_cpf" for="cpf">CPF</label>
                                    <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" maxlength="14" value="{{ old('cpf') }}" name="cpf">
                                    <div class="invalid-feedback">
                                        {{$errors->first('cpf')}}
                                    </div>
                                </div>

                                {{-- nome --}}
                                <div class="form-group col-md-10">
                                    <label for="nome">Nome Completo<span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome') }}" name="nome">
                                    <div class="invalid-feedback">
                                        {{$errors->first('nome')}}
                                    </div>
                                </div>
                            </div> {{-- fecha form-row --}}

                            <div class="form-row">
                                {{-- genero --}}
                                <div class="form-group col-md-5">
                                    <label for="genero_id">Gênero</label>
                                    <select class="custom-select {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" name="genero_id">
                                        <option selected value="">Selecione</option>
                                        @foreach ($generos as $genero)
                                            <option value="{{ $genero->id }}" {{ old('genero_id') == "$genero->id" ? 'selected' : '' }}>{{ $genero->nome }}</option>                                    
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{$errors->first('genero_id')}}
                                    </div>
                                </div>

                                {{-- data_nascimento --}}
                                <div class="form-group col-md-4">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" id="data_nascimento"  name="data_nascimento" value="{{old('data_nascimento')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('data_nascimento')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}
                        </div>  {{-- fecha form-group --}}
                    </div>  {{-- fecha container --}}
                </div>{{-- fecha card-body --}}
            </div>{{-- fecha card --}}

            <!-- Endereço -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Endereço (Preencha o CEP, número e complemento se necessário. As outras informações serão completadas automaticamente)</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <div class="form-row">
                                {{-- cep --}}
                                <div class="form-group col-md-2">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep" maxlength="9" value="{{ old('cep') }}" name="cep" onblur="pesquisacep(this.value);">
                                    <div class="invalid-feedback">
                                        {{$errors->first('cep')}}
                                    </div>
                                </div>

                                {{-- bairro --}}
                                <div class="form-group col-md-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro" maxlength="60" value="{{ old('bairro') }}" name="bairro">
                                    <div class="invalid-feedback">
                                        {{$errors->first('bairro')}}
                                    </div>
                                </div>

                                {{-- municipio --}}
                                <div class="form-group col-md-3">
                                    <label for="municipio">Município</label>
                                    <input type="text" class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" id="municipio" maxlength="60" value="{{ old('municipio') }}" name="municipio">
                                    <div class="invalid-feedback">
                                        {{$errors->first('municipio')}}
                                    </div>
                                </div>

                                {{-- uf --}}
                                <div class="form-group col-md-2">
                                    <label for="uf">Estado</label>
                                    <select class="custom-select {{ $errors->has('uf') ? 'is-invalid' : '' }}" name="uf" id="uf">
                                        <option selected value="">Selecione</option>
                                        @foreach($estados as $estado)
                                            <option value="{{ $estado->sigla }}" 
                                                {{ old('uf') == $estado->sigla ? 'selected' : '' }}>{{ $estado->sigla }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{$errors->first('uf')}}
                                    </div>
                                </div>

                                {{-- pais --}}
                                <div class="form-group col-md-2">
                                    <label for="pais">Pais</label>
                                    <select class="custom-select {{ $errors->has('pais') ? 'is-invalid' : '' }}" name="pais" id="pais">
                                        <option selected value="">Selecione</option>
                                        @foreach($paises as $pais)
                                            <option value="{{ $pais->nome }}" 
                                                {{ (old('pais', 'Brasil') == $pais->nome) ? 'selected' : '' }}>{{ $pais->nome}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{$errors->first('pais')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}
                            <div class="form-row">
                                {{-- logradouro --}}
                                <div class="form-group col-md-8">
                                    <label for="endereco">Endereço (Rua, Avenida, etc.)</label>
                                    <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco" maxlength="60" value="{{ old('endereco') }}" name="endereco">
                                    <div class="invalid-feedback">
                                        {{$errors->first('endereco')}}
                                    </div>
                                </div>

                                {{-- numero --}}
                                <div class="form-group col-md-1">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero" maxlength="10" value="{{ old('numero') }}" name="numero">
                                    <div class="invalid-feedback">
                                        {{$errors->first('numero')}}
                                    </div>
                                </div>

                                {{-- complemento --}}
                                <div class="form-group col-md-3">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" id="complemento" maxlength="40" value="{{ old('complemento') }}" name="complemento">
                                    <div class="invalid-feedback">
                                        {{$errors->first('complemento')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}
                        </div>  {{-- fecha form-group --}}
                    </div>  {{-- fecha container --}}
                </div>{{-- fecha card-body --}}
            </div>{{-- fecha card --}}

            <!-- Contato -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contato (Se não possuir telefone celular, coloque o número de um parente ou vizinho)</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <div class="form-row">
                                {{-- telefone_celular_ddd --}}
                                <div class="form-group col-md-1">
                                    <label for="telefone_celular_ddd">DDD <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control {{ $errors->has('telefone_celular_ddd') ? 'is-invalid' : '' }}" id="DDD" maxlength="2" name="telefone_celular_ddd" value="{{old('telefone_celular_ddd')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('telefone_celular_ddd')}}
                                    </div>
                                </div>

                                {{-- telefone_celular --}}
                                <div class="form-group col-md-2">
                                    <label for="telefone_celular">Telefone Celular <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control {{ $errors->has('telefone_celular') ? 'is-invalid' : '' }}" id="telefone_celular" maxlength="10" name="telefone_celular" value="{{old('telefone_celular')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('telefone_celular')}}
                                    </div>
                                </div>
                            </div>
                                <?php
                                /*
                                {{-- whatsapp --}}
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
                                */
                                ?>
                            <div class="form-row">
                                {{-- telefone_residencial_ddd --}}
                                <div class="form-group col-md-1">
                                    <label for="telefone_residencial_ddd">DDD</label>
                                    <input type="text" class="form-control {{ $errors->has('telefone_residencial_ddd') ? 'is-invalid' : '' }}" id="telefone_residencial_ddd" maxlength="2" name="telefone_residencial_ddd" value="{{old('telefone_residencial_ddd')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('telefone_residencial_ddd')}}
                                    </div>
                                </div>

                                {{-- telefone_residencial --}}
                                <div class="form-group col-md-2">
                                    <label for="telefone_residencial">Telefone Residencial</label>
                                    <input type="text" class="form-control {{ $errors->has('telefone_residencial') ? 'is-invalid' : '' }}" id="telefone_residencial" maxlength="9" name="telefone_residencial" value="{{old('telefone_residencial')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('telefone_residencial')}}
                                    </div>
                                </div>

                            </div>  {{-- fecha form-row --}}
                                
                            <div class="form-row">
                                {{-- email --}}
                                <div class="form-group col-md-7">
                                    <label for="email">Email <span class="text-danger"></span></label>
                                    <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" maxlength="60" value="{{ old('email') }}" name="email">
                                    <div class="invalid-feedback">
                                        {{$errors->first('email')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}
                        </div>  {{-- fecha form-group --}}
                    </div>  {{-- fecha container --}}
                </div>{{-- fecha card-body --}}
            </div>{{-- fecha card --}}

            <!-- Entrevista -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Entrevista</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <div class="form-row">
                                {{-- Motivos Para Vir ao Nosso lar --}}
                                <div class="form-group col-md-4">
                                    <label for="motivo_id">O que o motivou a procurar o Nosso Lar?<span class="text-danger"><strong>*</strong></span></label>
                                    <select class="custom-select {{ $errors->has('motivo_id') ? 'is-invalid' : '' }}" name="motivo_id">
                                        <option selected value="">Selecione</option>
                                        @foreach($motivos as $motivo)
                                        <option value="{{ $motivo->id }}" 
                                            {{ (old('motivo_id') == $motivo->id) ? 'selected' : '' }}>{{ $motivo->nome}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{$errors->first('motivo_id')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}

                            <div class="form-row">
                                {{-- data_inicio_nl --}}
                                <div class="form-group col-md-4">
                                    <label for="data_inicio_nl">Data de Início no Nosso Lar <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control {{ $errors->has('data_inicio_nl') ? 'is-invalid' : '' }}" id="data_inicio_nl" placeholder="data_inicio_nl" name="data_inicio_nl" value="{{old('data_inicio_nl')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('data_inicio_nl')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}

                            <div class="form-row">
                                {{-- Primeira Área --}}
                                {{-- SUGIRO QUE SEJA UM SELECT DEPOIS QUE OS PILARES ESTIVEREM DEFINIDOS  --}}
                                <div class="form-group col-md-4">
                                    <label for="primeira_area_nl">Qual a 1a. área do Nosso Lar?</label>
                                    <input type="text" class="form-control {{ $errors->has('primeira_area_nl') ? 'is-invalid' : '' }}" id="primeira_area_nl" placeholder="Primeira Área" maxlength="20" name="primeira_area_nl" value="{{ old('primeira_area_nl') }}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('primeira_area_nl')}}
                                    </div>
                                </div>
                            </div>  {{-- fecha form-row --}}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="observacao">Observações <small>(preencher aqui caso o motivo a procurar o nosso lar seja outros)</small></label>
                                    <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}</textarea>
                                </div>
                            </div>  {{-- fecha form-row --}}
                        </div>  {{-- fecha form-group --}}
                    </div>  {{-- fecha container --}}
                </div>{{-- fecha card-body --}}
            </div>{{-- fecha card --}}

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        
        </form>
    </div> {{-- fecha container-fluid (End Page Content)--}}
@endsection


@section('page-level-scripts')
    <!-- JavaScript para Mask Input -->
    <script src="{{asset('vendor/jquery-mask/jquery.mask.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
            $('#cep').mask('00000-000');
            $('#telefone_celular').mask('00000-0000');
            $('#telefone_residencial').mask('0000-0000');
        });
    </script>

     <!-- Javascript para buscar os dados do endereço após preencher o CEP -->
    <script type="text/javascript" >
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('municipio').value=("");
            document.getElementById('uf').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('endereco').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
                document.getElementById('municipio').value=(conteudo.localidade);
                document.getElementById('uf').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('endereco').value="...";
                    document.getElementById('bairro').value="...";
                    document.getElementById('municipio').value="...";
                    document.getElementById('uf').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
@endsection
