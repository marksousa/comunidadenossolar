@extends('admin.layouts.principal')

@section('page-level-css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Relação de Users</h1>
          <p class="mb-4">Lista de todos os users habilitados no sistema.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Relação de Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>Id</th>
                      <th>Nome</th>
                      <th>CPF</th>
                      <th>Email</th>
                      <th>Data de Cadastro</th>
                      <th>+ info</th>
                      <th>Papéis</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr class="text-center">
                        <td>{{ $user->id }}</td>
                        <td class="text-justify">{{ $user->name }}</td>
                        <td>{{ $user->cpf }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                        @isset($user->usuario_id)
                          <td><a class="btn btn-info" href="{{ route('UsuarioShow',['id'=>$user->usuario_id]) }}"><span class="fas fa-id-card"></span></a></td>
                        @else
                          <td><button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="User ainda não preencheu o Formulário" disabled><span class="fas fa-ban"></span></button></td>
                        @endisset
                        <td>
                          @foreach($user->papeis as $cadaPapel)
                            <span class="badge badge-primary">{{ $cadaPapel->nome }}</span>
                          @endforeach
                          @isset($user->usuario_id)
                          <a href="{{ route('UserPapel', ['id' => $user->id]) }}" class="badge badge-pill-primary"><i class="fas fa-plus-circle"></i></a>
                          @endisset
                        </td>
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