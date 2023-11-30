<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

     // Validações para os campos requisitados
    public function rules(): array
    {
        return [
            'nome'=>'required|max:80|min:5|unique:servicos,nome',
            'descricao'=>'required|max:200|min:10',
            'duracao'=>'required|numeric',
            'preco'=>'required|decimal:2',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

        // Mensagens a serem exibidas das validações 
    public function messages(){
        return [
            'nome.required' => 'Nome obrigatório',
            'nome.max' => 'Nome deve conter no máximo 80 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 5 caracteres',
            'nome.unique' => 'Nome já cadastrado no sistema',
            'nome.unique' => 'Nome deve conter no mínimo 5 caracteres',
            'descricao.required' => 'Descrição obrigatório',
            'descricao.max' => 'Descrição deve conter no máximo 200 caracteres',
            'descricao.min' => 'Descrição deve conter no mínimo 10 caracteres',
            'descricao.unique' => 'Descrição já cadastrado no sistema',
            'duracao.required' => 'Duração obrigatório',
            'duracao.numeric' => 'O campo deve conter apenas números',
            'preco.required' => 'O preço é obrigatório',
            'preco.decimal' => 'Informar valores em reais',
        ];
    }

}
