<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Requests\AgendaUpdateFormRequest;



class AgendaController extends Controller
{
    public function agenda(AgendaFormRequest $request)
    {
 
        $agenda =Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();
        if (count($agenda) > 0){ 
            return response()->json([
                "success" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agenda
            ], 200);
        } else{
            $agenda = Agenda::create([
                'profissional_id' => $request->profissional_id,
                'data_hora' => $request->data_hora
            ]);
            return response()->json([
                "success" => true,
                "message" => "Agendado com sucesso",
                "data" => $agenda
            ], 200);
        } 
   
    }
    public function excluir($id)
    {
        $agenda = Agenda::find($id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => "Agendamento não encontrado"
            ]);
        }
        $agenda->delete();
        return response()->json([
            'status' => true,
            'message' => "Agendamento excluído com sucesso"
        ]);
    }


    public function update(AgendaUpdateFormRequest $request)
    {
        $agendaProfissional = Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();

        if (count($agendaProfissional) > 0) {
            return response()->json([
                "status" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agendaProfissional
            ], 200);
        } else {

            $agenda = Agenda::find($request->id);

            if (!isset($agenda)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Não há resultados para a Agenda'
                ]);
            }
            if (isset($request->profissional_id)) {
                $agenda->profissional_id = $request->profissional_id;
            }
            if (isset($request->cliente)) {
                $agenda->cliente = $request->cliente;
            }
            if (isset($request->servico)) {
                $agenda->servico = $request->servico;
            }
            if (isset($request->data_hora)) {
                $agenda->data_hora = $request->data_hora;
            }
            if (isset($request->tipoPagamento)) {
                $agenda->tipoPagamento = $request->tipoPagamento;
            }
            if (isset($request->valor)) {
                $agenda->valor = $request->valor;
            }
            $agenda->update();
            return response()->json([
                'status' => true,
                'message' => 'Agenda atualizada com sucesso'
            ]);
        }
    }




    public function retornarTodos()
    {
        $agenda = Agenda::all();
        return response()->json([
            'status' => true,
            'data' => $agenda ,
            'message' => "Pesquisa encontrada com sucesso"
        ]);
    }

    public function pesquisarPorDataDoProfissional(Request $request)
    {

        if ($request->profissional_id == 0 || $request->profissional_id == '') {
            $agenda = Agenda::all();
        } else {
            $agenda = Agenda::where('profissional_id', $request->profissional_id);

            if (isset($request->data_hora)) {
                $agenda->whereDate('data_hora', '>=', $request->data_hora);
            }
            $agenda = $agenda->get();
        }

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }
}



