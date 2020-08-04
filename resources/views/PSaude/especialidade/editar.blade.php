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
  <h1 class="h3 mb-2 text-gray-800">Editar Especialidade - {{ $registro->nome }}</h1>
  <p class="mb-4">Formulário para editar as especialidades para consultas e cadastro de médicos.</p>

  <form method="POST" action="{{ route('especialidades.update',$registro->id) }}" id="formEditarEspecialidade" novalidate>
    @csrf
    @method('PUT')

    @include('PSaude.especialidade._form')

    <div class="form-group text-center">
      <button type="submit" class="btn btn-info">Atualizar</button>
    </div>

  </form>
</div> {{-- fecha container-fluid (End Page Content)--}}
@endsection


@section('page-level-scripts')
@endsection