<?php

namespace App\Http\Controllers\chat;

use App\Atacadista;
use App\Chat;
use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Route;

class ChatController extends Controller
{
    public function listarchatweb(){

        if(!key_exists('email',session()->all())){
            return view('auth.login');
        }else{

            $usuario = Chat::findByid( session()->all()['id']);

            $usuario = collect($usuario)->map(function ($item) {
                return (object) $item;
            });

            return view('admin.user.chat',compact('usuario'));
       }
    }

    public function chatAdd(Request $request)
    {
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));

            if(Chat::where('ID_COLATION', $data->colationId)->limit(1)->orderBy('ID_COLATION','desc')->get()->count() === 0){
                try{
                    Chat::addchatApp($data);
                }catch (Exception $e) {
                    return $response = [
                        'chat' => 'erro ao cadastrar chat!'
                    ];
                }

            }
            $chat = Chat::getchat($data->colationId);

            $response = [
                'chat' => $chat
            ];
            return response()->json(compact('response'),200);
        }else{
            $data = json_decode(json_encode($request->input, true));
           
            if(Chat::where('ID_COLATION', $data[2])->limit(1)->orderBy('ID_COLATION','desc')->get()->count() === 0){
              
                Chat::addchat($data);
            }
            $chat = Chat::where('ID_COLATION', $data[2])->limit(1)->orderBy('ID_COLATION','desc')->get();

            return $chat;
        }
    }

    public function chatDelete(Request $request){
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));

            $chat = Chat::remove($data->chatColation);

            $response = [
                'chat' => $chat
            ];
            return response()->json(compact('response'),200);
        }else{

            $chat = Chat::remove($request->input);

            return $chat;
        }

    }

    public function listarchatApp($id){

        //$chat = Chat::where('ID_ANUNCIANTE', $id)->orWhere('ID_PRODUTOR', $id)->get();

        $usuario = Chat::findByid( $id);

        if(isset($usuario['0']['menssagem'])){
            if($usuario['0']['menssagem'] == 'sem conversa'){
                $response = [];
            }

        }else{
            $response = [
                'chat' => $usuario
            ];
        }

        return response()->json(compact('response'),200);
    }

    public function chatnotication(Request $request){

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $data = json_decode(json_encode($request['request'], true));
            
            //usar coletion para verificar atacadista e comprador
            //$receiver =  Comprador::where('ID_COMPRADOR',$data->receiverId)->select('DS_TOKEN')->first();
            //$user =  Comprador::where('ID_COMPRADOR',$data->senderId)->select('DS_NOME','DS_FOTO_COMPRADOR')->first();
            $chat = Chat::where('ID_COLATION',$data->chatId)->select('ID_COMPRADOR')->first();
           
            if($chat->ID_COMPRADOR == $data->receiverId){
                
                $receiver = Comprador::where('ID_COMPRADOR', $data->receiverId)->select('DS_TOKEN')->first();
               
                $user = Comprador::join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->where('TB_PRODUTOR.ID_COMPRADOR', $data->senderId)->select('DS_NOME_FANTASIA as nome', 'TB_COMPRADOR.DS_FOTO_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->first();
                
            }else{
                
                $receiver = Atacadista::join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')->where('TB_PRODUTOR.ID_COMPRADOR', $data->receiverId)->select('TB_COMPRADOR.DS_TOKEN')->first();
                
                $user =Comprador::join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->where('TB_COMPRADOR.ID_COMPRADOR', $data->senderId)->select('TB_COMPRADOR.DS_NOME as nome', 'TB_COMPRADOR.DS_FOTO_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->first();
                
            }

           
           // $receiver->DS_TOKEN
           
            if ($receiver->DS_TOKEN != NULL) {

                $notify = Chat::notification($data, $receiver, $user, $data->chatMessage, $user->ID_COMPRADOR);

                if($notify == 1){
                    $data = [
                        'sucessId' => 200,
                        'sucessMessage' => 'notificação enviada!'
                    ];
                    $response = [
                        'sucess' => $data
                    ];

                    return response()->json(compact('response'));
                }else{
                    $error = [
                        'errorId' => 500,
                        'errorMessage' => 'Não foi possivel enviar a notificação'
                    ];
                    $response = [
                        'error' => $error
                    ];

                    return response()->json(compact('response'));
                }

            }else{
                return ("sem token");
            }

        }else {
            $data = $request['input'];
//            $user = Comprador::where('ID_ANUNCIANTE', $data['senderId'])->select('DS_NOME', 'DS_FOTO_COMPRADOR')->first();
            $chat = Chat::where('ID_COLATION',$data['chatId'])->select('ID_COMPRADOR')->first();

            if($chat->ID_COMPRADOR == $data['receiverId']){

                $receiver = Comprador::where('ID_COMPRADOR', $data['receiverId'])->select('DS_TOKEN')->first();

                $user = Comprador::join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->where('TB_PRODUTOR.ID_PRODUTOR', $data['senderId'])->select('DS_NOME_FANTASIA as nome', 'DS_FOTO_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->first();


            }else{
               
                $receiver = Atacadista::join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')->where('ID_PRODUTOR', $data['receiverId'])->select('TB_COMPRADOR.DS_TOKEN')->first();
               
                $user = Comprador::join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->where('TB_PRODUTOR.ID_PRODUTOR', $data['receiverId'])->select('DS_NOME as nome', 'DS_FOTO_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')->first();
            }

            if ($receiver->DS_TOKEN != NULL) {
                $notify = Chat::notification($data, $receiver, $user, $data['chatMessage'], $user->ID_COMPRADOR);

                if($notify == 1){
                    return "OK";

                }else{
                    return "erro";
                }
            }else{
                return ("sem token");
            }
        }
    }

    public function UsuarioConversa($colation, $id){
       
        $conversas = Chat::conversas($colation, $id);
      
        return response()->json(compact('conversas'),200);
        
    }
}

