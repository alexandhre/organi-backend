<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoriaProdutoService;
use Illuminate\Http\Request;
use App\Http\Services\CidadeService;
use App\Http\Services\CompradorService;
use App\Http\Services\LeilaoService;
use App\Http\Services\ResponseService;
use App\Http\Services\SharedService;
use App\Http\Services\UsuarioService;


class PerfilController extends Controller
{

    protected $usuarioService;

    protected $cidadeService;

    protected $compradorService;

    protected $leilaoService;

    protected $produtoService;

    protected $sharedService;

    protected $categoriaProdutoService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UsuarioService $usuarioService,
        CidadeService $cidadeService,
        CompradorService $compradorService,
        LeilaoService $leilaoService,
        SharedService $sharedService,
        CategoriaProdutoService $categoriaProdutoService,
        ResponseService $responseService
        )
    {       
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->compradorService = $compradorService;
        $this->leilaoService = $leilaoService;
        $this->sharedService = $sharedService;
        $this->categoriaProdutoService = $categoriaProdutoService;
        $this->responseService = $responseService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        dd(123);          
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $dadosUsuario = $this->usuarioService->recuperarDadosUsuario($dados->idComprador);
        $cidades = $this->cidadeService->recuperarCidades();
        $response = [
            'usuario' => $dadosUsuario,
            'cidades' => $cidades
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }  
}
