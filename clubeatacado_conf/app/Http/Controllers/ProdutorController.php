<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CompradorService;
use App\Http\Services\SharedService;
use App\Http\Services\CidadeService;
use App\Http\Services\UsuarioService;
use App\Http\Services\DocumentService;
use App\Http\Services\ResponseService;

class ProdutorController extends Controller
{

    protected $compradorService;

    protected $sharedService;

    protected $usuarioService;

    protected $cidadeService;

    protected $documentService;

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
        DocumentService $documentService,
        ResponseService $responseService
        )
    {       
        $this->compradorService = $compradorService;
        $this->sharedService = $sharedService;
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->documentService = $documentService;
        $this->responseService = $responseService;
    }

    public function produtorPage(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);       

        $cidades = $this->cidadeService->recuperarCidades(); 
        $tipoNegocioLista = $this->usuarioService->recuperarTipoNegocioEmpresa(); 
        $categorias = $this->usuarioService->recuperarCategoriaEmpresa(); 
        $dadosUsuario = $this->usuarioService->recuperarDadosProdutor($dados->idComprador); 
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 
        $response = [
            'cidades' => $cidades,
            'tipoNegocioLista' => $tipoNegocioLista,
            'categoriaEmpresa' => $categorias,
            'dadosUsuario' => $dadosUsuario,
            'error' => false,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' =>  $numberFavorito         
        ];   
        return $this->responseService->responseSucessoJson(200, $response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function atualizarProdutor(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);                                    
        $idRepresentanteLegal = $this->usuarioService->recuperarRepresentanteLegal($dados);  
        $this->usuarioService->atualizarRepresentanteLegal($dados, $idRepresentanteLegal);               
        $this->usuarioService->atualizarDadosProdutor($dados);     

        $responseUploadLogotipo = $this->documentService->cadastrarLogotipo($dados->logotipo, $dados->idProdutor);  
                        
        if($responseUploadLogotipo["erro"]){
            $response = [
                'message' => 'Erro ao fazer upload do logotipo!',
                'error' => true,
            ];
            return $this->responseService->responseSucessoJson(200, $response);                
        }         
        
        $response = [
            'message' => 'Produtor Atualizado com Sucesso!',
            'error' => false,
        ];   
        return $this->responseService->responseSucessoJson(200, $response); 
    }
}
