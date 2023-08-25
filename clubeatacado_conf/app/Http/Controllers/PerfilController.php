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
use App\Http\Services\AnuncioService;
use App\Http\Services\PaginationService;

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

    protected $anuncioService;

    protected $paginationService;

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
        ResponseService $responseService,
        AnuncioService $anuncioService,
        PaginationService $paginationService
        )
    {       
        $this->usuarioService = $usuarioService;
        $this->anuncioService = $anuncioService;
        $this->cidadeService = $cidadeService;
        $this->compradorService = $compradorService;
        $this->leilaoService = $leilaoService;
        $this->sharedService = $sharedService;
        $this->categoriaProdutoService = $categoriaProdutoService;
        $this->responseService = $responseService;
        $this->paginationService = $paginationService;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function compras(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);              
        $listaComprasUsuario =  $this->compradorService->recuperarComprasUsuario($dados->idComprador);
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 
        
        setlocale(LC_TIME, 'portuguese'); 
        date_default_timezone_set('America/Sao_Paulo');
        $dateCurrent = date('Y-m-d H:i:s'); 
        $dateCurrent=date('Y-m-d H:i:s', strtotime($dateCurrent));

        for ($i = 0; $i < count($listaComprasUsuario['listaCompras']); $i++) {
            //echo $paymentDate; // echos today! 
            $dataEntrega = date('Y-m-d', strtotime($listaComprasUsuario['listaCompras'][$i]->DT_ENTREGA));
                
            if (($dateCurrent >= $dataEntrega)){
                //Mudar logica para atualizar esse atributo quando a entrega realmente for feita
                //colocar um atributo no banco
                $listaComprasUsuario['listaCompras'][$i]->IN_ENTREGA_FEITA = 1;
            }else{
                $listaComprasUsuario['listaCompras'][$i]->IN_ENTREGA_FEITA = 0;
            }  
            
            $date = date('Y-m-d');
            $listaComprasUsuario['listaCompras'][$i]->DT_ENTREGA =  strftime("%d de %B de %Y", strtotime($listaComprasUsuario['listaCompras'][$i]->DT_ENTREGA));
            $listaComprasUsuario['listaCompras'][$i]->DT_PEDIDO =  strftime("%d de %B de %Y", strtotime($listaComprasUsuario['listaCompras'][$i]->DT_PEDIDO));
        }

        $pagination = [
            'per_page' => $listaComprasUsuario['listaComprasPage']->perPage(),
            'on_first_page' => $listaComprasUsuario['listaComprasPage']->onFirstPage(),
            'last_page' => $listaComprasUsuario['listaComprasPage']->lastPage(),
            'first_page_url' => $listaComprasUsuario['listaComprasPage']->url(1),
            'next_page_url' => $listaComprasUsuario['listaComprasPage']->nextPageUrl(),
            'prev_page_url' => $listaComprasUsuario['listaComprasPage']->previousPageUrl(),
            'last_page_url' => $listaComprasUsuario['listaComprasPage']->url($listaComprasUsuario['listaComprasPage']->lastPage()),
            'total' => $listaComprasUsuario['listaComprasPage']->total()
        ];        
        
        $response = [
            'compras' => $listaComprasUsuario['listaCompras'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'pagination' => $pagination,
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leiloes(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);        
        $leiloes = $this->leilaoService->recuperarLeiloesUsuario($dados->idComprador);
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 

        for ($i = 0; $i < count($leiloes['leiloes']); $i++) {
            $maiorValorLance = $this->leilaoService->recuperarMaiorValorLance($leiloes['leiloes'][$i]->ID_LEILAO);
            $leiloes['leiloes'][$i]->VL_LANCE_MAIOR = $maiorValorLance;
        }

        $paginationLeilao = [
            'per_page' => $leiloes['leiloesPage']->perPage(),
            'on_first_page' => $leiloes['leiloesPage']->onFirstPage(),
            'last_page' => $leiloes['leiloesPage']->lastPage(),
            'first_page_url' => $leiloes['leiloesPage']->url(1),
            'next_page_url' => $leiloes['leiloesPage']->nextPageUrl(),
            'prev_page_url' => $leiloes['leiloesPage']->previousPageUrl(),
            'last_page_url' => $leiloes['leiloesPage']->url($leiloes['leiloesPage']->lastPage()),
            'total' => $leiloes['leiloesPage']->total()
        ];   
        
        $response = [
            'leiloes' => $leiloes['leiloes'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'paginationLeilao' => $paginationLeilao
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
  
    public function produtos(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);          
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 

        $anuncios = $this->anuncioService->recuperarMeusAnuncios($dados->idComprador);

        $pagination = [
            'per_page' => $anuncios['anunciosPage']->perPage(),
            'on_first_page' => $anuncios['anunciosPage']->onFirstPage(),
            'last_page' => $anuncios['anunciosPage']->lastPage(),
            'first_page_url' => $anuncios['anunciosPage']->url(1),
            'next_page_url' => $anuncios['anunciosPage']->nextPageUrl(),
            'prev_page_url' => $anuncios['anunciosPage']->previousPageUrl(),
            'last_page_url' => $anuncios['anunciosPage']->url($anuncios['anunciosPage']->lastPage()),
            'total' => $anuncios['anunciosPage']->total()
        ];
        
        $response = [
            'anuncios' => $anuncios['anuncios'],
            'paginationAnuncio' => $pagination,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function produtosLeilao(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);     
        $leiloes = $this->leilaoService->recuperarLeiloesByUsuario($dados->idComprador);
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 

        for ($i = 0; $i < count($leiloes['leiloes']); $i++) {
            $maiorValorLance = $this->leilaoService->recuperarMaiorValorLance($leiloes['leiloes'][$i]->ID_LEILAO);
            $leiloes['leiloes'][$i]->VL_LANCE_MAIOR = $maiorValorLance;
        }

        $paginationLeilao = [
            'per_page' => $leiloes['leiloesPage']->perPage(),
            'on_first_page' => $leiloes['leiloesPage']->onFirstPage(),
            'last_page' => $leiloes['leiloesPage']->lastPage(),
            'first_page_url' => $leiloes['leiloesPage']->url(1),
            'next_page_url' => $leiloes['leiloesPage']->nextPageUrl(),
            'prev_page_url' => $leiloes['leiloesPage']->previousPageUrl(),
            'last_page_url' => $leiloes['leiloesPage']->url($leiloes['leiloesPage']->lastPage()),
            'total' => $leiloes['leiloesPage']->total()
        ];
        
        $response = [
            'leiloes' => $leiloes['leiloes'],
            'paginationLeilao' => $paginationLeilao,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function favoritos(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);     
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 

        $anuncios = $this->compradorService->recuperarFavoritosByUser($dados->idComprador);
        
        $paginationAnuncios = [
            'per_page' => $anuncios['listaFavoritosPage']->perPage(),
            'on_first_page' => $anuncios['listaFavoritosPage']->onFirstPage(),
            'last_page' => $anuncios['listaFavoritosPage']->lastPage(),
            'first_page_url' => $anuncios['listaFavoritosPage']->url(1),
            'next_page_url' => $anuncios['listaFavoritosPage']->nextPageUrl(),
            'prev_page_url' => $anuncios['listaFavoritosPage']->previousPageUrl(),
            'last_page_url' => $anuncios['listaFavoritosPage']->url($anuncios['listaFavoritosPage']->lastPage()),
            'total' => $anuncios['listaFavoritosPage']->total()
        ];   
        
        $response = [
            'anuncios' => $anuncios['listaFavoritos'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'paginationAnuncios' => $paginationAnuncios
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function favoritosLeilao(Request $request)
    {   
        $dados =  $this->sharedService->converterRequestToJson($request);     
        $leiloes = $this->leilaoService->recuperarLeiloesUsuarioFavoritos($dados->idComprador);
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 

        for ($i = 0; $i < count($leiloes['leiloes']); $i++) {
            $maiorValorLance = $this->leilaoService->recuperarMaiorValorLance($leiloes['leiloes'][$i]->ID_LEILAO);
            $leiloes['leiloes'][$i]->VL_LANCE_MAIOR = $maiorValorLance;
        }

        $paginationLeilao = [
            'per_page' => $leiloes['leiloesPage']->perPage(),
            'on_first_page' => $leiloes['leiloesPage']->onFirstPage(),
            'last_page' => $leiloes['leiloesPage']->lastPage(),
            'first_page_url' => $leiloes['leiloesPage']->url(1),
            'next_page_url' => $leiloes['leiloesPage']->nextPageUrl(),
            'prev_page_url' => $leiloes['leiloesPage']->previousPageUrl(),
            'last_page_url' => $leiloes['leiloesPage']->url($leiloes['leiloesPage']->lastPage()),
            'total' => $leiloes['leiloesPage']->total()
        ];    
        
        $response = [
            'leiloes' => $leiloes['leiloes'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'paginationLeilao' => $paginationLeilao
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function categoria(Request $request)
    {  
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $categorias = $this->categoriaProdutoService->recuperarCategorias($dados->numeroElementos);         
        $response = [
            'titulo' => "Categorias",
            'categorias' => $categorias
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
    
    public function promocao(Request $request)
    {  
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $limite = 9;
        $listaAnuncioProduto =  $this->produtoService->listarProdutos($dados->numeroElementos, $limite, true);          
        $response = [
            'titulo' => "Promoções",
            'promocoes' => $listaAnuncioProduto
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function produto(Request $request)
    {  
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $limite = 9;
        $listaProduto =  $this->produtoService->listarProdutos($dados->numeroElementos, $limite, false);          
        $response = [
            'titulo' => "Produtos",
            'produtos' => $listaProduto
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    } 
}
