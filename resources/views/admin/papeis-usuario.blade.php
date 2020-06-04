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

          <div class="row">
            <form action="{{ route('UserPapelStore',$user->id) }}" method="post">
            {{ csrf_field() }}
            <div class="input-field">
              <select name="papel_id">
                @foreach($papeis as $papel)
                <option value="{{ $papel->id }}">{{ $papel->nome }}</option>
                @endforeach
              </select>
            </div>
              <button class="btn blue">Adicionar</button>
            </form>
          </div>
      
          <div class="row">
            <table>
              <thead>
                <tr>
                  <th>Papel</th>
                  <th>Descrição</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody>
              @foreach($user->papeis as $papel)
                <tr>
                  <td>{{ $papel->nome }}</td>
                  <td>{{ $papel->descricao }}</td>
                  <td>
                    <form action="{{route('UserPapelDestroy',[$user->id,$papel->id])}}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button title="Deletar" class="btn red"><i class="material-icons">delete</i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
@endsection

@section('page-level-scripts')
@endsection