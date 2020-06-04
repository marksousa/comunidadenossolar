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
    <h1 class="h3 mb-2 text-gray-800">Editar Papel - {{ $registro->nome }}</h1>
    <p class="mb-4">Formulário para editar o papel no sistema.</p>

    <form method="POST" action="{{ route('papeis.update',$registro->id) }}" id="formEditarPapel" novalidate>
      @csrf
      @method('PUT')

      @include('admin.papel._form')

      <div class="form-group text-center">
          <button type="submit" class="btn btn-info">Atualizar</button>
      </div>

    </form>
  </div> {{-- fecha container-fluid (End Page Content)--}}
@endsection


@section('page-level-scripts')
@endsection
