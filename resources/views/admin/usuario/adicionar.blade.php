@extends('admin.layouts.principal')

@section('conteudo')

    {{-- Comentar esse if quando estiver em produção --}}
    {{--@if ($errors->any())
        <div class="container-fluid">
            <div class="alert alert-danger">Verifique os erros no formulário <br> {{ dump($errors) }}</div>
        </div>
    @endif--}}

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cadastro de novo usuário (campos marcados com <span class="text-danger"><strong>*</strong></span> são obrigatórios)</h1>

        <form method="POST" action="{{ route('UsuarioStore') }}" id="formCadastroUsuario" novalidate>
        @csrf

        @include('admin.usuario._form')
        
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
            $('#data_inicio_nl').mask('00/0000');
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
            document.getElementById('data').value=("");
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
