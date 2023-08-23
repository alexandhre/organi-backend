<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\CompradorService;
use App\Http\Services\ResponseService;
use App\Http\Services\SharedService;
use App\Http\Services\AuthorizarionService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected $compradorService;

    protected $responseService;

    protected $sharedService;
    
    protected $authorizationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CompradorService $compradorService, 
        ResponseService $responseService,
        SharedService $sharedService,
        AuthorizarionService $authorizationService
        )
    {
        $this->middleware('guest', ['only'=> 'showLoginForm']);
        $this->compradorService = $compradorService;
        $this->responseService = $responseService;
        $this->sharedService = $sharedService;
        $this->authorizationService = $authorizationService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {         
        if(!key_exists('email',session()->all())){
            return view('auth.login');        
        }
        return redirect('/home');   
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function login(){

        $this->sharedService->limparUsuario();

        $credenciais = request();        

        if(!$this->compradorService->validarComprador($credenciais)) {                           
            return $this->responseService->responseErroJson(400, 'Usuário não encontrado!');   
        }
    
        $comprador = $this->compradorService->recuperarCompradorPorEmail($credenciais['email']);
               
        if(!$this->compradorService->validarCompradorAutenticado($comprador)) {                
            return $this->responseService->responseErroJson(400, 'Usuário não validado!');                    
        }    
        
        if ($this->compradorService->autenticarComprador($credenciais)) {   
            $this->compradorService->incluirCompradorNaSessao($comprador, $credenciais);            
            $this->authorizationService->salvarSessao($comprador->ID_COMPRADOR);
        } else {                                
            return $this->responseService->responseErroJson(400, 'Dados Inválidos!');        
        } 
        
       
        return $this->responseService->responseSucessoJson(200, $this->compradorService->montarResponseComprador($comprador));
    }

    public function logout(Request $request) {
    
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $this->sharedService->limparUsuario();
        $this->authorizationService->deletarSessao($dados->idComprador);
        return $this->responseService->responseSucessoJson(200, 'Logout efetuado com sucesso!');
    }
}
