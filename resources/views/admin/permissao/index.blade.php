@extends('admin.layouts.principal')

@section('page-level-css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
<!-- Begin Page Content -->
<div class="container-fluid">
  <kbd>Lembrete: Adicionar um modal para deletar.</kbd>
  <br>
  <kbd>Lembrete: Incluir msg de sucesso.</kbd>
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lista de Permissões</h1>
    <a href="{{ route('permissoes.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Adicionar Nova Permissão</a>
  </div>
  <p class="mb-4">Permissões cadastradas no sistema.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Permissões</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>Id</th>
              <th>Nome</th>
              <th>Descrição</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($registros as $registro)
              <tr class="text-center">
                <td>{{ $registro->id }}</td>
                <td class="text-justify">{{ $registro->nome }}</td>
                <td>{{ $registro->descricao }}</td>
                <td>
                  <form method="POST" action="{{route('permissoes.destroy',$registro->id)}}">
                    {{-- @can('permissao-edit') --}}
                    <a title="Editar" class="btn btn-dark btn-sm" href="{{ route('permissoes.edit',$registro->id) }}"><i class="fas fa-edit"></i></a>
                    {{-- @endcan --}}
                    {{-- @can('permissao-delete') --}}
                      @method('DELETE')
                      @csrf
                      <button title="Deletar" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    {{-- @endcan --}}
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> {{-- table-responsive --}}
    </div> {{-- card-body --}}
  </div> {{-- card --}}
</div> {{-- container-fluid --}}
@endsection

@section('page-level-scripts')
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("#dataTable").DataTable({
            language: {
                url:
                    "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
            }
        });
    });
  </script>
@endsection