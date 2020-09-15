@extends('admin.layouts.principal')

@section('conteudo')

{{-- Comentar esse if quando estiver em produção --}}
{{--@if ($errors->any())
<div class="container-fluid">
  <div class="alert alert-danger">Verifique os erros no formulário <br> {{ dump($errors) }}</div>
</div>
@endif
--}}
<!-- Begin Page Content -->
<div class="container-fluid">
  @if(Session::has('mensagem'))
  @component('components.alerta', ['tipo' => Session::get('tipo', 'info'), 'mensagem' => Session::get('mensagem')])
  @endcomponent
  @endif
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Cadastro de novo voluntário (campos marcados com <span class="text-danger"><strong>*</strong></span> são obrigatórios)</h1>
  <h1 class="h4 mb-2 text-gray-800 text-justify">Garantindo o respeito à privacidade, seus dados serão armazenados em nosso banco de dados e você poderá alterá-los pelo sistema quando desejar.</h1>

  <form method="POST" action="{{ route('UsuarioStore') }}" id="formCadastroUsuario" novalidate>
    @csrf

    @if($assistido)
    @include('admin.usuario._form_assistido')
    <input type="hidden" name="assistido" value="1">
    @else
    @include('admin.usuario._form')
    <input type="hidden" name="assistido" value="0">
    @endif

    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

  </form>
</div> {{-- fecha container-fluid (End Page Content)--}}
@endsection