<?php

namespace App;

use ExponentPhpSDK\Exceptions\ExpoException;
use ExponentPhpSDK\Exceptions\UnexpectedResponseException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Route;


class Chat extends Model
{
    protected $table = 'TB_CHAT';

    protected $fillable = [
        'ID_COMPRADOR'
        ,'ID_PRODUTOR'
        ,'ID_ANUNCIO_PRODUTO'
        ,'ID_COLATION'
    ];

    public static function findByid($id){
       
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/clubedoatacado-c43da-firebase-adminsdk-bhxh0-12b83d4dd0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
            
        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message');
       
        $ref[] = $conversas->getValue();
       
        $chat = [];
        
        $atacadista = Atacadista::findId($id);
       
        $usuario = Chat::where('ID_COMPRADOR',$id)->orWhere('ID_PRODUTOR',$atacadista)->select('ID_COMPRADOR','ID_PRODUTOR','ID_COLATION')->get();
        $idLogin = 0;
       
        foreach ($usuario as $key => $value){
           
            if($value->ID_PRODUTOR == $atacadista){
                $idLogin = $id;

                $usuario = User::user($value->ID_COMPRADOR);
               
            }else{
                $idLogin = $id;
                $currentPath = Route::getFacadeRoot()->current()->uri();

                $pattern = '/' . 'api' . '/';
                if (preg_match($pattern, $currentPath)) {
                    $usuario = User::userchatApp($value->ID_PRODUTOR);
                }else{
                    
                    $usuario = User::userchat($value->ID_PRODUTOR);
                   
                }

            }
            
            if(count($usuario) > 0){

                $array = end($ref['0'][$value->ID_COLATION]);

                $menssagem = $array['chatMessage'];
                $time = $array['timestamp'];
                date_default_timezone_set("america/sao_paulo");
                $date = date('d-m-y', $time/1000);
                $date = str_replace("-", "/", $date);
               
                $chat[] = [
                    'usuarioId' => $usuario['0']->id,
                    'nome'=>  $usuario['0']->nome,
                    'foto' =>  $usuario['0']->foto,
                    'colletctionId' => $value->ID_COLATION,
                    'mensagem' => $menssagem,
                    'dataMensagem' =>  $date,
                    'usuarioLogin' => "".$idLogin,
                    'review' => $usuario['0']->review
                ];
               
            }
        }

       
        $horario = array();
        foreach ($chat as $key => $row)
        {
            $horario[$key] = $row['dataMensagem'];
        }
        array_multisort($horario, SORT_DESC, $chat);

        if(count($chat) == 0 ){
            $chat[] = [
                'menssagem' =>  "sem conversa",
                'usuarioLogin' => "".$id
            ];
        }

        return $chat;
    }

    public static function addchat($input){

        $chat = DB::table('TB_CHAT')
            ->insert([
                'ID_COMPRADOR'=> intval($input[0])
                ,'ID_PRODUTOR'=> intval($input[1])
                ,'ID_ANUNCIO_PRODUTO'=> intval($input[3])
                ,'ID_COLATION'=> $input[2]
            ]);

    }

    public static function addchatApp($input){
       // dd($input);
        $chat = DB::table('TB_CHAT')
            ->insert([
                'ID_COMPRADOR' => $input->compradorId
                ,'ID_PRODUTOR'  => $input->AnuncianteId
                ,'ID_ANUNCIO_PRODUTO'  => $input->anuncioId
                ,'ID_COLATION'  => $input->colationId
            ]);

        return $chat;
    }

    public static function remove($id){
        try {
            try {
                 Chat::where('ID_COLATION',$id)->delete();
            } catch (Exception $e) {
                return $conversas = 0;
            }
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/clubedoatacado-c43da-firebase-adminsdk-bhxh0-12b83d4dd0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();

            $database = $firebase->getDatabase();

            $conversas = $database->getReference('message')->getChild($id)->remove();
            $conversas = 1;
        } catch (Exception $e) {
            return $conversas = 0;
        }
        return $conversas;
    }

    public static function notification($request,$receiver,$user, $chatMessage,$senderId ){
        
        //require_once 'C:\xampp2\htdocs\clubatacado\vendor\autoload.php';
        //require_once('C:\xampp\htdocs\clubeatacado\vendor\autoload.php');
        require_once('C:\Inetpub\vhosts\myappnow.com.br\atacado.club\clubeatacado_conf\vendor\autoload.php');
        //require_once('./includes_/mysql_functions.php');
        
        //require_once 'C:\Inetpub\vhosts\myappnow.com.br\atacado.club\clubeatacado_conf\vendor\autoload.php';
        $channelName = 'news'.substr(md5(rand(600000 , 12000000)), 0,8);
        $recipient= $receiver->DS_TOKEN;

       
        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();

        // Subscribe the recipient to the server
        $expo->subscribe($channelName, $recipient);

        // Build the notification data
        $notification = [
            'title' => $user->nome, // nome do user
            'body' => $chatMessage,   // mensagem
            'data' => [
                'message' => $request, //objeto referente à mensagem armazenada no
                'senderUser' => [  //que deve ser um objeto contendo name e profilePicture (URL)
                    'name' => $user->nome,
                    'profilePicture' => 'https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/'.$senderId.'/'.$user->DS_FOTO_COMPRADOR
                ]
            ]
        ];
        
        
        // Notify an interest with a notification
        
        try {
            $expo->notify($channelName, $notification);
            return (1);
        } catch (ExpoException $e) {
            return (0);
        } catch (UnexpectedResponseException $e) {
            return (0);
        }

    }

    public static function getchat($id){
        $chat = Chat::where('ID_COLATION', $id)->select(
                "ID_COMPRADOR as compradorId",
                "ID_PRODUTOR as atacadistaId",
                "ID_ANUNCIO_PRODUTO as anuncioId",
                "ID_COLATION as colation")->limit(1)->orderBy('ID_COLATION','desc')->get();

        return $chat;
    }

    public static function conversas($colation, $id){
       
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/http/controllers/clubedoatacado-c43da-firebase-adminsdk-bhxh0-12b83d4dd0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();

        $conversas = $database->getReference('message/');
        $ref[] = $conversas->getValue();
        $chat = $ref['0'][$colation];
        $conversas = [];
        $sender = '';
        foreach ($chat as $value){
            if($value['senderId'] === $id){
                $sender =   $value['receiverId'];     
            }else{
                $sender =  $value['senderId'];
            }
            array_push($conversas, [
                'content' => $value['chatMessage'],
                'senderId' => $value['senderId'],
                'chatId' => $value['chatId'],
                'receiverId' => $value['receiverId'],
                'usuarioLogin' => $id
            ]);
        }
        return [$conversas , $sender];
    }
}
