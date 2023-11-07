<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;




// Função de Cadastro dos Serviços
class ServicoController extends Controller
{
    public function barbearialb(ServicoFormRequest $request){
        $barbearialb = Servico::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'preco' => str_replace(',' , '.' ,$request->preco)
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro Serviço",
            "data"=> $barbearialb
        ], 200);
    }

    // Função de pesquisa por id
    public function pesquisarPorId($id)
    {
        $barbearialb = Servico::find($id);
        if ($barbearialb == null) {
           return response()->json([
               'status' => false,
               'message' => "Usuário não encontrado"
           ]);
       }
       return response()->json([
           'status' => true,
           'data' => $barbearialb
       ]);
    }

    // Função de pesquisa por Nome
    public function pesquisarPorNome(Request $request)
    {   
        $barbearialb = Servico::where('nome', 'like', '%' . $request->nome . '%')->get();
        if(count($barbearialb) > 0){
        return response()->json([
            'status' => true,
            'data' => $barbearialb
        ]);
    }
    return response()->json([
        'status' => true ,
        'message' => "Não há resultados na pesquisa"
    ]);
    }

    public function pesquisarPorCpf(Request $request)
    {   
        $barbearialb = Servico::where('cpf', 'like', '%' . $request->cpf . '%')->get();
        if(count($barbearialb) > 0){
        return response()->json([
            'status' => true,
            'data' => $barbearialb
        ]);
    }
    return response()->json([
        'status' => true ,
        'message' => "Não há resultados na pesquisa"
    ]);
    }

    public function pesquisarPorDescricao(Request $request)
    {
        $barbearialb = Servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();
        if(count($barbearialb) > 0){
        return response()->json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    }


    // Função para excluir os serviços
    public function excluir($id)
    {
        $barbearialb = Servico::find($id);

        if (!isset($barbearialb)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        $barbearialb->delete();
        return response()->json([
            'status' => true,
            'message' => "Serviço excluído com sucesso"
        ]);
    }

    // Função para dar update nos campos
     // A função If Isset é utilizada para chegar se a variável está vazia ou com algum valor determinado
    public function update(UpdateFormRequest $request)
    {
        $barbearialb = Servico::find($request->id);
        if(!isset($barbearialb)){
        return response()->json([
            'status' => false,
            'message' => 'Serviço não encontrado'
        ]);
    }

        if (isset($request->nome)) {
            $barbearialb->nome= $request->nome;
        }


        if (isset($request->descricao)) {
            $barbearialb->descricao = $request->descricao;
        }

        if (isset($request->duracao)) {
            $barbearialb->duracao = $request->duracao;
        }

        if (isset($request->preco)) {
            $barbearialb->preco = $request->preco;
        }
        $barbearialb->update();

        return response()->json([
            'status' => true,
            'message' => 'Serviço atualizado'
        ]);
    }

    // Função parar retornar todos os serviços
    public function retornarTodos()
    {
        $barbearialb = Servico::all();
        return response()->json([
            'status' => true,
            'data' => $barbearialb
        ]);
    }
}

