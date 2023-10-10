<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Função de Cadastro de Clientes
    public function cliente(ClienteFormRequest $request)
    {
        $cliente = Cliente::create([
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
            'senha' => Hash::make($request->senha)

        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro de Cliente Feito",
            "data" => $cliente
        ], 200);
    }


    // Função de pesquisa por nome
    public function pesquisarPorNome(Request $request)
    {
        $cliente = Cliente::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Não há resultados na pesquisa"
        ]);
    }

    // Função de pesquisa por CPF
    public function pesquisarPorCpf(Request $request)
    {
        $cliente = Cliente::where('CPF', 'like', '%' . $request->cpf . '%')->get();
        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
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
        $cliente = Cliente::where('email', 'like', '%' . $request->email . '%')->get();
        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
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
        $cliente = Cliente::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
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
        $cliente = Cliente::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => "Serviço excluído com sucesso"
        ]);
    }


        // Função de retornar todos os clientes cadastrados no banco de dados
    public function retornarTodos()
    {
        $cliente = Cliente::all();
        return response()->json([
            'status' => true,
            'data' => $cliente ,
            'message' => "Pesquisa encontrada com sucesso"
        ]);
    }

        // Função de dar update nos campos 
        // A função If Isset é utilizada para chegar se a variável está vazia ou com algum valor determinado
    public function update(ClienteUpdateFormRequest $request)
    {
        $cliente = Cliente::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => 'Cliente não encontrado'
            ]);
        }

        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }


        if (isset($request->celular)) {
            $cliente->celular = $request->celular;
        }

        if (isset($request->email)) {
            $cliente->email = $request->email;
        }

        if (isset($request->dataNascimento)) {
            $cliente->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $cliente->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $cliente->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $cliente->pais = $request->pais;
        }
        if (isset($request->numero)) {
            $cliente->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $cliente->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $cliente->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $cliente->complemento = $request->complemento;
        }
        if (isset($request->senha)) {
            $cliente->senha = $request->senha;
        }

        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => 'Cliente atualizado'
        ]);
    }
}
