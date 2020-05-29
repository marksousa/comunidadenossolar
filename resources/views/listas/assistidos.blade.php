@extends('admin.layouts.principal')

@section('page-level-css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Relação de Assistidos</h1>
          <p class="mb-4">Lista de todos os assistidos cadastrados no sistema.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Relação de Assistidos</h6>
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
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($assistidos as $assistido)
                      <tr class="text-center">
                        <td>{{ $assistido->id }}</td>
                        <td class="text-justify">{{ $assistido->nome }}</td>
                        <td>{{ $assistido->cpf }}</td>
                        <td>{{ Carbon::parse($assistido->data_nascimento)->format('d/m/Y') }}</td>
                        <td>{{ Carbon::parse($assistido->data_nascimento)->age }}</td>
                        <td><a class="btn btn-info" href="{{ route('UsuarioShow', ['id' => $assistido->id]) }}"><span class="fas fa-user-edit"></span></a></td>
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