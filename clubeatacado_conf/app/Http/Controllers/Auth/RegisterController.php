<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Atacadista;
use App\Comprador;
use App\Http\Controllers\Controller;
use App\Http\Services\ResponseService;
use App\Http\Services\CompradorService;
use App\Http\Services\EmailService;
use App\Http\Services\SharedService;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $responseService;

    protected $compradorService;

    protected $emailService;

    protected $sharedService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CompradorService $compradorService, 
        ResponseService $responseService,
        EmailService $emailService,
        SharedService $sharedService
        )
    {
        $this->middleware('guest');
        $this->compradorService = $compradorService;
        $this->responseService = $responseService;
        $this->emailService = $emailService;
        $this->sharedService = $sharedService;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function cadastro(Request $request)
    {              
        $dados =  $this->sharedService->converterRequestToJson($request);
        
        if(Comprador::where('DS_EMAIL',$dados->DS_EMAIL)->first()){
            return $this->responseService->responseErroJson(400, 'Usuário já autenticado no sistema!');
        }

        Comprador::registrar($dados);

        $comprador = $this->compradorService->recuperarCompradorPorEmail($dados->DS_EMAIL);
                                   
        //EMAIL DE VALIDACAO
        if ($comprador) {       
            
            if($dados->IN_FORNECEDOR){
                Atacadista::registrar($comprador->ID_COMPRADOR);
            }           
        
            try {   
                $this->emailService->enviarEmail($dados->DS_EMAIL, $comprador->ID_COMPRADOR, 0, 'cadastro');
            } catch (\Exception $e) {
                return $this->responseService->responseErroJson(400, 'Erro ao validar o email!');                
            }
        }              
        return $this->responseService->responseSucessoJson(200, $this->compradorService->montarResponseComprador($comprador));

    }
}
