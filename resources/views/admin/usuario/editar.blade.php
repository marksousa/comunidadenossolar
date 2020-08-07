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
  <h1 class="h3 mb-2 text-gray-800">Edição das Informações do Usuário (campos marcados com <span class="text-danger"><strong>*</strong></span> são obrigatórios)</h1>
  <h3>{{ $usuario->nome }}</h3>

  <form method="POST" action="{{ route('UsuarioUpdate',$usuario->id) }}" id="formEdicaoUsuario" novalidate>
    @csrf
    @method('PUT')

    @if($assistido)
    @include('admin.usuario._form_assistido')
    <input type="hidden" name="assistido" value="1">
    @else
    @include('admin.usuario._form')
    <input type="hidden" name="assistido" value="0">
    @endif

    <div class="form-group text-center">
      <button type="submit" class="btn btn-info">Atualizar</button>
    </div>

  </form>
</div> {{-- fecha container-fluid (End Page Content)--}}
@endsection