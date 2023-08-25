<?php

namespace App\Http\Controllers\anuncio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SharedService;
use App\Http\Services\ProdutoService;
use App\Http\Services\AnuncioService;
use App\Http\Services\DocumentService;
use App\Http\Services\LeilaoService;
use App\Http\Services\ResponseService;
use App\Http\Services\UsuarioService;
use App\Http\Services\CidadeService;
use App\Http\Services\CarrinhoService;

class AnuncioController extends Controller
{

    protected $sharedService;

    protected $produtoService;

    protected $anuncioService;

    protected $responseService;

    protected $documentService;

    protected $leilaoService;

    protected $usuarioService;

    protected $cidadeService;    

    protected $carrinhoService;    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProdutoService $produtoService,
        SharedService $sharedService,
        AnuncioService $anuncioService,
        ResponseService $responseService,
        DocumentService $documentService,
        LeilaoService $leilaoService,
        UsuarioService $usuarioService,
        CidadeService $cidadeService,
        CarrinhoService $carrinhoService
    ) {
        $this->sharedService = $sharedService;
        $this->produtoService = $produtoService;
        $this->anuncioService = $anuncioService;
        $this->responseService = $responseService;
        $this->documentService = $documentService;
        $this->leilaoService = $leilaoService;
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->carrinhoService = $carrinhoService;
    }

    public function recuperarListaAnuncio()
    {
        $listaTipoAnuncio = $this->anuncioService->recuperarTipoAnuncio();

        $response = [
            'listaTipoAnuncio' => $listaTipoAnuncio
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function create(Request $request)
    {

        $dados =  $this->sharedService->converterRequestToJson($request);         
        $produtor = $this->usuarioService->recuperarDadosProdutor($dados->idComprador);      
        if (isset($produtor)) {
            $idAnuncioProduto = $this->anuncioService->cadastrarAnuncio($dados, $produtor[0]->ID_PRODUTOR);
            $response = [
                'error' => false,
                'message' => ' Anuncio Cadastrado com sucesso!',
                'idAnuncioProduto' => $idAnuncioProduto
            ];
        } else {
            $response = [
                'error' => false,
                'message' => 'Você não tem perfil de produtor, altere seu perfil para produtor antes de cadastrar o anúncio!'
            ];
        }       
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function cadastrarDadosAdicionais(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);                  
        $idAnuncioProduto = $this->anuncioService->cadastrarDadosAdicionais($dados);
        $response = [
            'error' => false,
            'message' => 'Dados Adicionais do Anúncio cadastrados com sucesso!',
            'idAnuncioProduto' => $idAnuncioProduto
        ];
   
        // if($dados->leilao == 'true') {            
        //     $returnLeilao = $this->leilaoService->cadastrarLeilao($dados, $idAnuncioProduto);    
        //     if($returnLeilao['erro']){
        //         $response = [
        //             'error' => true,
        //             'message' => 'Erro ao criar anuncio, caso o erro persista entre em contato com o suporte!'
        //         ]; 
        //     }        
        // }        
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function cadastrarFotosAnuncio(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        $this->documentService->cadastrarDocumentos($dados->uploading_files_anuncio, $dados->uploading_files_anexo, $dados->idAnuncioNovo);    
        $response = [
            'error' => false,
            'message' => 'Documentos cadastrados com sucesso!'
        ];  
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function cadastrarDadosLeilao(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);   
                  
        $returnLeilao = $this->leilaoService->cadastrarLeilao($dados, $dados->idAnuncioNovo);    
        if($returnLeilao['erro']){
            $response = [
                'error' => true,
                'message' => 'Erro ao criar anuncio, caso o erro persista entre em contato com o suporte!'
            ]; 
        }        

        $response = [
            'error' => false,
            'message' => 'Leilão cadastrado com sucesso!'
        ];       
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function update(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        $this->produtoService->editarProduto($dados);
        $idAnuncioProduto = $this->anuncioService->editarAnuncio($dados, $dados->idProduto);
        if (isset($dados->uploading_files_anuncio) && isset($dados->uploading_files_anexo)) {
            $this->documentService->cadastrarDocumentos($dados->uploading_files_anuncio, $dados->uploading_files_anexo, $dados->idAnuncio);
        }
        $returnLeilao = $this->leilaoService->editarLeilao($dados, $idAnuncioProduto);
        if ($returnLeilao['erro']) {
            $response = [
                'error' => true,
                'message' => 'Erro ao atualizar anuncio, caso o erro persista entre em contato com o suporte!'
            ];
        } else {
            $response = [
                'error' => false,
                'message' => 'Anuncio atualizado com sucesso!'
            ];
        }

        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function destroy(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        $returnLeilao = $this->leilaoService->deletarLeilao($dados->idAnuncioProduto, $dados->ID_COMPRADOR);
        if ($returnLeilao['erro']) {
            $response = [
                'error' => true,
                'message' => 'Erro ao excluir anuncio, caso o erro persista entre em contato com o suporte!'
            ];
        } else {
            $response = [
                'error' => false,
                'message' => 'Anuncio excluído com sucesso!'
            ];
        }
        $returnAnuncio = $this->documentService->deletarDocumentos($dados->idAnuncioProduto);
        if ($returnAnuncio['erro']) {
            $response = [
                'error' => true,
                'message' => 'Erro ao excluir anuncio, caso o erro persista entre em contato com o suporte!'
            ];
        } else {
            $response = [
                'error' => false,
                'message' => 'Anuncio excluído com sucesso!'
            ];
        }
        $returnAnuncio = $this->anuncioService->deletarAnuncio($dados->idAnuncioProduto);
        if ($returnAnuncio['erro']) {
            $response = [
                'error' => true,
                'message' => 'Erro ao excluir anuncio, caso o erro persista entre em contato com o suporte!'
            ];
        } else {
            $response = [
                'error' => false,
                'message' => 'Anuncio excluído com sucesso!'
            ];
        }
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function favoritarAnuncio(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        if (isset($dados->label) && $dados->label == '2') {
            $returnAnuncio = $this->anuncioService->favoritarLeilao($dados->idAnuncioProduto, $dados->idComprador);
        } else {
            $returnAnuncio = $this->anuncioService->favoritarAnuncio($dados->idAnuncioProduto, $dados->idComprador);
        }

        if ($returnAnuncio['erro']) {
            $response = [
                'error' => true,
                'message' => 'Erro ao favoritar anuncio, caso o erro persista entre em contato com o suporte!'
            ];
        } else {
            $messageFavorito = '';
            if ($returnAnuncio['returnFavorito'] == 1) {
                $messageFavorito = 'Anuncio favoritado com sucesso!';
            } else if ($returnAnuncio['returnFavorito'] == 0) {
                $messageFavorito = 'Anuncio desfavoritado com sucesso!';
            }
            $response = [
                'error' => false,
                'message' => $messageFavorito,
                'returnFavorito' => $returnAnuncio['returnFavorito']
            ];
        }
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function addCarrinho(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        if($this->carrinhoService->validarCarrinho($dados->idComprador)){
            $returnCarrinho = $this->anuncioService->addCarrinho($dados->idAnuncioProduto, $dados->idComprador);
            if ($returnCarrinho['erro']) {
                $response = [
                    'error' => true,
                    'message' => 'Erro ao adicionar produto no carrinho, caso o erro persista entre em contato com o suporte!'
                ];
            } else {
                $messageCarrinho = '';
                if ($returnCarrinho['returnCarrinho'] == 1) {
                    $messageCarrinho = 'Produto incluido no carrinho com sucesso!';
                } else if ($returnCarrinho['returnCarrinho'] == 0) {
                    $messageCarrinho = 'Produto retirado do carrinho!';
                }
                $response = [
                    'error' => false,
                    'message' => $messageCarrinho,
                    'returnCarrinho' => $returnCarrinho['returnCarrinho']
                ];
            }
        } else {
            $messageCarrinho = 'Atingido número máximo de itens no carrinho!';
            $response = [
                'error' => false,
                'message' => $messageCarrinho,
                'returnCarrinho' => 2
            ];
        }
             
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function recuperarDetalheLeilao(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $leilao = $this->leilaoService->recuperarDetalheLeilao($dados->idLeilao);
        $quantidadeLances = $this->leilaoService->recuperarQuantidadeLances($dados->idLeilao);
        $leilao[0]->QTD_LANCES = $quantidadeLances;
        $maiorValorLance = $this->leilaoService->recuperarMaiorValorLance($dados->idLeilao);
        $leilao[0]->VL_LANCE_MAIOR = $maiorValorLance;
        $leiloes = $this->leilaoService->recuperarLeiloes($dados->idLeilao);
        for ($i = 0; $i < count($leiloes); $i++) {
            date_default_timezone_set('America/Sao_Paulo');

            $data_inicio = new \DateTime($leiloes[$i]->DT_INICIO);
            $data_fim = new \DateTime($leiloes[$i]->DT_FIM);

            $dateCurrent = date('Y-m-d H:i:s');
            $dateCurrent = date('Y-m-d H:i:s', strtotime($dateCurrent));
            $dataAtual = new \DateTime($dateCurrent);
            //echo $paymentDate; // echos today! 
            $arrayDtInicio = explode(" ", $leiloes[$i]->DT_INICIO);

            $arrayDtFim = explode(" ", $leiloes[$i]->DT_FIM);

            $dateBegin = date('Y-m-d', strtotime($arrayDtInicio[0]));
            $dateEnd = date('Y-m-d', strtotime($arrayDtFim[0]));

            if (($dateCurrent >= $dateBegin) && ($dateCurrent <= $dateEnd)) {
                $leiloes[$i]->IN_LEILAO = 1;
                $dateInterval = $dataAtual->diff($data_fim);
                $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->d;
            } else if (($dateCurrent > $dateEnd)) {
                $leiloes[$i]->IN_LEILAO = 0;
                $leiloes[$i]->VL_DIAS_FALTANTES = 0;
            } else if (($dateCurrent < $dateBegin)) {
                $leiloes[$i]->IN_LEILAO = 2;
                $dateInterval = $dataAtual->diff($data_inicio);
                $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->d;
            }
        }
        $fotosAnuncioProduto = $this->produtoService->recuperarFotosProduto($leilao[0]->ID_ANUNCIO_PRODUTO);
        $leilao[0]->VL_LANCE_MAIOR = $maiorValorLance;
        //colocar num metodo separado                
        $response = [
            'leilao' => $leilao,
            'leiloes' => $leiloes,
            'fotos' => $fotosAnuncioProduto
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function checkout(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $carrinho = $this->anuncioService->recuperarCheckout($dados->idComprador);
        $cidades = $this->cidadeService->recuperarCidades();
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);          
        //colocar num metodo separado                
        $response = [
            'carrinho' => $carrinho,
            'cidades' => $cidades,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function validarCupom(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $cupom = $this->anuncioService->validarCupom($dados);  
        $messageCupom = '';
        $validade = '';
        if(count($cupom) == 0){
            $messageCupom = 'Cupom inválido!';
            $validade = false;
        } else {
            $validade = true;
            if($cupom[0]->CUPOM_VALIDO){
                $messageCupom = 'Cupom adicionado com sucesso!';
            } else {            
                $messageCupom = 'Cupom expirado!';
            }  
        }        
        //colocar num metodo separado                
        $response = [
            'message' => $messageCupom,
            'cupom' => $cupom,
            'validade' => $validade            
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function recuperarDetalheAnuncio(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $anuncio = $this->anuncioService->recuperarAnuncioById($dados->idAnuncioProduto, $dados->idComprador);
        $anuncios = $this->anuncioService->recuperarUltimosAnuncios($dados->idComprador, $dados->idAnuncioProduto);
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        if(isset($anuncio)){
            $fotosAnuncioProduto = $this->produtoService->recuperarFotosProduto($anuncio[0]->ID_ANUNCIO_PRODUTO);
        } else {
            $fotosAnuncioProduto = [];
        }        
        //$anuncios = $this->anuncioService->recuperarAnuncios();
        //colocar num metodo separado                
        $response = [
            'anuncio' => $anuncio,
            'anuncios' => $anuncios,
            'fotos' => $fotosAnuncioProduto,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function recuperarCarrinho(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $this->carrinhoService->limparCheckout($dados->idComprador);
        $carrinho = $this->anuncioService->recuperarCarrinho($dados->idComprador);
        $cidades = $this->cidadeService->recuperarCidades();
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);          
        //colocar num metodo separado                
        $response = [
            'carrinho' => $carrinho,
            'cidades' => $cidades,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function salvarCheckout(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $carrinho = $this->anuncioService->salvarCheckout($dados);        
        //colocar num metodo separado                
        $response = [
            'message' => 'Redirecionando para a tela de checkout...'
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }
}
