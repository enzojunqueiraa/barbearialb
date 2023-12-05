<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormRequest;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalController extends Controller
{
     // Função de Cadastro de Profissionais
     public function profissional(ProfissionalFormRequest $request)
     {
         $profissional= Profissional::create([
             'nome' => $request->nome,
             'celular' => $request->celular,
             'email' => $request->email,
             'cpf' => $request->cpf,
             'dataNascimento' => $request->dataNascimento,
             'cidade' => $request->cidade,
             'estado' => $request->estado,
             'pais' => $request->pais,
             'rua' => $request->rua,
             'numero' => $request->numero,
             'bairro' => $request->bairro,
             'cep' => $request->cep,
             'complemento' => $request->complemento,
             'senha' => Hash::make($request->senha),
             'salario' => $request->salario

 
         ]);
         return response()->json([
             "sucess" => true,
             "message" => "Registro de Profissional Profissional",
             "data" => $profissional
         ], 200);
     }

     // Função de pesquisa por nome
    public function pesquisarPorNome(Request $request)
    {
        $profissional = Profissional::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Não há resultados na pesquisa"
        ]);
    }
    // Função de pesquisa por id
    public function pesquisarPorId($id)
    {
        $profissional = Profissional::find($id);
        if ($profissional == null) {
           return response()->json([
               'status' => false,
               'message' => "Usuário não encontrado"
           ]);
       }
       return response()->json([
           'status' => true,
           'data' => $profissional
       ]);
    }

    // Função de pesquisa por CPF
    public function pesquisarPorCpf( Request $request)
    {
        $profissional = Profissional::where('CPF', 'like', '%' . $request->cpf . '%')->get();
        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Não há resultados na pesquisa"
        ]);
    }

        // Função de pesquisa por Email
    public function pesquisarPorEmail(Request $request)
    {
        $profissional = Profissional::where('email', 'like', '%' . $request->email . '%')->get();
        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Não há resultados na pesquisa"
        ]);
    }


            // Função de pesquisa por Celular
    public function pesquisarPorCelular(Request $request)
    {
        $profissional = Profissional::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Não há resultados na pesquisa"
        ]);
    }

    // Função de exclusão
    public function excluir($id)
    {
        $profissional= Profissional::find($id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        $profissional->delete();
        return response()->json([
            'status' => true,
            'message' => "Serviço excluído com sucesso"
        ]);
    }

    // Função de retornar todos os profissionais cadastrados no banco de dados
    public function retornarTodos()
    {
        $profissional = Profissional::all();
        return response()->json([
            'status' => true,
            'data' => $profissional
        ]);
    }


        // Função de dar update nos campos 
        // A função If Isset é utilizada para chegar se a variável está vazia ou com algum valor determinado
        public function update(ProfissionalFormRequest $request)
        {
            $profissional = Profissional::find($request->id);
    
            if (!isset($profissional)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Profissional não encontrado'
                ]);
            }
    
            if (isset($request->nome)) {
                $profissional->nome = $request->nome;
            }
    
    
            if (isset($request->celular)) {
                $profissional->celular = $request->celular;
            }
    
            if (isset($request->email)) {
                $profissional->email = $request->email;
            }
    
            if (isset($request->dataNascimento)) {
                $profissional->dataNascimento = $request->dataNascimento;
            }
            if (isset($request->cidade)) {
                $profissional->cidade = $request->cidade;
            }
            if (isset($request->estado)) {
                $profissional->estado = $request->estado;
            }
            if (isset($request->pais)) {
                $profissional->pais = $request->pais;
            }
            if (isset($request->numero)) {
                $profissional->numero = $request->numero;
            }
            if (isset($request->bairro)) {
                $profissional->bairro = $request->bairro;
            }
            if (isset($request->cep)) {
                $profissional->cep = $request->cep;
            }
            if (isset($request->complemento)) {
                $profissional->complemento = $request->complemento;
            }
            if (isset($request->senha)) {
                $profissional->senha = $request->senha;
            }

            if (isset($request->salario)) {
                $profissional->salario = $request->salario;
            }
    
            $profissional->update();
    
            return response()->json([
                'status' => true,
                'message' => 'Profissional atualizado'
            ]);
        }

        public function esqueciMinhaSenha(Request $request)
    {
       $profissional = Profissional::where('email', 'LIKE', $request->email)->first();
       if ($profissional) {
           $novaSenha = $profissional->cpf;
           $profissional->update([
               'senha' => //Hash::make
               ($novaSenha),
               'updated_at' => now()
           ]);
           return response()->json([        
               'status' => true,
               'message' => 'Senha redefinida',
               'nova_senha' => Hash::make($novaSenha)
           ]);
       } else {
           return response()->json([
               'status' => false,
               'message' => 'Profissional não encontrado'
           ]);
       }
    }
}
