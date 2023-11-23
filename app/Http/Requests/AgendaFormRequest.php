<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequest extends FormRequest
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
        return [
            
            'profissional_id'=>'required|exists:profissionals,id',
            'cliente_id'=>'intereger',
            'servico_id'=>'intereger',
            'data_hora'=>'required|date',
            'tipoPagamento' => '|max:20|min:3',
            'valor' => 'decimal:2'
        
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    
    // Todas as mensagens das validações que serão exibidas caso o campo não seje preenchido de maneira correta
    public function messages(){
        return [
            'profissional_id.required' => 'Profissional Obrigatório' ,
          
            'profissional_id.exists' => 'Profissional sem esse horário disponível' ,
            
            'data_hora.required' => 'O data é obrigatória' ,

            'data_hora.date' => 'O campo aceita data somente',
           
            'tipoPagamento.max' => 'Máximo de caracteres é 20',
            'tipoPagamento.min'=> 'Mínimo de caracteres é 3',

            'valor.decimal'=> 'O campo é aceita apenas números decimais'

        ];
    }


}
