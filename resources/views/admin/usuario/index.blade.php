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
  <h1 class="h3 mb-2 text-gray-800">Relação de Usuários</h1>
  <p class="mb-4">Lista de todos os assistidos, voluntários cadastrados no sistema.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Relação de Usuários</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>Id</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>Data de Nascimento</th>
              <th>Idade</th>
              <th>+ info</span></th>
              @can('usuarios-delete')
              <th></th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)
            <tr class="text-center">
              <td>{{ $usuario->id }}</td>
              <td class="text-justify">{{ $usuario->nome }}</td>
              <td>{{ $usuario->cpf }}</td>
              <td>{{ Carbon::parse($usuario->data_nascimento)->format('d/m/Y') }}</td>
              <td>{{ Carbon::parse($usuario->data_nascimento)->age }}</td>
              <td><a class="btn btn-info" href="{{ route('UsuarioShow', ['id' => $usuario->id]) }}"><span class="fas fa-user-edit"></span></a></td>
              @can('usuarios-delete')
              <td>
                <form action="{{route('UsuarioDestroy',$usuario->id)}}" method="POST">
                  <a title="Deletar" class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalApagarUsuario{{ $usuario->id }}"><i class="fas fa-trash-alt"></i></a>

                  <!-- Modal -->
                  <div class="modal fade" id="modalApagarUsuario{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="modalApagarUsuario{{ $usuario->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalApagarUsuario{{ $usuario->id }}Label">Tem certeza que deseja apagar o usuário <strong>{{ $usuario->nome }}</strong>?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          O usuário <strong>{{ $usuario->nome }}</strong> será apagado. Essa ação não pode ser desfeita.
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
              @endcan
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-level-scripts')

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection