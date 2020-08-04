@extends('admin.layouts.principal')

@section('conteudo')

{{-- Comentar esse if quando estiver em produção --}}
{{--@if ($errors->any())
      <div class="container-fluid">
          <div class="alert alert-danger">Verifique os erros no formulário <br> {{ dump($errors) }}</div>
</div>
@endif --}}

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Cadastro de Especialidades</h1>
  <p class="mb-4">Formulário para incluir as diferentes especialidades para consultas e cadastro de médicos.</p>

  <form method="POST" action="{{ route('especialidades.store') }}" id="formCadastroEspecialidades" novalidate>
    @csrf

    @include('PSaude.especialidade._form')

    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

  </form>
</div> {{-- fecha container-fluid (End Page Content)--}}
@endsection


@section('page-level-scripts')
@endsection