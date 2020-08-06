<!-- Informações Pessoais -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="form-group">
        <div class="form-row">
          {{-- nome --}}
          <div class="form-group col-md-9">
            <label for="nome">Nome Completo <span class="text-danger"><strong>*</strong></span></label>
            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" maxlength="80" value="{{ old('nome', $usuario->nome ?? '') }}" name="nome" required {{ $bloquearEdicao ?? '' }}>
            <div class="invalid-feedback">
              {{$errors->first('nome')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- possui cpf? --}}
          <div class="form-group col-md-4">
            <label for="lbl_possui_cpf">Possui CPF próprio? <span class="text-danger"><strong>*</strong></span></label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="possui_cpf" id="possui_cpf_sim" value="S" {{ old('possui_cpf') == "S" || old('possui_cpf') == "" ? 'checked' : '' }} {{ $usuario->possui_cpf == "S" ? 'checked' : '' }} onclick="habilitaCPFNumero()">
              <label class="form-check-label" for="sim">
                Sim
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="possui_cpf" id="possui_cpf_nao" value="N" {{ old('possui_cpf') == "N" ? 'checked' : '' }} {{ $usuario->possui_cpf == "N" ? 'checked' : '' }} onclick="desabilitaCPFNumero()">
              <label class="form-check-label" for="nao">
                Não
              </label>
            </div>
          </div>

          {{-- cpf --}}
          <div class="form-group col-md-5">
            <label id="lbl_cpf" for="cpf">Número do CPF</label>
            <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" maxlength="14" value="{{ old('cpf', $usuario->cpf ?? '') }}" name="cpf" {{ $bloquearEdicao ?? '' }}>
            <div class="invalid-feedback">
              {{$errors->first('cpf')}}
            </div>
          </div>
        </div> {{-- fecha form-row --}}

        <div class="form-row">
          {{-- possui RG? --}}
          <div class="form-group col-md-4">
            <label for="lbl_possui_rg">Possui documento de identidade próprio? <span class="text-danger"><strong>*</strong></span></label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="possui_rg" id="possui_rg_sim" value="S" {{ old('possui_rg') == "S" || old('possui_rg') == "" ? 'checked' : '' }} {{ $usuario->possui_rg == "S" ? 'checked' : '' }} onclick="habilitaRGDados()">
              <label class="form-check-label" for="sim">
                Sim
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="possui_rg" id="possui_rg_nao" value="N" {{ old('possui_rg') == "N" ? 'checked' : '' }} {{ $usuario->possui_rg == "N" ? 'checked' : '' }} onclick="desabilitaRGDados()">
              <label class="form-check-label" for="nao">
                Não
              </label>
            </div>
          </div>

          {{-- RG --}}
          <div class="form-group col-md-5">
            <label id="lbl_rg_numero" for="rg_numero">Número do documento de identidade</label>
            <input type="text" class="form-control {{ $errors->has('rg_numero') ? 'is-invalid' : '' }}" id="rg_numero" maxlength="14" value="{{ old('rg_numero', $usuario->rg_numero ?? '') }}" name="rg_numero">
            <div class="invalid-feedback">
              {{$errors->first('rg_numero')}}
            </div>
          </div>

          {{-- uf do RG --}}
          @inject('estados', 'App\Estado')
          <div class="form-group col-md-3">
            <label for="rg_uf">Estado do documento de identidade</label>
            <select class="custom-select {{ $errors->has('rg_uf') ? 'is-invalid' : '' }}" name="rg_uf" id="rg_uf">
              <option selected value="">Selecione</option>
              @foreach($estados->all() as $estado)
              <option value="{{ $estado->sigla }}" @if(old('rg_uf', $usuario->endereco->rg_uf ?? '') == $estado->sigla)
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
          @inject('estados', 'App\Estado')
          <div class="form-group col-md-3">
            <label for="nascimento_uf">Estado de nascimento</label>
            <select class="custom-select {{ $errors->has('nascimento_uf') ? 'is-invalid' : '' }}" name="nascimento_uf" id="nascimento_uf">
              <option selected value="">Selecione</option>
              @foreach($estados->all() as $estado)
              <option value="{{ $estado->sigla }}" @if(old('nascimento_uf', $usuario->endereco->nascimento_uf ?? '') == $estado->sigla)
                selected
                @endif>

                {{ $estado->sigla }}
              </option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              {{$errors->first('nascimento_uf')}}
            </div>
          </div> {{-- fecha form-group --}}

          {{-- municipio do local de nascimento --}}
          <div class="form-group col-md-6">
            <label for="nascimento_municipio">Município de nascimento</label>
            <input type="text" class="form-control {{ $errors->has('nascimento_municipio') ? 'is-invalid' : '' }}" id="nascimento_municipio" maxlength="60" value="{{ old('nascimento_municipio', $usuario->nascimento_municipio ?? '') }}" name="nascimento_municipio">
            <div class="invalid-feedback">
              {{$errors->first('nascimento_municipio')}}
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
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}

{{-- @can('inabilitado-visualizar-termo-de-adesao') --}}
<!-- Termo de Adesão -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Termo de Adesão Ao Serviço Voluntário</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="form-group">
        <div class="form-row">
          {{-- termo de adesão --}}
          <div class="form-group col-md-12 text-center">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#termo_adesao_contrato">Clique para ler o Termo de Adesão</button>
            <hr>
            <div id="termo_adesao_contrato" class="collapse">
              <p><strong>DO OBJETO</strong></p>
              <p class="text-justify"><strong>Cláusula 1a.</strong> O presente contrato tem como objeto a prestação de serviço voluntário, a ser prestado à Associação Espirita Nosso Lar, de acordo com as necessidades da Casa, com trabalhos internos e externos realizados pela mesma, a exemplo de atendimento psicológico, jurídico, de saúde, visitas em hospitais, asilos, orfanatos, reforço escolar, confecção e distribuição de alimentos, realização de passes na Associação e em domicílio, serviço de limpeza, cozinha, manutenção, informática, entre outros.</p>
              <p><strong>DAS CONDIÇÕES DO EXERCÍCIO </strong></p>
              <p class="text-justify"><strong>Cláusula 2a.</strong> O voluntário (a) fica comprometido (a) a prestar ao Nosso Lar os serviços voluntários de acordo com sua conveniência e necessidade da Associação.</p>
              <p class="text-justify"><strong>Cláusula 3a.</strong> A associação Espírita Nosso Lar garantirá ao voluntário (a), na medida do possível, todas as condições para o desenvolvimento das atividades para ele designadas.</p>
              <p><strong>DA RESCISÃO</strong></p>
              <p class="text-justify"><strong>Cláusula 4a.</strong> O presente instrumento poderá ser rescindido a qualquer tempo, por inciativa de qualquer uma das partes, o que não irá acarretar em qualquer tipo de indenização entre o voluntário (a) e a associação Espírita Nosso Lar.</p>
              <p><strong>DO PRAZO</strong></p>
              <p class="text-justify"><strong>Cláusula 5a.</strong> O presente Termo terá o prazo de 1 (um) ano, renovável automaticamente, caso seja de interesse de ambas as partes.</p>
              <p><strong>DO FORO</strong></p>
              <p class="text-justify"><strong>Cláusula 6a.</strong> Para dirimir quaisquer controvérsias oriundas do Termo de Adesão de Serviço Voluntário, as partes alegam o foro da comarca de Maceió/AL.</p>
              <p class="text-justify"><strong>Pelo presente Termo de Adesão, decido espontaneamente realizar atividade voluntária nesta Associação, ciente da Lei no 9.608, de 18/02/1998, que declara que o mesmo não é atividade remunerada, não representa vínculo empregatício nem gera obrigações de natureza trabalhista, previdenciária ou afim.</strong></p>
            </div>
            <p>&nbsp;</p>
            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input {{ $errors->has('termo_adesao') ? 'is-invalid' : '' }}" id="termo_adesao" name="termo_adesao" value="S" required {{ old('termo_adesao') == "S" ? 'checked' : '' }} {{ $usuario->termo_adesao == "S" ? 'checked' : '' }}>
              <label class="custom-control-label" for="termo_adesao"><strong>Aceito os termos para finalizar meu cadastro</strong></label>
              <div class="invalid-feedback">
                {{$errors->first('termo_adesao')}}
              </div>
            </div>
          </div> {{-- fecha form-group col-md-12--}}
        </div> {{-- fecha form-row --}}
      </div> {{-- fecha form-group --}}
    </div> {{-- fecha container --}}
  </div>{{-- fecha card-body --}}
</div>{{-- fecha card --}}
{{-- @endcan --}}

@section('page-level-scripts')
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
    <script type="text/javascript" >
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

        function desabilitaCPFNumero()
        {  
            if(document.getElementById("possui_cpf_nao").checked == true)
            {  
                document.getElementById("cpf").disabled = true;  
                document.getElementById("cpf").value = "";  
            }
        }  
        function habilitaCPFNumero()
        {  
            if (document.getElementById("possui_cpf_sim").checked == true)
            {
                document.getElementById("cpf").disabled = false;
            }  
        }  

        function desabilitaRGDados()
        {  
            if(document.getElementById("possui_rg_nao").checked == true)
            {  
                document.getElementById("rg_numero").disabled = true;  
                document.getElementById("rg_numero").value = "";  
                document.getElementById("rg_uf").disabled = true;  
            }
        }  
        function habilitaRGDados()
        {  
            if (document.getElementById("possui_rg_sim").checked == true)
            {
                document.getElementById("rg_numero").disabled = false;
                document.getElementById("rg_uf").disabled = false;
            }  
        }  
    </script>
@endsection
