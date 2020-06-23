<!-- Informações Pessoais -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>
  </div>
  <div class="card-body">
      <div class="container">
          <div class="form-group">
              <div class="form-row">
                  {{-- cpf --}}
                  <div class="form-group col-md-2">
                      <label id="lbl_cpf" for="cpf">CPF</label>
                      <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" maxlength="14" value="{{ old('cpf', $usuario->cpf ?? '') }}" name="cpf" {{ $bloquearEdicao ?? '' }} >
                      <div class="invalid-feedback">
                          {{$errors->first('cpf')}}
                      </div>
                  </div>

                  {{-- nome --}}
                  <div class="form-group col-md-10">
                      <label for="nome">Nome Completo <span class="text-danger"><strong>*</strong></span></label>
                      <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome', $usuario->nome ?? '') }}" name="nome" required {{ $bloquearEdicao ?? '' }}>
                      <div class="invalid-feedback">
                          {{$errors->first('nome')}}
                      </div>
                  </div>
              </div> {{-- fecha form-row --}}

              <div class="form-row">
                  {{-- genero --}}
                  <div class="form-group col-md-5">
                      <label for="genero_id">Gênero <span class="text-danger"><strong>*</strong></span></label>
                      <select class="custom-select {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" name="genero_id" required>
                          <option selected value="">Selecione</option>
                          @foreach ($generos as $genero)
                              <option value="{{ $genero->id }}" 
                                @if(old('genero_id', $usuario->genero_id) == $genero->id)
                                  selected
                                @endif>
                                {{ $genero->nome }}
                              </option>                                    
                          @endforeach
                      </select>
                      <div class="invalid-feedback">
                          {{$errors->first('genero_id')}}
                      </div>
                  </div>

                  {{-- data_nascimento --}}
                  <div class="form-group col-md-4">
                      <label for="data_nascimento">Data de Nascimento</label>
                      <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" id="data_nascimento"  name="data_nascimento" value="{{old('data_nascimento', $usuario->data_nascimento ?? '')}}">
                      <div class="invalid-feedback">
                          {{$errors->first('data_nascimento')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}
          </div>  {{-- fecha form-group --}}
      </div>  {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

<!-- Endereço -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Endereço (Preencha o CEP, número e complemento se necessário. As outras informações serão completadas automaticamente)</h6>
  </div>
  <div class="card-body">
      <div class="container">
          <div class="form-group">
              <div class="form-row">
                  {{-- cep --}}
                  <div class="form-group col-md-2">
                      <label for="cep">CEP</label>
                      <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep" maxlength="9" value="{{ old('cep', $usuario->endereco->cep ?? '') }}" name="cep" onblur="pesquisacep(this.value);">
                      <div class="invalid-feedback">
                          {{$errors->first('cep')}}
                      </div>
                  </div>

                  {{-- bairro --}}
                  <div class="form-group col-md-3">
                      <label for="bairro">Bairro</label>
                      <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro" maxlength="60" value="{{ old('bairro', $usuario->endereco->bairro ?? '') }}" name="bairro">
                      <div class="invalid-feedback">
                          {{$errors->first('bairro')}}
                      </div>
                  </div>

                  {{-- municipio --}}
                  <div class="form-group col-md-3">
                      <label for="municipio">Município</label>
                      <input type="text" class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" id="municipio" maxlength="60" value="{{ old('municipio', $usuario->endereco->municipio ?? '') }}" name="municipio">
                      <div class="invalid-feedback">
                          {{$errors->first('municipio')}}
                      </div>
                  </div>

                  {{-- uf --}}
                  <div class="form-group col-md-2">
                      <label for="uf">Estado</label>
                      <select class="custom-select {{ $errors->has('uf') ? 'is-invalid' : '' }}" name="uf" id="uf">
                          <option selected value="">Selecione</option>
                          @foreach($estados as $estado)
                              <option value="{{ $estado->sigla }}" 
                                @if(old('uf', $usuario->endereco->uf ?? '') == $estado->sigla)
                                  selected
                                @endif>
                                
                                {{ $estado->sigla }}
                              </option>
                          @endforeach
                      </select>
                      <div class="invalid-feedback">
                          {{$errors->first('uf')}}
                      </div>
                  </div>

                  {{-- pais --}}
                  <div class="form-group col-md-2">
                      <label for="pais">Pais</label>
                      <select class="custom-select {{ $errors->has('pais') ? 'is-invalid' : '' }}" name="pais" id="pais">
                          <option selected value="">Selecione</option>
                          @foreach($paises as $pais)
                              <option value="{{ $pais->nome }}"
                                @if(old('pais', $usuario->endereco->pais ?? 'Brasil') == $pais->nome)
                                  selected
                                @endif>
                                {{ $pais->nome}}
                              </option>
                          @endforeach
                      </select>
                      <div class="invalid-feedback">
                          {{$errors->first('pais')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}
              <div class="form-row">
                  {{-- logradouro --}}
                  <div class="form-group col-md-8">
                      <label for="endereco">Endereço (Rua, Avenida, etc.)</label>
                      <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco" maxlength="60" value="{{ old('endereco', $usuario->endereco->endereco ?? '') }}" name="endereco">
                      <div class="invalid-feedback">
                          {{$errors->first('endereco')}}
                      </div>
                  </div>

                  {{-- numero --}}
                  <div class="form-group col-md-1">
                      <label for="numero">Número</label>
                      <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero" maxlength="10" value="{{ old('numero', $usuario->endereco->numero ?? '') }}" name="numero">
                      <div class="invalid-feedback">
                          {{$errors->first('numero')}}
                      </div>
                  </div>

                  {{-- complemento --}}
                  <div class="form-group col-md-3">
                      <label for="complemento">Complemento</label>
                      <input type="text" class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" id="complemento" maxlength="40" value="{{ old('complemento', $usuario->endereco->complemento ?? '') }}" name="complemento">
                      <div class="invalid-feedback">
                          {{$errors->first('complemento')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}
          </div>  {{-- fecha form-group --}}
      </div>  {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

<!-- Contato -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Contato (Se não possuir telefone celular, coloque o número de um parente ou vizinho)</h6>
  </div>
  <div class="card-body">
      <div class="container">
          <div class="form-group">
              <div class="form-row">
                  {{-- telefone_celular_ddd --}}
                  <div class="form-group col-md-1">
                      <label for="telefone_celular_ddd">DDD <span class="text-danger"><strong>*</strong></span></label>
                      <input type="text" class="form-control {{ $errors->has('telefone_celular_ddd') ? 'is-invalid' : '' }}" id="DDD" maxlength="2" name="telefone_celular_ddd" value="{{old('telefone_celular_ddd', $usuario->telefone_celular_ddd ?? '')}}" required>
                      <div class="invalid-feedback">
                          {{$errors->first('telefone_celular_ddd')}}
                      </div>
                  </div>

                  {{-- telefone_celular --}}
                  <div class="form-group col-md-3">
                      <label for="telefone_celular">Telefone Celular <span class="text-danger"><strong>*</strong></span></label>
                      <input type="text" class="form-control {{ $errors->has('telefone_celular') ? 'is-invalid' : '' }}" id="telefone_celular" maxlength="10" name="telefone_celular" value="{{old('telefone_celular', $usuario->telefone_celular ?? '')}}" required>
                      <div class="invalid-feedback">
                          {{$errors->first('telefone_celular')}}
                      </div>
                  </div>
              </div>
                  <?php
                  /*
                  {{-- whatsapp --}}
                  <div class="form-group col-md-2">
                      <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="whatsapp" name="whatsapp"
                          @if(old('whatsapp') == 'on') 
                          "checked"
                          @endif
                          >
                          <label class="custom-control-label" for="whatsapp"><strong>Celular com Whatsapp?</strong></label>
                      </div>
                  </div>
                  */
                  ?>
              <div class="form-row">
                  {{-- telefone_residencial_ddd --}}
                  <div class="form-group col-md-1">
                      <label for="telefone_residencial_ddd">DDD</label>
                      <input type="text" class="form-control {{ $errors->has('telefone_residencial_ddd') ? 'is-invalid' : '' }}" id="telefone_residencial_ddd" maxlength="2" name="telefone_residencial_ddd" value="{{old('telefone_residencial_ddd', $usuario->telefone_residencial_ddd ?? '')}}">
                      <div class="invalid-feedback">
                          {{$errors->first('telefone_residencial_ddd')}}
                      </div>
                  </div>

                  {{-- telefone_residencial --}}
                  <div class="form-group col-md-3">
                      <label for="telefone_residencial">Telefone Residencial</label>
                      <input type="text" class="form-control {{ $errors->has('telefone_residencial') ? 'is-invalid' : '' }}" id="telefone_residencial" maxlength="9" name="telefone_residencial" value="{{old('telefone_residencial', $usuario->telefone_residencial ?? '')}}">
                      <div class="invalid-feedback">
                          {{$errors->first('telefone_residencial')}}
                      </div>
                  </div>

              </div>  {{-- fecha form-row --}}
                  
              <div class="form-row">
                  {{-- email --}}
                  <div class="form-group col-md-7">
                      <label for="email">Email <span class="text-danger"></span></label>
                      <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" maxlength="60" value="{{ old('email', $usuario->email ?? '') }}" name="email" {{ $bloquearEdicao ?? '' }}>
                      <div class="invalid-feedback">
                          {{$errors->first('email')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}
          </div>  {{-- fecha form-group --}}
      </div>  {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

<!-- Entrevista -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Entrevista</h6>
  </div>
  <div class="card-body">
      <div class="container">
          <div class="form-group">
              <div class="form-row">
                  {{-- Motivos Para Vir ao Nosso lar --}}
                  <div class="form-group col-md-4">
                      <label for="motivo_id">O que o(a) motivou a procurar o Nosso Lar? <span class="text-danger"><strong>*</strong></span></label>
                      <select class="custom-select {{ $errors->has('motivo_id') ? 'is-invalid' : '' }}" name="motivo_id" required>
                          <option selected value="">Selecione</option>
                          @foreach($motivos as $motivo)
                          <option value="{{ $motivo->id }}" 
                            @if((old('motivo_id', $usuario->perfil->motivo_id ?? '') == $motivo->id))
                              selected
                            @endif>
                            {{ $motivo->nome}}
                          </option>
                          @endforeach
                      </select>
                      <div class="invalid-feedback">
                          {{$errors->first('motivo_id')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}

              <div class="form-row">
                  {{-- data_inicio_nl --}}
                  <div class="form-group col-md-4">
                      <label for="data_inicio_nl">Data de Início no Nosso Lar (Mês e ano)</label>
                      <input type="text" class="form-control {{ $errors->has('data_inicio_nl') ? 'is-invalid' : '' }}" id="data_inicio_nl" maxlength="7" placeholder="mm/aaaa" name="data_inicio_nl" value="{{old('data_inicio_nl', $usuario->perfil->data_inicio_nl ?? '')}}">
                      <div class="invalid-feedback">
                          {{$errors->first('data_inicio_nl')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}

              <div class="form-row">
                  {{-- Primeiro Pilar --}}
                  <div class="form-group col-md-4">
                      <label for="pilar_id">Qual o 1º. pilar do Nosso Lar? <span class="text-danger"><strong>*</strong></span></label>
                      <select class="custom-select {{ $errors->has('pilar_id') ? 'is-invalid' : '' }}" name="pilar_id" required>
                          <option selected value="">Selecione</option>
                          @foreach ($pilares as $pilar)
                            <option value="{{ $pilar->id }}"
                              @if(old('pilar_id', $usuario->perfil->pilar_id ?? '') == $pilar->id)
                                selected
                              @endif>
                              {{ $pilar->nome }}
                            </option>
                          @endforeach
                      </select>
                      <div class="invalid-feedback">
                          {{$errors->first('pilar_id')}}
                      </div>
                  </div>
              </div>  {{-- fecha form-row --}}

              <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="observacao">Observações (preencher aqui caso o motivo a procurar o nosso lar seja outros)</label>
                      <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao', $usuario->perfil->observacao ?? '') }}</textarea>
                  </div>
              </div>  {{-- fecha form-row --}}
          </div>  {{-- fecha form-group --}}
      </div>  {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

