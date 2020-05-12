<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class StoreUsuarioRequest extends BaseFormRequest
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
            'id' => 'required|integer',
            'cpf' => 'required|cpf',
            'nome' => 'required|string|max:255',
            'sexo' => 'required|string|max:1',
            'data_nascimento' => 'required|date',
            'telefone_residencial_ddd' => 'nullable|string|max:3',
            'telefone_residencial' => 'nullable|string|max:60',
            'telefone_celular_ddd' => 'required|string|max:3',
            'telefone_celular' => 'required|string|max:60',
            'email' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:40',
            'cep' => 'required|string|max:10',
            'bairro' => 'required|string|max:60',
            'municipio' => 'required|string|max:60',
            'uf' => 'required|string|size:2',
            'pais' => 'required|string|max:80'
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
            'email' => 'trim|lowercase',
            'telefone-celular' =>'digit'
        ];
    }
    
}
