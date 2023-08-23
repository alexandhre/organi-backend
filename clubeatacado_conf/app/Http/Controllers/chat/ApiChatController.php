<?php

namespace App\Http\Controllers\chat;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Chat;
use App\Anuncio;

class ApiChatController extends Controller
{

    public function chatcreat(Request $request){
        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'doadorId' => $data->doadorId,
            'coletorId' => $data->coletorId,
            'anuncioId' => $data->anuncioId,
        ];


        if(Anuncio::where('ID_ANUNCIO_RESIDUO', '=', $credentials['anuncioId'])
                ->where('ID_USUARIO_COLETOR', '=', $credentials['coletorId'])
                ->where('ID_USUARIO_ANUNCIANTE', '=', $credentials['doadorId'])
                ->exists()){

            $data = date('Y-m-d H:i:s');
            $idcollection = $data.$credentials['doadorId'];


            $return_user = Chat::create([
                'ID_USUARIO_DOADOR' => $credentials['doadorId'],
                'ID_USUARIO_COLETOR' => $credentials['coletorId'],
                'ID_ANUNCIO_RESIDUO' => $credentials['anuncioId'],
                'ID_COLECTION' => md5($idcollection),
            ]);

            $sucess = [
                'collectionId' => md5($idcollection)
            ];

            $response = [
                'chat' => $sucess
            ];

            return response()->json(compact('response'), 200);
        }else{

            $error = [
                'errorId' => 404,
                'errorMessage' => 'O serviço requisitado não existe ou está fora do ar  Tente novamente mais tarde!'
            ];

            $response = [
                'error' => $error
            ];

        }

        return response()->json(compact('response'), 404);
    }


    public function listarchat($id){
        $chat = Chat::findByid($id);


        return response()->json(compact('chat'), 200);
    }
}
