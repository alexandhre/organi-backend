<?php

namespace App\Http\Controllers;

use App\Http\Services\CarrinhoService;
use Illuminate\Http\Request;
use App\Http\Services\CategoriaProdutoService;
use App\Http\Services\ProdutoService;
use App\Http\Services\SharedService;
use App\Http\Services\ResponseService;
use App\Http\Services\AuthorizarionService;

class IndexController extends Controller
{

    protected $categoriaProdutoService;

    protected $produtoService;

    protected $sharedService;

    protected $responseService;

    protected $carrinhoService;

    protected $authorizationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoriaProdutoService $categoriaProdutoService,
        ProdutoService $produtoService,
        ResponseService $responseService,
        SharedService $sharedService,
        CarrinhoService $carrinhoService,
        AuthorizarionService $authorizationService
        )
    {       
        $this->categoriaProdutoService = $categoriaProdutoService;
        $this->produtoService = $produtoService;
        $this->sharedService = $sharedService;
        $this->responseService = $responseService;
        $this->carrinhoService = $carrinhoService;
        $this->authorizationService = $authorizationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(!key_exists('email',session()->all())){
            return view('auth.login');        
        }                      
        //Transformar esse 3 em constante            
        $categorias = $this->categoriaProdutoService->recuperarCategorias(3);        
        $listaAnuncioProduto =  $this->produtoService->listarProdutos(0, 3, false, session()->all()['id']);
        return view('index', compact('listaAnuncioProduto', 'categorias'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produtos(Request $request)
    {        
        $dados =  $this->sharedService->converterRequestToJson($request);   
        if ($dados->idComprador != 0 && !$this->authorizationService->validarSessao($dados->idComprador)) {
            $this->authorizationService->deletarSessao($dados->idComprador);
            $response = [
                'message' => 'Sessão expirada, por favor faça novamente o login!'
            ];    
            return $this->responseService->responseSucessoJson(401, $response);             
        } else {
            $listaAnuncioProduto =  $this->produtoService->listarProdutos(0, 6, false, $dados->idComprador);
            $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
            $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
            $response = [
                'error' => false,
                'produtos' => $listaAnuncioProduto,
                'numberCarrinho' => $numberCarrinho,
                'numberFavorito' => $numberFavorito
            ];    
            return $this->responseService->responseSucessoJson(200, $response);           
        }                                 
    } 

    public function carrinho()
    {   
        if(!key_exists('email',session()->all())){
            return view('auth.login');        
        }                      
        //Transformar esse 3 em constante            
        $listaCarrinho = $this->carrinhoService->recuperarListaCarrinho();    
        //dd(session()->all()['id']);
        return view('carrinho', compact('listaCarrinho'));
    } 

    public function categoria()
    {  
        $categorias = $this->categoriaProdutoService->recuperarCategoriasSemOffset();         
        $response = [
            'titulo' => "Categorias",
            'categorias' => $categorias
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
    
    public function promocao(Request $request)
    {  
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $listaAnuncioProduto =  $this->produtoService->listarProdutosSemOffset(true, $dados->idComprador);          
        $produtosRecentes = $this->produtoService->listarProdutosRecentes($dados->idComprador);  
        $response = [
            'titulo' => "Promoções",
            'promocoes' => $listaAnuncioProduto,
            'recentes' => $produtosRecentes
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }
    
    //separar o retorno das categorias para uma controller de categoria e cachear no frontend

    public function produto(Request $request)
    {  
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $limite = 9;
        $listaProduto =  $this->produtoService->listarProdutos($dados->numeroElementos, $limite, false);  
        $categorias = $this->categoriaProdutoService->recuperarCategoriasSemOffset();         
        $response = [
            'titulo' => "Produtos",
            'produtos' => $listaProduto,
            'categorias' => $categorias
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function pesquisarProduto(Request $request)
    {  
        //generalizar o serviço de buscar produtos                
        $dados =  $this->sharedService->converterRequestToJson($request);                
        $listaProduto =  $this->produtoService->listarProdutosByCategoria($dados, $dados->precoMin, $dados->precoMax); 
        $response = [
            'produtos' => $listaProduto
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function pesquisarProdutoInput(Request $request)
    {  
        //generalizar o serviço de buscar produtos                
        $dados =  $this->sharedService->converterRequestToJson($request);                
        $listaProduto =  $this->produtoService->listarProdutosByNome($dados->DS_INPUT_PESQUISA);  
        $categorias = $this->categoriaProdutoService->recuperarCategoriasSemOffset();         
        $response = [
            'produtos' => $listaProduto,
            'categorias' => $categorias
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function abrirPaginaPesquisa()
    {  
        return view('indexPesquisa');
    }  
}
