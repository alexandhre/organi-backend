<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\EmailService;
use App\Http\Services\SharedService;
use App\Http\Services\ResponseService;

class ContatoController extends Controller
{

    protected $emailService;

    protected $sharedService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        EmailService $emailService,
        SharedService $sharedService,
        ResponseService $responseService
        )
    {       
        $this->emailService = $emailService;
        $this->sharedService = $sharedService;
        $this->responseService = $responseService;
    }

    public function enviarMensagem(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);   
        $this->emailService->enviarEmailContato($dados);
        $response = [
            'message' => 'Mensagem enviada com sucesso!'
        ];    
        return $this->responseService->responseSucessoJson(200, $response); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {            
        $dados =  $this->sharedService->converterRequestToJson($request);   
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        $response = [
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
}
