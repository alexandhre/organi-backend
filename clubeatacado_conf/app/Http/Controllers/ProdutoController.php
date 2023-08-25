<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProdutoService;
use App\Http\Services\ResponseService;
use App\Http\Services\SharedService;
use App\Http\Services\PaginationService;

class ProdutoController extends Controller
{

    protected $produtoService;

    protected $responseService;

    protected $sharedService;

    protected $paginationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProdutoService $produtoService,
        ResponseService $responseService,
        SharedService $sharedService,
        PaginationService $paginationService
    ) {
        $this->produtoService = $produtoService;
        $this->responseService = $responseService;
        $this->sharedService = $sharedService;
        $this->paginationService = $paginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produtos(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $produtos = $this->produtoService->recuperarProdutos();
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        //colocar num metodo separado                
        $response = [
            'produtos' => $produtos,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function prateleiraProdutos(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        $produtos =  $this->produtoService->listarProdutos(false, $dados->idComprador);       
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        $pagination = [
            'per_page' => $produtos['produtosPage']->perPage(),
            'on_first_page' => $produtos['produtosPage']->onFirstPage(),
            'last_page' => $produtos['produtosPage']->lastPage(),
            'first_page_url' => $produtos['produtosPage']->url(1),
            'next_page_url' => $produtos['produtosPage']->nextPageUrl(),
            'prev_page_url' => $produtos['produtosPage']->previousPageUrl(),
            'last_page_url' => $produtos['produtosPage']->url($produtos['produtosPage']->lastPage()),
            'total' => $produtos['produtosPage']->total()
        ];        
        $response = [
            'produtos' => $produtos['produtos'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'pagination' => $pagination,
            'errors' => false
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }
}
