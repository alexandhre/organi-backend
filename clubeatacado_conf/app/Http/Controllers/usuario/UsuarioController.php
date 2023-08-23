<?php

namespace App\Http\Controllers\usuario;

use App\Anuncio;
use App\Atacadista;
use App\Categoria;
use App\Comprador;
use App\FotoAtacadista;
use App\Notifications\EmailValidade;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
//use  Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Services\ResponseService;

class UsuarioController extends Controller
{

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( 
        ResponseService $responseService
        )
    {
        $this->responseService = $responseService;
    }

    /**
     * @var JWTAuth
     */
//    private $jwtAuth;
//
//    public function AuthRouteAPI(Request $request){
//        return $request->user();
//    }

    public function abrirTelaValidarUsuario()
    {
        dd(123333);
        return view('auth.passwords.validacao');

    }

    public function index(){

        dd(123);

        // $promocoes = Anuncio::listaPromocoesWeb();
        // $categorias = Categoria::listarTipocategoriasWeb();

        // return view('index',compact('promocoes','categorias'));
        return view('index');
    }

    public function carrinho(){
        if (key_exists('email', session()->all())) {
            return view('admin.user.carrinho');
        } else {

            return view('auth.login');
        }
    }

//    public function __construct(JWTAuth $jwtAuth){
//
//        $this->jwtAuth = $jwtAuth;
//    }

    public function register(Request $request){

       $json = $request->all();


       //converte json em tipo data
       $data = json_decode(json_encode($json['request']['usuario'],true));

       //cria array de credenciais para validacao
       $credentials = [
           'name' => $data->nome,
           'email' => $data->email,
           'password' => $data->senha,
       ];

       $usuario = User::where('DS_EMAIL', $credentials['email'])->first();

       if(count($usuario)>=1) {
           $error = [
               'errorId' => 500,
               'errorMessage' => 'Usuário já autenticado no sistema!'
           ];

           $response = [
               'error' => $error
           ];
           return response()->json(compact('response'), 200);
       }else{
           $credentials['id_perfil'] = 1;

           $perfil = Comprador::registrar($credentials);

           $user = Comprador::where('DS_EMAIL',$credentials['email'])->first();

           $perfil = Atacadista::registrar($credentials, $user->ID_COMPRADOR);
//


           //EMAIL DE VALIDACAO
           if ($user) {

               $invitedUser = new User;

               $invitedUser->email = $user->DS_EMAIL;

               try {
//                    $invitedUser->notify(
//                        new EmailValidade($user->ID_COMPRADOR)
//                    );

                   $success = [
                       'successId' => 200,
                       'successMessage' => 'Usuário cadastrado com sucesso!'
                   ];
                   $response = [
                       'success' => $success
                   ];
                   return response()->json(compact('response'),200);
               } catch (Exception $e) {
                   $error = [
                       'errorId' => 404,
                       'errorMessage' => 'Erro ao enviar email de validação'
                   ];
                   $response = [
                       'error' => $error
                   ];
                   return response()->json(compact('response'),200);
               }
           }else{
               $error = [
                   'errorId' => 404,
                   'errorMessage' => 'O serviço requisitado não existe ou está fora do ar  Tente novamente mais tarde!.'
               ];
               $response = [
                   'error' => $error
               ];
               return response()->json(compact('response'),200);
           }
       }
    }

    public function login(Request $request)
    {

        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data

        $data = json_decode(json_encode($json['request']['usuario'],true));
     
        //cria array de credenciais para validacao
        $credentials = [
            'email' => $data->email,
            'password' => $data->password,
            'expoToken' => $data->token
        ];
       
//        $user = User::validacao($credentials['email']);
//        foreach ($user as $item){
//            $validate = $item;
//        }

        if(1 == 1){

            // Get user by email
            $company = User::where('DS_EMAIL', $credentials['email'])->first();
           

            // Validate Company
            if(!$company) {
                $error = [
                    'errorId' => 404,
                    'errorMessage' => 'usuário inexistente'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'));
            }

            // Validate Password
            if (!Hash::check($credentials['password'], $company->DS_SENHA)) {

                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'usuário ou senha errada'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'), 200);
            }else{

                //autenticacao via token
                // Generate Token
                $token = JWTAuth::fromUser($company);

                // Get expiration time
                $objectToken = JWTAuth::setToken($token);

                $expiration = JWTAuth::decode($objectToken->getToken())->get('exp');
                
                //criacao da data e array de autenticacao
                $data = date('Y-m-d H:i:s');
                $authentication = array('token' => $token, 'creationDate' => date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($data))), 'validTime' => date('Y-m-d H:i:s', strtotime('+2 day', strtotime($data))));
               
                $toke = User::where('DS_EMAIL', $credentials['email'])->update(['DS_TOKEN' => $credentials['expoToken']]);
               
//                procurar usuario via email
                $usuario = User::where('DS_EMAIL',$credentials['email'])->first();
              
                $user = Atacadista::usuario($usuario->ID_COMPRADOR);
               
                $response = [
                    'authentication' => $authentication,
                    'usuario' => $user['0']
                ];

                return response()->json(compact('response'));
            }
        } else{
            $error = [
                'errorId' => 428,
                'errorMessage' => 'Usuário não autenticado'
            ];
            $response = [
                'error' => $error
            ];

            return response()->json(compact('response'));
        }
    }
    public function logout(Request $request){
        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data

        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'email' => $data->email,
        ];

        $toke = User::where('DS_EMAIL', $credentials['email'])->update(['DS_TOKEN' => NULL]);

        if($toke == 1){
            $data = [
                'sucessId' => 200,
                'sucessMessage' => 'token deletado!'
            ];
            $response = [
                'sucess' => $data
            ];

            return response()->json(compact('response'));
        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'Não foi possivel deletar token'
            ];
            $response = [
                'error' => $error
            ];

            return response()->json(compact('response'));
        }

    }
    public function listarUsuario($id){

        //implementar updateById
        $response = Atacadista::usuario($id);
        $response = [
            'usuario' => $response['0']
        ];

        return Response()->json(compact('response'));

    }

    public function listarUsuarioWeb($id){

        //implementar updateById
        $usuario = Atacadista::usuario($id);
            

        return $usuario;

    }

    //editar um usuario
    public function updateApi(Request $request){
        $json = $request->all();
               
        $data = json_decode(json_encode($json['request']['usuario'],true));        
        
        //implementar updateById
        $response = Atacadista::updateById($data);       
        if($response == 0){          
            //implementar updateById
            $response = Comprador::updateById($data);        
        }        
    
        if($response != 0){
            $success = [
                'successId' => 200,
                'successMessage' => 'Usuário atualizado com sucesso!'
            ];
            $response = [
                'success' => $success
            ];
        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'Não foi possivel atualizar os dados'
            ];
            $response = [
                'error' => $error
            ];
        }

        return Response()->json(compact('response'));

    }
    public function uploadFotoUsuario(Request $request){
        $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\\atacado.club\\clubeatacado\\images\\resource\\tmp\\usuarios\\");


        if($request->has('myFile')){
            $image = $request->file('myFile');

            $name = $_FILES['myFile']['name'];

            $extension = $_FILES['myFile']['type'];

            $launch = explode("/", $extension);

            $form = end($launch);
            $name = $name.'.'.$form;


            //$image->move($destinationPath, $name.'.'.$form);
            if(move_uploaded_file($image, $destinationPath.$name)){
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Imagem salva com sucesso!'
                ];
                $response = [
                    'success' => $name

                ];
            }else{
                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'arquivo nao foi pode ser enviado'
                ];
                $response = [
                    'error' => $name
                ];
            }


        }else{
            $error = [
                'errorId' => 500,
                'errorMessage' => 'arquivo nao existe'
            ];
            $response = [
                'error' => $request
            ];
        }

        return response()->json(compact('response'));


    }

    public function updateweb(Request $request){

        $user = $request->input;

        $usuario = session()->all()['id'];
        try{
            $response = Comprador::updateByIdWeb($user, $usuario);
        }catch(Exception $e){
            return 0;
        }

        try{
            $response = Atacadista::updateByIdWeb($user, $usuario);
        }catch(Exception $e){
            return 0;
        }

        return 1;
    }
    public function uploadfotousuarioweb(Request $request){
        $id = session()->all()['id'];

        $idUsers = session()->all()['id'];


        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');


            //$image = $request->file('myFile');
            $name = $image->getClientOriginalName();

            chmod("images\\resource\\tmp\\usuarios",0777);

            $destinationPath = ("images\\resource\\tmp\\usuarios");

            if($image->move($destinationPath, $name)){
                return $name;
            }else{
                return "erro imagem!!";
            }



        }else{
            return "sem imagem!!";
        }
    }

    public function uploadfotoempresaweb(Request $request){
        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');
            $tamanho = getimagesize($image);


            if(($image != null) &&($tamanho[0] < 2*$tamanho[1])&&($tamanho[1] < 2*$tamanho[0])) {
                $destinationPath = ('C:\Inetpub\\vhosts\myappnow.com.br\atacado.club\clubeatacado\images\resource\tmp\empresa');
                if(!file_exists($destinationPath)){
                    mkdir($destinationPath,0777,true);
                    chmod($destinationPath,0777);
                }
                $image->move($destinationPath, $image->getClientOriginalName());

            }else{
                return "erro imagem!!";
            }
        }else{
            return "sem imagem!!";
        }

    }
    //deletar Usuario
    public function destroy($id){
        User::deleteById($id);

        $success = [
            'successId' => 200,
            'successMessage' => 'Usuário deletado com sucesso!'
        ];
        $response = [
            'success' => $success
        ];

        return response()->json(compact('response'));
    }

    public function addFavoritos($id, $anuncio){

        $id_comprador = User::findIdUsuario($id);
        $id_comprador = intval($id_comprador['0']->ID_COMPRADOR);

        $favorito = Anuncio::favoritosAdd($id_comprador,$anuncio);

        if($favorito == 1){
            $success = [
                'successId' => 200,
                'successMessage' => 'Anuncio adicionado com sucesso!'
            ];
            $response = [
                'success' => $success
            ];
            return response()->json(compact('response'), 200);

        }else if($favorito == 2){
            $error = [
                'Erro' => 428,
                'ErroMessage' => 'Anuncio já adcionado'
            ];
            $response = [
                'Error' => $error
            ];
            return response()->json(compact('response'), 428);

        }else{
            $error = [
                'Erro' => 500,
                'ErroMessage' => 'Erro ao adicionar anuncio'
            ];
            $response = [
                'Error' => $error
            ];
            return response()->json(compact('response'),500);

        }
    }
    public function addFavoritoApp($idAnuncio, $id){

        $favorito = Anuncio::favoritosAdd(intval($idAnuncio), intval($id));
        $response = [
            'success' => $favorito
        ];
        return response()->json(compact('response'),200);

    }
    public function addFavoritosWeb($anuncio){
        if (!key_exists('email',session()->all())) {
           return 3;
        } else {

            $favorito = Anuncio::favoritosAdd(session()->all()['id'], $anuncio);

            return $favorito;

        }
    }

    public function listarFavoritos($id_comprador){

            $anuncios = Anuncio::listarFavoritos($id_comprador);

            $response =[
                'anuncio' => $anuncios
            ];

            return response()->json(compact('response'));

    }
    public function listarFavoritosweb(){
        if(!key_exists('email',session()->all())){
            return view('auth.login');
        }else {
            $anuncios = Anuncio::listarFavoritos(session()->all()['id']);

            return view('admin.user.favoritos', compact('anuncios'));
        }
    }

    public function removeFavoritos($id, $anuncio){

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {

            $id_comprador = User::findIdUsuario($id);
            $id_comprador = intval($id_comprador['0']->ID_COMPRADOR);

            $remove = Anuncio::removeFavorito($id_comprador,$anuncio);
            if($remove == 1){
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Removido com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];
                return response()->json(compact('response'), 200);

            }else if($remove == 2){
                $error = [
                    'Erro' => 428,
                    'ErroMessage' => 'Não foi encontrado'
                ];
                $response = [
                    'Error' => $error
                ];
                return response()->json(compact('response'), 428);

            }else{
                $error = [
                    'Erro' => 500,
                    'ErroMessage' => 'Erro ao deletar favorito'
                ];
                $response = [
                    'Error' => $error
                ];
                return response()->json(compact('response'),500);

            }
        }else{
            $id_comprador = User::findIdUsuario(Auth::User()->id);
            $id_comprador = intval($id_comprador['0']->ID_COMPRADOR);

            $remove = Anuncio::removeFavorito($id_comprador,$anuncio);
            if($remove == 1){
                return response()->json(['successMessage' => 'Removido com sucesso'], 200);

            }else if($remove == 2){

                return response()->json(['error' => 'Não foi encontrado'], 404);

            }else{

                return response()->json(['error' => 'Erro ao deletar favorito'], 500);

            }

        }
    }

    public function usuario()
    {

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function refresh(){

//       $token = $this->jwtAuth->getToken();
//       $token = $this->jwtAuth->refresh($token);
//
//        return response()->json(compact('token'));
    }

    public function editar(){

        try{
            
            if(key_exists('email', session()->all())){
               
                $listaUsers = User::userdetail(session()->all()['id']);
                //return $listaUsers;              
                return view('admin.user.dadosparticular', compact('listaUsers'));

            }else{
                return view('auth.login');
            }

        } catch (\Exception $e) {

            return response()->json([
                "erros"=>[
                    "title" => "Erro inesperado",
                    "line" => $e->getLine(),
                    "file" => $e->getFile(),
                    "msg" => $e->getMessage(),
                ],
                "message" => 'Error'
            ]);
            
        }

    }

    public function chat(){

        return view('admin.user.chat');

    }

    public function empresaFoto($id){
        $fotoEmpresa = Atacadista::empresaFoto($id);

        return $fotoEmpresa;
    }
    public function verificacao($id){

        try {
            User::verificacao($id);
            $validacao = 1;
            return $this->responseService->responseSucessoJson(200, 'Usuário ativado com sucesso.');
        } catch (Exception $e) {
           return $this->responseService->responseSucessoJson(400, 'Erro na ativação do usuário.');
        }
    }
    public function novasenha(){

        return view('auth.passwords.novasenha');
    }

    public function getEstados(){
         $estados = Comprador::getEstados();

         $response = [
             'estados' => $estados
         ];

        return response()->json(compact('response'));

    }

    public function listCidade(Request $uf){

        $cidades = Comprador::getCidades($uf->uf);
        return $cidades;
    }
    public function getCidades($id){
        $cidades = Comprador::getCidades($id);

        $response = [
            'cidade' => $cidades
        ];

        return response()->json(compact('response'));

    }

    public function UsuarioChatInfo($id_anuncio){

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $usuario = User::userchat($id_anuncio);

        }else{
            $usuario = User::userchat($id_anuncio);
        }
        return $usuario;
    }

    public function info(){
        $usuario = User::infos();

        $response = [
            'infos' => $usuario
        ];

        return response()->json(compact('response'));
    }


    public function logado(){
       
        if (key_exists('email', session()->all())) {
        
            return 1;
        } else {
            return 0;
        }
    }
}
