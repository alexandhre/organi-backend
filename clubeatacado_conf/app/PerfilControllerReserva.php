<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoriaProdutoService;
use Illuminate\Http\Request;
use App\Http\Services\CidadeService;
use App\Http\Services\CompradorService;
use App\Http\Services\LeilaoService;
use App\Http\Services\ProdutoService;
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
    public function index()
    {    
            
        $dadosUsuario = $this->usuarioService->recuperarDadosUsuario();
        $cidades = $this->cidadeService->recuperarCidades();
        $listaComprasUsuario =  $this->compradorService->recuperarComprasUsuario(); 

        $leiloes = $this->leilaoService->recuperarLeiloesUsuario();

        for ($i = 0; $i < count($leiloes); $i++) {
            $maiorValorLance = $this->leilaoService->recuperarMaiorValorLance($leiloes[$i]->ID_LEILAO);
            $leiloes[$i]->VL_LANCE_MAIOR = $maiorValorLance;
        }
        
        setlocale(LC_TIME, 'portuguese'); 
        date_default_timezone_set('America/Sao_Paulo');
        $dateCurrent = date('Y-m-d H:i:s'); 
        $dateCurrent=date('Y-m-d H:i:s', strtotime($dateCurrent));

        for ($i = 0; $i < count($listaComprasUsuario); $i++) {
            //echo $paymentDate; // echos today! 
            $dataEntrega = date('Y-m-d', strtotime($listaComprasUsuario[$i]->DT_ENTREGA));
                
            if (($dateCurrent >= $dataEntrega)){
                //Mudar logica para atualizar esse atributo quando a entrega realmente for feita
                //colocar um atributo no banco
                $listaComprasUsuario[$i]->IN_ENTREGA_FEITA = 1;
            }else{
                $listaComprasUsuario[$i]->IN_ENTREGA_FEITA = 0;
            }  
            
            $date = date('Y-m-d');
            $listaComprasUsuario[$i]->DT_ENTREGA =  strftime("%d de %B de %Y", strtotime($listaComprasUsuario[$i]->DT_ENTREGA));
            $listaComprasUsuario[$i]->DT_PEDIDO =  strftime("%d de %B de %Y", strtotime($listaComprasUsuario[$i]->DT_PEDIDO));
        }

        $produtos = $this->produtoService->listarProdutosByUsuario(0, 3);
        
        return view('perfil', compact('dadosUsuario', 'cidades', 'listaComprasUsuario', 'leiloes', 'produtos'));
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

    public function abrirPaginaPesquisa()
    {  
        return view('indexPesquisa');
    }  
}
