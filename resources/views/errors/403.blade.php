@extends('admin.layouts.principal')

@section('page-level-css')
@endsection

@section('conteudo')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- 403 Error Text -->
  <div class="text-center">
    <div class="error mx-auto" data-text="403">403</div>
    <p class="lead text-gray-800 mb-5">{{ $exception->getMessage()}}</p>
    <p class="text-gray-500 mb-0">Recurso Não Autorizado!</p>
    <a href="{{ route('admin-home') }}">&larr; Voltar para a Home</a>
  </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('page-level-scripts')
@endsection