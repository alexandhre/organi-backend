<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CompradorService;
use App\Http\Services\SharedService;
use App\Http\Services\CidadeService;
use App\Http\Services\UsuarioService;
use App\Http\Services\ResponseService;

class CompradorController extends Controller
{

    protected $compradorService;

    protected $sharedService;

    protected $usuarioService;

    protected $cidadeService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CompradorService $compradorService,
        SharedService $sharedService,
        UsuarioService $usuarioService,
        CidadeService $cidadeService,
        ResponseService $responseService
        )
    {       
        $this->compradorService = $compradorService;
        $this->sharedService = $sharedService;
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->responseService = $responseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function atualizarComprador(Request $request)
    {       
        $validator = $this->compradorService->validarDadosUsuario($request);        
        if ($validator->fails()) {
            return redirect('perfil')
            ->withErrors($validator)
            ->withInput();
        }
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $this->compradorService->atualizarDadosComprador($dados); 
        return $this->responseService->responseSucessoJson(200, 'Usuário atualizado com sucesso!');
    }
}
