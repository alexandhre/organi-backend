<?php

namespace App\Http\Controllers\usuario;

use App\Http\Controllers\AuthController;
use App\User;
use App\Usuario;
use App\PessoaFisica;
use App\PessoaJuridica;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth){

        $this->jwtAuth = $jwtAuth;
    }

    //LISTAR TODOS OS USUARIOS
    public function listar()
    {

        $user = Usuario::listaUsuario();

        $response = [
            'usuarios' => $user

        ];

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));

        }else{
            echo "controller usuario";
            exit();
        }


    }

    //lista Um usuario especifico
    public function listarUsuario($ID_USUARIO)
    {

        $listaUsuario = Usuario::findById($ID_USUARIO);


        foreach ($listaUsuario as $item){
            $usuario =[
              'id_perfil'=> $item->ID_PERFIL_USUARIO
            ];
        }

        $pessoa = Usuario::findByPessoa($ID_USUARIO, $usuario['id_perfil']);

        $response = Usuario::retornaJson($listaUsuario, $pessoa);


        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));

        }else{
            echo "controller usuario";
            exit();
        }

    }

    //registra um usuario
    public function register(Request $request)
    {
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'id_perfil' => $data->perfilId,
            'name' => $data->nome,
            'email' => $data->email,
            'password' => $data->password
        ];

        $validator = \Validator::make($credentials, [
            "id_perfil" => "required",
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required",
        ]);

        //vai na classe de validator e ver se tem como editar os erros para como a gente quer
        if($validator->fails()){
            $error = response()->json(['error' => 'invalid_credentials'], 428);
            $error = [
                'errorId' => 428,
                'errorMessage' => 'Usuário já autenticado no sistema!'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'),428);
        } else {
            //$return_user = User::createUserApp($credentials);
            $return_user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
            ]);

                //$update_user = Usuario::createUsuarioApp($credentials, DB::getPdo()->lastInsertId());
                $userInfo = Usuario::create([
                    'ID_PERFIL_USUARIO' => $credentials['id_perfil'],
                    'DS_NOME' => $credentials['name'],
                    'DS_EMAIL' => $credentials['email'],
                    'DS_SENHA' => bcrypt($credentials['password']),
                    'id_users' => DB::getPdo()->lastInsertId()
                ]);
                if($credentials['id_perfil'] == 1){
                    $pessoaFisica = PessoaFisica::create([
                        'ID_USUARIO' => DB::getPdo()->lastInsertId()
                    ]);
                }else if($credentials['id_perfil'] == 2){
                    $pessoaJuridica = PessoaJuridica::create([
                        'ID_USUARIO' => DB::getPdo()->lastInsertId()
                    ]);
                }
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Usuário cadastrado com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];

        }

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));

        }else{
            echo "controller usuario";
            exit();
        }

    }

    //login um usuario
    public function login(Request $request)
    {

        // grab credentials from the request
        $json = $request->all();
        //$data =  JSON::convertJSONToWeb($json);

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

        //cria array de credenciais para validacao
        $credentials = [
            'email' => $data->email,
            'password' => $data->password
        ];
        //attempt to verify the credentials and create a token for the user
        if (!$token = $this->jwtAuth->attempt($credentials)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        //autenticacao via token
        $aux = $this->jwtAuth->authenticate($token);

        //criacao da data e array de autenticacao
        $data = date('Y-m-d H:i:s');
        $authentication = array('token'=>$token, 'creationDate'=>date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($data))),'validTime'=>date('Y-m-d H:i:s', strtotime('+2 day', strtotime($data))));

        //procurar usuario via email
        $usuario = Usuario::findByEmail($credentials['email']);

        foreach($usuario as $item){
            $id_user = $item->ID_USUARIO;
            $id_perfil = $item->ID_PERFIL_USUARIO;
        }

        //update token na tabela de usuario
        $updateToken = Usuario::updateToken($authentication, $id_user);

        //procurar pessoa via id
        $pessoa = Usuario::findByPessoa($id_user, $id_perfil);

        //Monta o retorno em Josn
        $user = Usuario::retornaJson($usuario, $pessoa);


        $response = [
            'authentication' => $authentication,
            'usuario' => $user
        ];

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));
        }else{
            echo "controller usuario";
            exit();
        }
    }

    //editar um usuario
    public function update(Request $request){

        $json = $request->all();

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

       //implementar updateById
        $response = Usuario::updateById($data);

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return Response()->json(compact('response'));
        }else{
            echo "controller usuario";
            exit();
        }
    }

    //editar o tipo da pessoa
    public function updatepessoa(Request $request){
        $json = $request->all();

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

        $response = Usuario::updatePessoaById($data);

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return Response()->json(compact('response'));
        }else{
            echo "controller usuario";
        }

    }

    //deletar um usuario
    public function destroy($ID_USUARIO)
    {

        Usuario::deleteById($ID_USUARIO);
        $success = [
            'successId' => 200,
            'successMessage' => 'Usuário deletado com sucesso!'
        ];
        $response = [
            'success' => $success
        ];

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));
        }else{
            echo "controller usuario";
            exit();
        }


    }

}