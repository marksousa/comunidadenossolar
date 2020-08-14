<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class UsuarioSanitizedRequest extends FormRequest
{
  use SanitizesInput;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'nome' => 'required|string|max:80',
      'possui_cpf' => 'required_if:assistido,==,1|string|max:1',
      'cpf' => 'nullable|cpf|max:14',
      'possui_rg' => 'required_if:assistido,==,1|string|max:1',
      'rg_numero' => 'nullable|string|max:15',
      'rg_uf' => 'nullable|string|size:2',
      'genero_id' => 'required|integer',
      'data_nascimento' => 'nullable|date',
      'nascimento_uf' => 'required|string|max:2',
      'nascimento_municipio' => 'required|string|max:60',
      'endereco' => 'nullable|string|max:60',
      'numero' => 'nullable|string|max:10',
      'complemento' => 'nullable|string|max:40',
      'cep' => 'nullable|string|max:9',
      'bairro' => 'nullable|string|max:60',
      'municipio' => 'nullable|string|max:60',
      'uf' => 'nullable|string|size:2',
      'pais' => 'nullable|string|max:80',
      'telefone_residencial_ddd' => 'nullable|string|max:2',
      'telefone_residencial' => 'nullable|string|max:9',
      'telefone_celular_ddd' => 'required|string|max:2',
      'telefone_celular' => 'required|string|max:10',
      'email' => 'nullable|string|max:60',
      'motivo_id' => 'required|string',
      'data_inicio_nl' => 'nullable|string|max:7',
      'pilar_id' => 'required|integer',
      'observacao' => 'nullable|string',
      'formacao_religiosa' => 'required|string',
      'termo_adesao' => 'required|string|max:1'
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages()
  {
    return [
      'required' => 'Campo Obrigatório!',
      'max' => 'máximo :max caracteres',
      'min' => 'mínimo :min caracteres',
      'size' => 'Preencha com :size caracteres.',
      'cpf' => 'CPF incorreto',
      'cpf.unique' => 'Esse CPF já foi cadastrado no sistema'
    ];
  }

  /**
   *  Filters to be applied to the input.
   *
   * @return array
   */
  public function filters()
  {
    return [
      'nome' => 'trim|capitalize',
      'possui_cpf' => 'trim',
      'cpf' => 'digit',
      'possui_rg' => 'trim',
      'rg' => 'trim|capitalize',
      'nascimento_municipio' => 'trim|capitalize',
      'endereco' => 'trim|capitalize',
      'numero' => 'trim|capitalize',
      'complemento' => 'trim|capitalize',
      'cep' => 'trim',
      'bairro' => 'trim|capitalize',
      'municipio' => 'trim|capitalize',
      'telefone_residencial_ddd' => 'trim|digit',
      'telefone_residencial' => 'trim',
      'telefone_celular_ddd' => 'trim|digit',
      'telefone_celular' => 'trim',
      'email' => 'trim|lowercase',
      'termo_adesao' => 'trim'
    ];
  }
}
