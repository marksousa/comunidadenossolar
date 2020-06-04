<!-- Form Papel -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Novo Papel</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="form-group">

        {{-- nome --}}
        <div class="form-row">
          <div class="form-group col-md-12">
              <label for="nome">Nome <span class="text-danger"><strong>*</strong></span></label>
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome', $registro->nome ?? '') }}" name="nome" required>
              <div class="invalid-feedback">
                  {{$errors->first('nome')}}
              </div>
          </div>
        </div> {{-- fecha form-row --}}

        {{-- descricao --}}
        <div class="form-row">
          <div class="form-group col-md-12">
              <label id="lbl_descricao" for="descricao">Descrição</label>
              <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao" value="{{ old('descricao', $registro->descricao ?? '') }}" name="descricao">
              <div class="invalid-feedback">
                  {{$errors->first('descricao')}}
              </div>
          </div>
        </div> {{-- fecha form-row --}}

      </div> {{--  form-group --}}
    </div> {{-- container --}}
  </div>{{-- card-body --}}
</div>{{-- card --}}
