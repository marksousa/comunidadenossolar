@extends('admin.layouts.principal')

@section('page-level-css')
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
    <h1 class="h3 mb-0 text-gray-800">Lista de Consultórios</h1>
    <a href="{{ route('consultorios.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      Adicionar Novo Consultório
    </a>
  </div>
  <p class="mb-4">Consultórios cadastrados no sistema.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Consultórios</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>Id</th>
              <th>Nome</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($registros as $registro)
            <tr class="text-center">
              <td>{{ $registro->id }}</td>
              <td class="text-justify">{{ $registro->nome }}</td>
              <td>
                <form action="{{route('consultorios.destroy',$registro->id)}}" method="post">
                  {{-- @can('papel-edit') --}}
                  <a title="Editar" class="btn btn-warning btn-sm" href="{{ route('consultorios.edit', $registro->id) }}"><i class="fas fa-edit"></i></a>
                  {{-- @endcan --}}
                  {{-- @can('papel-delete') --}}
                  <a title="Deletar" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalApagarConsultorio{{ $registro->id }}"><i class="fas fa-trash-alt"></i></a>

                  <!-- Modal -->
                  <div class="modal fade" id="modalApagarConsultorio{{ $registro->id }}" tabindex="-1" role="dialog" aria-labelledby="modalApagarConsultorio{{ $registro->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalApagarConsultorio{{ $registro->id }}Label">Tem certeza que deseja apagar a especialidade <strong>{{ $registro->nome }}</strong>?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          O Consultório <strong>{{ $registro->nome }}</strong> será apagado. Essa ação não pode ser desfeita.
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
@endsection