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
            'cpf' => 'nullable|string|max:14',
            'nome' => 'required|string|max:255',
            'genero_id' => 'integer',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:40',
            'cep' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:60',
            'municipio' => 'nullable|string|max:60',
            'uf' => 'nullable|string|size:2',
            'pais' => 'nullable|string|max:80',
            'telefone_residencial_ddd' => 'nullable|string|max:2',
            'telefone_residencial' => 'nullable|string|max:8',
            'telefone_celular_ddd' => 'required|string|max:2',
            'telefone_celular' => 'required|string|max:10',
            'email' => 'nullable|string|max:255',
            'motivo_id' => 'required|string',
            'data_inicio_nl' => 'required|date',
            'primeira_area_nl' => 'required|string',
            'observacao' => 'nullable|string'
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
            'cpf' => 'CPF incorreto'
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
            'cpf' => 'digit',
            'nome' => 'trim|capitalize',
            'endereco' => 'trim|capitalize',
            'numero' => 'trim|capitalize',
            'complemento' => 'trim|capitalize',
            'cep' => 'trim|digit',
            'bairro' => 'trim|capitalize',
            'municipio' => 'trim|capitalize',
            'telefone_residencial_ddd' => 'trim|digit',
            'telefone_residencial' => 'trim|digit',
            'telefone_celular_ddd' => 'trim|digit',
            'telefone_celular' => 'trim|digit',
            'email' => 'trim|lowercase',
            
        ];
    }
}
