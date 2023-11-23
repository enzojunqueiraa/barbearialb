<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfissionalFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Validações para o update do profissionais
        // O this id é o comparativo entre o id do campo(email) dentro da tabela
        return [
            'nome' => 'max:120|min:5',
            'celular' =>'max:11|min:10',
            'email'=>'max:120|email:rfc||unique:profissionals,email,' . $this->id,
            'cpf'=>'max:11|min:11|unique:profissionals,cpf,' . $this->id,
            'dataNascimento'=>'',
            'cidade'=>'max:120',
            'estado'=>'max:2|min:2',
            'pais'=>'max:80',
            'rua'=>'max:120',
            'numero'=>'max:10',
            'bairro'=>'max:100',
            'cep'=>'max:9|min:8',
            'complemento'=>'max:150',
            'senha' => '',
            'salario' => 'decimal:2'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    // Mensagens que serão exibidas
    public function messages(){
        return [ 
    
            'nome.max' => 'Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 5 caracteres',
        
           
            'celular.max' => 'Deve conter no máximo 11 caracteres',
            'celular.min' => 'Deve conter no mínimo 10 caracteres',

          
            'email.max' => 'Deve conter no maxímo 120 caracteres',
            'email.email' => 'Formato de email inválido',
            'email.unique' => 'E-mail já cadastrado no sistema',
           
            'cpf.max' => 'Deve conter no máximo 11 caracteres',
            'cpf.min' => 'Deve conter no mínimo 10 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',

           
            'cidade.max' => 'O campo deve conter no máximo 120 caracteres' ,

            
            'estado.max' => 'O campo deve conter no máximo 2 caracteres',
            'estado.min' => 'O campo deve conter no mínimo 2 caracteres',

           
            'pais.max' =>'O campo deve conter no máximo 80 caracteres',

           
            'rua.max' =>'O campo deve conter no máximo 120 caracteres',

            
            'numero.max' =>'O campo deve conter no máximo 10 caracteres',

            'bairro.max' =>'O campo deve conter no máximo 100 caracteres',

            
            'cep.max' =>'O campo deve conter no máximo 9 caracteres',
            'cep.min' =>'O campo deve conter no mínimo 8 caracteres',

            'complemento.max' => 'O campo deve conter no máximo 150 caracteres',

            'salario.decimal' => "Informar valores em reais"
            
        ];
    }





    
}


