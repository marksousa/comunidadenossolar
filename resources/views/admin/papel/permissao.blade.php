@extends('admin.layouts.principal')

@section('page-level-css')
@endsection

@section('conteudo')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lista de Permissões para o papel de {{ $papel->nome }}</h1>
    <a href="{{ route('papeis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-circle-left fa-sm text-white-50"></i> Voltar</a>
  </div>
  <p class="mb-4">Permissões atribuídas ao papel de {{ $papel->nome }}</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Papéis</h6>
    </div>
    <div class="card-body">
      <div class="text-center">
        <form action="{{ route('PapelPermissaoStore',$papel->id) }}" method="post">
        @csrf
        <div class="form-group col-md-12">
          <select name="permissao_id" class="custom-select">
            @foreach($permissoes as $permissao)
            <option value="{{ $permissao->id }}">{{ $permissao->nome }} -> {{ $permissao->descricao }}</option>
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
      <h6 class="m-0 font-weight-bold text-primary">Lista de Permissões do Papel {{ $papel->nome }}</h6>
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
            @foreach($papel->permissoes as $permissao)
              <tr class="text-center">
                <td class="text-justify">{{ $permissao->nome }}</td>
                <td>{{ $permissao->descricao }}</td>
                <td>
                  <form method="POST" action="{{route('PapelPermissaoDestroy',[$papel->id,$permissao->id])}}">
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
  <div class="text-center py-3">
    <a href="{{ route('papeis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-circle-left fa-sm text-white-50"></i> Voltar</a>
  </div>
</div> {{-- container-fluid --}}
@endsection

@section('page-level-scripts')
@endsection