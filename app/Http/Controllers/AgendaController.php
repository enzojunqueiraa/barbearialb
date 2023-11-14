<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function agendaCriar(AgendaFormRequest $request){
        $agenda = Agenda::create([
            'profissional_id' => $request->profissional_id,
            'data_hora' => $request->data,
           


        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro Agenda",
            "data"=> $agenda
        ], 200);
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


    public function update(AgendaFormRequest  $request)
    {
        $agenda = Agenda::find($request->id);
        if(!isset($agenda)){
        return response()->json([
            'status' => false,
            'message' => 'Agendamento não encontrado'
        ]);
    }

        if (isset($request->profissional)) {
            $agenda->profissional = $request->profissional;
        }
        if (isset($request->data)) {
            $agenda->data = $request->data;
        }
        $agenda->update();

        return response()->json([
            'status' => true,
            'message' => 'Serviço atualizado'
        ]);
    }
}


