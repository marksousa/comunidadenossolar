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


