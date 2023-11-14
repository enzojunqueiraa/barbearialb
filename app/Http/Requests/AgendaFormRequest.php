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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'profissional'=>'required',
            'cliente'=>'required',
            'servico'=>'required',
            'data'=>'required|date',
            'tipoPagamento' => 'required|max:20|min:3',
            'valor' => 'required'
        
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
            'profissional.required' => 'Profissional Obrigatório' ,
          
            'cliente.required' => 'Cliente Obrigatório' ,
            
            'servico.required' => 'Serviço Obrigatório',
           
            'data.required' => 'O data é obrigatória' ,
            
            'tipoPagamento.required' => 'O tipo de pagamento é obrigatório',
            'tipoPagamento.max' => 'O máximo de caracteres é 20',
            'tipoPagamento.min' => 'O mínimo de caracteres é 3',


            'valor.required' => 'A valor é obrigatório',
            

        ];
    }


}
