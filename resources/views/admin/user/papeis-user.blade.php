@extends('admin.layouts.principal')

@section('page-level-css')
@endsection

@section('conteudo')
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Lista de Papéis para {{ $user->name }}</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Teste</a>
    </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Papéis para {{ $user->name }}</h6>
    </div>
    <div class="card-body">
      <div class="text-center">
        <form method="POST" action="{{ route('UserPapelStore',$user->id) }}">
        @csrf
        <div class="form-group col-md-12">
          <select name="papel_id" class="custom-select">
            @foreach($papeis as $papel)
            <option value="{{ $papel->id }}">{{ $papel->nome }} -> {{ $papel->descricao }}</option>
            @endforeach
          </select>
        </div>
        <button class="btn btn-primary btn-sm">Adicionar</button>
        </form>
      </div>
    </div> {{-- card-body --}}
  </div> {{-- card --}}

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Papéis do User {{ $user->name }}</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>Permissão</th>
              <th>Descrição</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user->papeis as $papel)
              <tr class="text-center">
                <td class="text-justify">{{ $papel->nome }}</td>
                <td>{{ $papel->descricao }}</td>
                <td>
                  <form method="POST" action="{{route('UserPapelDestroy',[$user->id,$papel->id])}}">
                    @method('DELETE')
                    @csrf
                    <button title="Deletar" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> {{-- table-responsive --}}
    </div> {{-- card-body --}}
  </div> {{-- card --}}

  {{-- Botão Voltar --}}
  <div class="text-center py-3">
    <a href="{{ route('papeis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-circle-left fa-sm text-white-50"></i> Voltar</a>
  </div>
@endsection

@section('page-level-scripts')
@endsection