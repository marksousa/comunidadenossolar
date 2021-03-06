<!-- Informações Pessoais -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>
  </div>
  <input type="hidden" name="usuario_id" value="{{ $usuario->id ?? ''}}">
  <div class="card-body">
    <div class="container">
      <div class="form-group">
        <div class="form-row">

          {{-- nome --}}
          <div class="form-group col-md-12">
            <label for="nome">Nome Completo <span class="text-danger"><strong>*</strong></span></label>
            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome', $usuario->nome ?? '') }}" name="nome" required {{ $bloquearEdicao ?? '' }}>
            <div class="invalid-feedback">
              {{$errors->first('nome')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">

          {{-- possui cpf? --}}
          <div class="form-group col-md-3">
            <label for="possui_cpf">Possui CPF próprio? <span class="text-danger"><strong>*</strong></span></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="possui_cpf_sim" name="possui_cpf" class="custom-control-input {{ $errors->has('possui_cpf') ? 'is-invalid' : '' }}" value="S" {{ old('possui_cpf', $usuario->possui_cpf) == "S" ? 'checked' : '' }}>
            <label class="custom-control-label" for="possui_cpf_sim">Sim</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="possui_cpf_nao" name="possui_cpf" class="custom-control-input {{ $errors->has('possui_cpf') ? 'is-invalid' : '' }}" value="N" {{ old('possui_cpf', $usuario->possui_cpf) == "N" ? 'checked' : '' }}>
            <label class="custom-control-label" for="possui_cpf_nao">Não</label>
            <div class="invalid-feedback">
              &nbsp;
              {{$errors->first('possui_cpf')}}
            </div>
          </div>
        </div>

        {{-- Linha do CPF --}}
        <div class="form-row" id="cpf-row">
          {{-- cpf --}}
          <div class="form-group col-md-5">
            <label id="lbl_cpf" for="cpf">Número do CPF</label>
            <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" maxlength="14" value="{{ old('cpf', $usuario->cpf ?? '') }}" name="cpf" {{ $bloquearEdicao ?? '' }}>
            <div class="invalid-feedback">
              {{$errors->first('cpf')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        {{-- script para ocultar o campo de cpf caso não possua --}}
        <script>
          if ($('input[name="possui_cpf"]:checked').val() === "S") {
            $('#cpf-row').show();
          } else {
            $('#cpf-row').hide();
          }

          $('input[name="possui_cpf"]').change(function () {
            if ($('input[name="possui_cpf"]:checked').val() === "S") {
              $('#cpf-row').show();
            } else {
              $('#cpf-row').hide();
              document.getElementById('cpf').value = '';
            }
          });
        </script>

        <div class="form-row">
          {{-- possui RG? --}}
          <div class="form-group col-md-5">
            <label for="possui_rg">Possui documento de identidade próprio? <span class="text-danger"><strong>*</strong></span></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="possui_rg_sim" name="possui_rg" class="custom-control-input {{ $errors->has('possui_rg') ? 'is-invalid' : '' }}" value="S" {{ old('possui_rg', $usuario->possui_rg) == "S" ? 'checked' : '' }}>
            <label class="custom-control-label" for="possui_rg_sim">Sim</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="possui_rg_nao" name="possui_rg" class="custom-control-input {{ $errors->has('possui_rg') ? 'is-invalid' : '' }}" value="N" {{ old('possui_rg', $usuario->possui_rg) == "N" ? 'checked' : '' }}>
            <label class="custom-control-label" for="possui_rg_nao">Não</label>
            <div class="invalid-feedback">
              &nbsp;
              {{$errors->first('possui_rg')}}
            </div>
          </div>
        </div>

        {{-- Linha do RG --}}
        <div class="form-row" id="rg-row">

          {{-- RG --}}
          <div class="form-group col-md-6">
            <label id="lbl_rg_numero" for="rg_numero">Número do documento de identidade</label>
            <input type="text" class="form-control {{ $errors->has('rg_numero') ? 'is-invalid' : '' }}" id="rg_numero" maxlength="14" value="{{ old('rg_numero', $usuario->rg_numero ?? '') }}" name="rg_numero">
            <div class="invalid-feedback">
              {{$errors->first('rg_numero')}}
            </div>
          </div>

          {{-- uf do RG --}}
          @inject('estados', 'App\Estado')
          <div class="form-group col-md-4">
            <label for="rg_uf">Estado do documento de identidade</label>
            <select class="custom-select {{ $errors->has('rg_uf') ? 'is-invalid' : '' }}" name="rg_uf" id="rg_uf">
              <option selected value="">Selecione</option>
              @foreach($estados->all() as $estado)
              <option value="{{ $estado->sigla }}" @if(old('rg_uf', $usuario->rg_uf ?? '') == $estado->sigla)
                selected
                @endif>

                {{ $estado->sigla }}
              </option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              {{$errors->first('rg_uf')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        {{-- script para ocultar o campo de RG caso não possua --}}
        <script>
          if ($('input[name="possui_rg"]:checked').val() === "S") {
            $('#rg-row').show();
          } else {
            $('#rg-row').hide();
          }

          $('input[name="possui_rg"]').change(function () {
            if ($('input[name="possui_rg"]:checked').val() === "S") {
              $('#rg-row').show();
            } else {
              $('#rg-row').hide();
              document.getElementById('rg_numero').value = '';
              document.getElementById('rg_uf').value = '';
            }
          });
        </script>

        <div class="form-row">
          {{-- NIS --}}
          <div class="form-group col-md-5">
            <label id="lbl_nis" for="nis">NIS (Número de Identificação Social)</label>
            <input type="text" class="form-control {{ $errors->has('nis') ? 'is-invalid' : '' }}" id="nis" maxlength="11" value="{{ old('nis', $usuario->nis ?? '') }}" name="nis">
            <div class="invalid-feedback">
              {{$errors->first('nis')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- genero --}}
          @inject('generos', 'App\Genero')
          <div class="form-group col-md-5">
            <label for="genero_id">Gênero <span class="text-danger"><strong>*</strong></span></label>
            <select class="custom-select {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" name="genero_id" required>
              <option selected value="">Selecione</option>
              @foreach ($generos->all() as $genero)
              <option value="{{ $genero->id }}" @if(old('genero_id', $usuario->genero_id) == $genero->id)
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
            <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento', $usuario->data_nascimento ?? '')}}">
            <div class="invalid-feedback">
              {{$errors->first('data_nascimento')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- uf do local de nascimento --}}
          <div class="form-group col-md-3">
            <label for="nascimento_uf">Estado de nascimento <span class="text-danger"><strong>*</strong></span></label>
            <select class="custom-select {{ $errors->has('nascimento_uf') ? 'is-invalid' : '' }}" name="nascimento_uf" id="nascimento_uf" required>
              <option selected value="">Selecione</option>
            </select>
            <div class="invalid-feedback">
              {{$errors->first('nascimento_uf')}}
            </div>
          </div> {{-- fecha form-group --}}

          {{-- municipio do local de nascimento --}}
          <div class="form-group col-md-9">
            <label for="nascimento_municipio">Município de nascimento <span class="text-danger"><strong>*</strong></span> (primeiro selecione o estado, depois o município)</label>
            <select class="custom-select {{ $errors->has('nascimento_municipio') ? 'is-invalid' : '' }}" name="nascimento_municipio" id="nascimento_municipio" required>
              <option selected value="">Selecione</option>
            </select>
            <div class="invalid-feedback">
              {{$errors->first('nascimento_municipio')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

<!-- Filiação -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Filiação</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="form-group">
        <div class="form-row">
          {{-- nome_mae --}}
          <div class="form-group col-md-9">
            <label for="nome_mae">Nome da Mãe completo</label>
            <input type="text" class="form-control {{ $errors->has('nome_mae') ? 'is-invalid' : '' }}" id="nome_mae" maxlength="80" value="{{ old('nome_mae', $usuario->nome_mae ?? '') }}" name="nome_mae">
            <div class="invalid-feedback">
              {{$errors->first('nome_mae')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- nome_pai --}}
          <div class="form-group col-md-9">
            <label for="nome_pai">Nome do Pai completo</label>
            <input type="text" class="form-control {{ $errors->has('nome_pai') ? 'is-invalid' : '' }}" id="nome_pai" maxlength="80" value="{{ old('nome_pai', $usuario->nome_pai ?? '') }}" name="nome_pai">
            <div class="invalid-feedback">
              {{$errors->first('nome_pai')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

<!-- Endereço -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Endereço atual (Preencha o CEP, número e complemento se necessário. As outras informações serão completadas automaticamente)</h6>
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
          @inject('estados', 'App\Estado')
          <div class="form-group col-md-2">
            <label for="uf">Estado</label>
            <select class="custom-select {{ $errors->has('uf') ? 'is-invalid' : '' }}" name="uf" id="uf">
              <option selected value="">Selecione</option>
              @foreach($estados->all() as $estado)
              <option value="{{ $estado->sigla }}" @if(old('uf', $usuario->endereco->uf ?? '') == $estado->sigla)
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
          @inject('paises', 'App\Pais')
          <div class="form-group col-md-2">
            <label for="pais">Pais</label>
            <select class="custom-select {{ $errors->has('pais') ? 'is-invalid' : '' }}" name="pais" id="pais">
              <option selected value="">Selecione</option>
              @foreach($paises->all() as $pais)
              <option value="{{ $pais->nome }}" @if(old('pais', $usuario->endereco->pais ?? 'Brasil') == $pais->nome)
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
        </div> {{-- fecha form-row --}}
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
        </div> {{-- fecha form-row --}}
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
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

        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- email --}}
          <div class="form-group col-md-7">
            <label for="email">Email <span class="text-danger"></span></label>
            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" maxlength="60" value="{{ old('email', $usuario->email ?? '') }}" name="email" {{ $bloquearEdicao ?? '' }}>
            <div class="invalid-feedback">
              {{$errors->first('email')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
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
          @inject('motivos', 'App\Motivo')
          <div class="form-group col-md-5">
            <label for="motivo_id">O que o(a) motivou a procurar o Nosso Lar? <span class="text-danger"><strong>*</strong></span></label>
            <select class="custom-select {{ $errors->has('motivo_id') ? 'is-invalid' : '' }}" name="motivo_id" required>
              <option selected value="">Selecione</option>
              @foreach($motivos->all() as $motivo)
              <option value="{{ $motivo->id }}" @if((old('motivo_id', $usuario->perfil->motivo_id ?? '') == $motivo->id))
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
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- data_inicio_nl --}}
          <div class="form-group col-md-4">
            <label for="data_inicio_nl">Data de Início no Nosso Lar (Mês e ano)</label>
            <input type="text" class="form-control {{ $errors->has('data_inicio_nl') ? 'is-invalid' : '' }}" id="data_inicio_nl" maxlength="7" placeholder="mm/aaaa" name="data_inicio_nl" value="{{old('data_inicio_nl', $usuario->perfil->data_inicio_nl ?? '')}}">
            <div class="invalid-feedback">
              {{$errors->first('data_inicio_nl')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- Primeiro Pilar --}}
          @inject('pilares', 'App\Pilar')
          <div class="form-group col-md-8">
            <label for="pilar_id">A área de sua primeira atividade no Nosso Lar está relacionada a qual Pilar? Se foi mais de uma, coloque a que teve mais relevância<span class="text-danger"><strong>*</strong></span></label>
            <select class="custom-select {{ $errors->has('pilar_id') ? 'is-invalid' : '' }}" name="pilar_id" required>
              <option selected value="">Selecione</option>
              @foreach ($pilares->all() as $pilar)
              <option value="{{ $pilar->id }}" @if(old('pilar_id', $usuario->perfil->pilar_id ?? '') == $pilar->id)
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
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          <div class="form-group col-md-12">
            <p>Caso tenha dúvida, clique em cada Pilar abaixo para ver as suas respectivas áreas</p>
            @foreach ($pilares->all() as $pilar)
            <div class="accordion border-bottom" id="accordion">
              <div class="card">
                <div class="card-header" id="heading{{ $pilar->id }}">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $pilar->id }}" aria-expanded="true" aria-controls="collapse{{ $pilar->id }}">
                      {{ $pilar->nome }}
                    </button>
                  </h2>
                </div>

                <div id="collapse{{ $pilar->id }}" class="collapse" aria-labelledby="heading{{ $pilar->id }}" data-parent="#accordion">
                  <div class="card-body">
                    {{ $pilar->areas }}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div> {{-- fecha form-group --}}
        </div> {{-- fecha form-row --}}
        <hr>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="observacao">Observações (preencher aqui caso o motivo a procurar o nosso lar seja outros)</label>
            <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao', $usuario->perfil->observacao ?? '') }}</textarea>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- Pesquisa de formação religiosa --}}
          @inject('religioes', 'App\Religiao')
          <div class="form-group col-md-5">
            <label for="formacao_religiosa">Pesquisa: Qual a sua formação religiosa? <span class="text-danger"><strong>*</strong></span></label>
            <select class="custom-select {{ $errors->has('formacao_religiosa') ? 'is-invalid' : '' }}" name="formacao_religiosa" id="formacao_religiosa">
              <option selected value="">Selecione</option>
              @foreach($religioes->all() as $religiao)
              <option value="{{ $religiao->id }}" @if(old('formacao_religiosa', $usuario->perfil->religiao_id ?? '') == $religiao->id)
                selected
                @endif>
                {{ $religiao->nome }}
              </option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              {{$errors->first('formacao_religiosa')}}
            </div>
          </div>

        </div> {{-- fecha form-group --}}
      </div> {{-- fecha container --}}
    </div>{{-- fecha card-body --}}
  </div>{{-- fecha card --}}

  {{-- O campo termo adesão irá via hidden com valor = "N" --}}
  <input type="hidden" id="termo_adesao" name="termo_adesao" value="N">

  <!-- JavaScript para Mask Input -->
  <script src="{{asset('vendor/jquery-mask/jquery.mask.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
            $('#cep').mask('00000-000');
            $('#telefone_celular').mask('00000-0000');
            $('#telefone_residencial').mask('0000-0000');
            $('#data_inicio_nl').mask('00/0000');
        });
  </script>

  <!-- Javascript para buscar os dados do endereço após preencher o CEP -->
  <script type="text/javascript">
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('municipio').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('data').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('endereco').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
                document.getElementById('municipio').value=(conteudo.localidade);
                document.getElementById('uf').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('endereco').value="...";
                    document.getElementById('bairro').value="...";
                    document.getElementById('municipio').value="...";
                    document.getElementById('uf').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
    $.getJSON('{{ asset('vendor/estados-cidades/estados_cidades.json') }}', function (data) {
      var items = [];
      var options = '<option value="{{ old('nascimento_uf', $usuario->nascimento_uf ?? '') }}">{{ old('nascimento_uf', $usuario->nascimento_uf ?? '') }}</option>';  
      $.each(data, function (key, val) {
        options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
      });         
      $("#nascimento_uf").html(options);        
      $("#nascimento_uf").change(function () {        
        var options_cidades = '<option value="{{ old('nascimento_municipio', $usuario->nascimento_municipio ?? '') }}">{{ old('nascimento_municipio', $usuario->nascimento_municipio ?? '') }}</option>';;
        var str = "";         
        $("#nascimento_uf option:selected").each(function () {
          str += $(this).text();
        });
        $.each(data, function (key, val) {
          if(val.sigla == str) {             
            $.each(val.cidades, function (key_city, val_city) {
              options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
            });             
          }
        });
        $("#nascimento_municipio").html(options_cidades);
      }).change();    
    });
  });
  </script>