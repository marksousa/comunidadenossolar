@extends('admin.layouts.principal')

@section('page-level-css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
<!-- Begin Page Content -->
<div class="container-fluid">

  @if(Session::has('mensagem'))
    @component('components.alerta', ['tipo' => Session::get('tipo', 'info'), 'mensagem' => Session::get('mensagem')])
    @endcomponent
  @endif
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

                      <a title="deletar" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalApagarPermissao{{ $registro->id }}"><i class="fas fa-trash-alt"></i></a>

                      <!-- Modal -->
                      <div class="modal fade" id="modalApagarPermissao{{ $registro->id }}" tabindex="-1" role="dialog" aria-labelledby="modalApagarPermissao{{ $registro->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalApagarPermissao{{ $registro->id }}Label">Tem certeza que deseja apagar a permissão <strong>{{ $registro->nome }}</strong>?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              A Permissão <strong>{{ $registro->nome }}</strong> ({{ $registro->descricao }}) será apagada. Essa ação não pode ser desfeita.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                              @method('DELETE')
                              @csrf
                              <button title="Deletar" class="btn btn-danger">Sim, Apagar</button>
                            </div>
                          </div>
                        </div>
                      </div>

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