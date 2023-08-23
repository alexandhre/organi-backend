<?php

namespace App\Http\Controllers\anuncio;

use App\Anuncio;
use App\Atacadista;
use App\Categoria;
use App\Certificado;
use App\Cor;
use App\FotoAnuncio;
use App\Preco;
use App\Tamanho;
use App\User;
use App\Visita;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
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

    public function index()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        }
        $listaTipoProduto = $this->produtoService->recuperarTipoProduto();

        $listaTipoAnuncio = $this->anuncioService->recuperarTipoAnuncio();

        $listaProdutos = $this->produtoService->recuperarProdutos();

        return view('novoAnuncio', compact('anuncio', 'listaTipoProduto', 'listaTipoAnuncio', 'listaProdutos'));
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

    public function uploadfotoWeb(Request $request)
    {

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\atacado.club\clubeatacado\images\\resource\\tmp\\anuncio");

            $name = $image->getClientOriginalName();

            $image->move($destinationPath, $name);
            $sucess = "OK";
        } else {
            $sucess  = "erro";
        }

        return $sucess;
    }
    public function uploadfotoanucio(Request $request)
    {

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $tamanho = getimagesize($image);

            if (($image != null) && ($tamanho[0] < 2 * $tamanho[1]) && ($tamanho[1] < 2 * $tamanho[0])) {
                $destinationPath = ('images/resource/tmp/anuncio/');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                    chmod($destinationPath, 0777);
                }
                $image->move($destinationPath, $image->getClientOriginalName());
                return $image->getClientOriginalName();
            } else {
                return "erro imagem!!";
            }
        } else {
            return "sem imagem!!";
        }
    }

    public function listarAnuncio()
    {

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $anuncios = Anuncio::listar();

            $response = [
                'anuncio' => $anuncios
            ];
        } else {
            $anuncios = Anuncio::listarWeb();


            return response()->json(compact('anuncios'));
        }


        return response()->json(compact('response'));
    }

    public function getAnuncio($idAnuncio)
    {
        session([
            'anuncioAtual' => $idAnuncio
        ]);
        return view('detalheAnuncio');
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

    public function getAnuncioById($idAnuncio)
    {

        $anuncio = $this->anuncioService->recuperarAnuncioById($idAnuncio);

        $listaTipoProduto = $this->produtoService->recuperarTipoProduto();

        $listaTipoAnuncio = $this->anuncioService->recuperarTipoAnuncio();

        $leilaoProduto = $this->leilaoService->recuperarLeilaoAnuncio($idAnuncio);

        return view('editarAnuncio', compact('anuncio', 'listaTipoProduto', 'listaTipoAnuncio', 'leilaoProduto'));
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

    public function meusAnuncios($id)
    {
        $anuncio = Anuncio::meusAnuncios($id);

        $response = [
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }

    public function meusAnuncioWeb()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        } else {
            $id = Atacadista::findId(session()->all()['id']);

            $anuncio = Anuncio::meusAnunciosWeb($id);

            return view('admin.user.meusanuncios', compact('anuncio'));
        }
    }

    public function todasPromocoesApp()
    {

        $anuncio = Anuncio::todasPromocoesApp();

        $response = [
            'promocoes' => $anuncio
        ];

        return response()->json(compact('response'));
    }

    public function todasPromocoes()
    {

        //        $anuncio = Anuncio::todasPromocoes();

        return view('promocoes');
    }
    public function moretodasPromocoes($inicio)
    {

        $anuncio = Anuncio::moreodasPromocoes($inicio);

        return $anuncio;
    }

    public function promocoesWeb()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        } else {
            $id = Atacadista::findId(session()->all()['id']);

            $promocoes = Anuncio::promocoesWeb($id);

            return view('admin.user.promocoes', compact('promocoes'));
        }
    }
    public function promocoes($id)
    {

        $promocoes = Anuncio::promocoes($id);
        $response = [
            'promocoes' => $promocoes
        ];

        return response()->json(compact('response'));
    }
    public function addpromocoesWeb(Request $request)
    {

        //dd($request);

        $anuncio = Anuncio::addpromocoesWeb($request->input);

        $response = [
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }
    public function pararPromocoesWeb($id)
    {
        //Auth::User()->id
        //$id = User::findIdUsuario(Auth::User()->id);

        $anuncio = Anuncio::pararPromocoesWeb($id);

        $response = [
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }

    public function historico(Request $id)
    {

        $id_comprador = User::findIdUsuario($id);
        $id_comprador = intval($id_comprador['0']->ID_COMPRADOR);

        $favorito = Anuncio::historicoAdd($id_comprador, $id);

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {

            if ($favorito == 1) {
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Anuncio adicionado com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];
                return response()->json(compact('response'), 200);
            } else {
                $error = [
                    'Erro' => 500,
                    'ErroMessage' => 'Erro ao adicionar anuncio'
                ];
                $response = [
                    'Error' => $error
                ];
                return response()->json(compact('response'), 500);
            }
        } else {

            if ($favorito == 1) {
                return response()->json(compact('Sucesso'), 200);
            } else {
                return response()->json(compact('Erro'), 500);
            }
        }
    }

    public function infogeral($id)
    {

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::infoGeral($id);

            return $info;
        } else {
            $info = Anuncio::infoGeralWeb($id);

            return $info;
        }
    }

    public function infoProvedor($id)
    {
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        //retirar o colchete: ['0]
        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::infoProvedor($id);

            $response = [
                'info' => $info
            ];


            return response()->json(compact('response'));
            // return $info;

        } else {
            $info = Anuncio::infoProvedorWeb($id);

            return $info;
        }
    }

    public function EspTecnica($id)
    {
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::espTecnica($id);

            $tec = Anuncio::infoProvedor($id);

            $response = [
                'certificado' => $info,
                'provedor' => $tec
            ];

            return response()->json(compact('response'));
        } else {
            $info = Anuncio::espTecnicaWeb($id);

            return $info;
        }
    }
    public function EspTecnicaWeb($id)
    {
        $info = Anuncio::espTecnicaWeb($id);

        return $info;
    }

    public function desconto($idAnuncio, $vlr)
    {
        $desconto = Anuncio::desconto($idAnuncio, $vlr);

        return $desconto;
    }

    public function anuncie()
    {

        if (!key_exists('email', session()->all())) {

            return view('auth.login');
        } elseif (
            Atacadista::where('ID_COMPRADOR', session()->all()['id'])->first()->NR_CNPJ == NULL ||
            Atacadista::join('TB_CONTATO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_CONTATO.ID_PRODUTOR')->where('ID_COMPRADOR', session()->all()['id'])->first()->NR_TELEFONE == NULL ||
            Atacadista::join('TB_CONTATO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_CONTATO.ID_PRODUTOR')->where('ID_COMPRADOR', session()->all()['id'])->first()->DS_EMAIL == NULL
        ) {
            $qtProduto = [];
            for ($i = 0; $i <= 1000; $i += 1) {
                $qtProduto[] = $i;
            }
            $end = 0;
            return view('admin.user.novoanuncio', compact('end', 'qtProduto'));
        } else {

            $qtProduto = [];
            for ($i = 0; $i <= 1000; $i += 1) {
                $qtProduto[] = $i;
            }
            return view('admin.user.novoanuncio')->with('qtProduto', $qtProduto);
        }
    }

    public function produto()
    {
        return view('produto');
    }
    public function produtoDetalhe($id)
    {
        $infoAnuncio = Anuncio::infoAnuncio($id);

        return $infoAnuncio;
    }
    public function produtoinfo($id)
    {
        $id = Crypt::decrypt($id);
        return view('produtosearch', compact('id'));
    }

    public function produtoDetalhePage()
    {

        return view('produtoDetalhe');
    }


    public function promocaoSemana()
    {
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            //ALTERAR
            $anuncios = Anuncio::listar();

            $response = [
                'anuncio' => $anuncios
            ];
        } else {
            $anuncios = Anuncio::listaPromocoesWeb();


            return response()->json(compact('anuncios'));
        }


        return response()->json(compact('response'));
    }

    public function cores(Request $request)
    {
        $cores = Cor::corAnuncio($request['input']);

        return $cores;
    }

    public function promocaoPage()
    {

        return view('admin.user.promocoes');
    }

    public function promocaoNovaPage()
    {

        return view('admin.user.ativarPromocao');
    }
    public function promocaoNova($id)
    {

        // $id = 47;
        $precos = Anuncio::precoProduto($id);


        return $precos;
    }


    public function buscar(Request $request)
    {
        $cat = $request->cat;
        $anuncio = [];

        $categoria = DB::table('TB_TIPO_PRODUTO')->where('DS_TIPO_PRODUTO', 'like', '%' . $cat . '%')->select('DS_TIPO_PRODUTO')->get();
        $produtos = DB::table('TB_PRODUTO')->where('DS_PRODUTO', 'like', '%' . $cat . '%')->select('DS_PRODUTO')->get();

        //         foreach ($categoria as $item){
        //             array_push($anuncio, $item);
        //         }
        //        foreach ($produtos as $i){
        //            array_push($anuncio, $i);
        //        }

        return [$categoria, $produtos];
    }

    public function buscados(Request $request)
    {

        $categoria = Categoria::categoriaBuscada($request->input);
        $anuncio = Anuncio::anuncioBuscado($request->input);

        if (count($categoria) > 0) {
            return $categoria;
        } else {
            return $anuncio;
        }
    }
    public function buscadospage()
    {


        return view('promocoes');
    }
    public function certificacao($id)
    {
        $fotosCerticados = Certificado::fotos($id);

        return $fotosCerticados;
    }
    public function empresaFoto($id)
    {
        $fotosCerticados = Certificado::fotos($id);

        return $fotosCerticados;
    }

    public function visita($id)
    {

        if (key_exists('email', session()->all())) {

            if (!(Visita::where('ID_COMPRADOR', session()->all()['id'])->where('ID_ANUNCIO_PRODUTO', $id)->count() > 0)) {
                Visita::inserir($id, session()->all()['id']);
            }
        }

        $infoAnuncio = Anuncio::addvisita($id);
        return $infoAnuncio;
    }

    public function AnunuciosMiasVisto()
    {
        if (key_exists('email', session()->all())) {

            $anuncios = Anuncio::listarVistados(session()->all()['id']);


            return ([$anuncios, 1]);
        } else {

            $anuncios = Anuncio::listarMaisVistos();
            return ([$anuncios, 0]);
        }
    }
    public function AnunuciosMiasVistoApp()
    {
        $anuncios = Anuncio::listarMaisVistosApp();
        $response = [
            'anuncio' => $anuncios
        ];
        return response()->json(compact('response'));
    }


    public function morelist($inicio)
    {
        $moreListAnuncio = Anuncio::listMoreAnuncio($inicio);

        return $moreListAnuncio;
    }
    public function moreListMiasvistos($inicio)
    {
        if (key_exists('email', session()->all())) {
            //$id = Comprador::findId(Auth::User()->id);
            $moreListAnuncio = Anuncio::listMoreMiasVisitados($inicio, session()->all()['id']);



            return ([$moreListAnuncio, 1]);
        } else {

            $anuncios = Anuncio::listarMoreMaisVistos($inicio);
            return ([$anuncios, 0]);
        }
    }
    public function moreListMiasvistosApp($inicio)
    {
        if (!key_exists('email', session()->all())) {
            //$id = Comprador::findId(Auth::User()->id);
            $moreListAnuncio = Anuncio::listMoreMiasVisitados($inicio, session()->all()['id']);

            $response = [
                'anuncio' => $moreListAnuncio[0]
            ];
            return response()->json(compact('response'));
        } else {

            $anuncios = Anuncio::listarMoreMaisVistosApp($inicio);
            $response = [
                'anuncio' => $anuncios[0]
            ];
            return response()->json(compact('response'));
        }
    }

    public function PedidosApp($id)
    {
        $pedidos = Anuncio::Pedidos($id);
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $response = [
                'pedidos' => $pedidos
            ];

            return response()->json(compact('response'));
        } else {
            return $pedidos;
        }
    }

    public function Pedidos()
    {


        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        } else {
            $pedidos = Anuncio::Pedidos(session()->all()['id']);

            return view('admin.user.historico', compact('pedidos'));
        }
    }


    public function PedidosDetalheApp($id, $comprador)
    {
        $pedidos = Anuncio::PedidosDetalhe($id, $comprador);

        $response = [
            'pedidos' => $pedidos
        ];

        return response()->json(compact('response'));
    }


    public function destaques()
    {

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';



        if (preg_match($pattern, $currentPath)) {
            $promocoes = Anuncio::DestaquesApp();


            $response = [
                'destaques' => $promocoes
            ];

            return response()->json(compact('response'));
        } else {
            $promocoes = Anuncio::Destaques();
            return view('destaques', compact('promocoes'));
        }
    }

    public function destaquesMore($inicio)
    {

        $promocoes = Anuncio::destaquesMore($inicio);

        return $promocoes;
    }

    public function remove($id)
    {

        $response = Anuncio::deleteById($id);


        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response', 404));
        } else {

            if (isset($response['success']['successId'])) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function editar($id)
    {

        $infoAnuncio = Anuncio::infoAnuncio($id);
        $id_atacado = Atacadista::findId(session()->all()['id']);

        $fotosCerticados = Certificado::fotos($id);
        $fotoEmpresa = Atacadista::empresaFoto($id_atacado);

        return [$infoAnuncio, $fotosCerticados, $fotoEmpresa];
    }
    public function editarPage()
    {

        return view('admin.user.anuncioeditar');
    }

    public function editarUpload(Request $request)
    {
        $usuario = $request->input();

        $pieces = explode(" ", $usuario['input'][4]);

        if (count($pieces) > 1) {
            $usuario['input'][4] = str_replace(',', '.', $pieces[1]);
        }

        $credentials = [
            'anuncioId' => $usuario['input'][13],
            'produtoId' => $usuario['input'][3],
            'nome' => $usuario['input'][0],
            'descricao' => $usuario['input'][1],
            'codigo' => $usuario['input'][2],
            'produto' => $usuario['input'][3],
            'quatidade' => $usuario['input'][5],
            'quatidadeMinima' => $usuario['input'][6],
            'cor' => $usuario['input'][9],
            'preco' => $usuario['input'][4],
            'tamanho' => $usuario['input'][7],
            'fotos' => $usuario['input'][10],
            'certificados' => $usuario['input'][11],
            'precos' => $usuario['input'][12],
            'garantia' => $usuario['input'][14]
        ];

        $validator = \Validator::make($credentials, [

            'produtoId' => "required",
            'nome' => "required",
            'descricao' => "required",
            //            'video' => $credentials['video'],
            'quatidade' => "required",
            //            'peso' => $credentials['peso'],
            'quatidadeMinima' => "required",
            //            'capacidade' => $credentials['capacidade'],
        ]);

        $credentials['codigo'] = Categoria::getId($credentials['produtoId']);
        $id = Anuncio::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->select('ID_PRODUTO')->first();

        try {
            DB::table('TB_PRODUTO')->where('ID_PRODUTO', intval($id->ID_PRODUTO))
                ->update([
                    'ID_CATEGORIA_PRODUTO' => intval($credentials['codigo']),
                    'DS_PRODUTO' => $credentials['nome'],
                    'DS_FOTO_PRODUTO' => $credentials['nome']
                ]);
        } catch (\Exception $e) {
            return 0;
        }


        if ($validator->fails()) {
            $error = response()->json(['error' => 'invalid_credentials'], 428);
            $error = [
                'errorId' => 428,
                'errorMessage' => 'credenciais invalidas'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'), 428);
        } else {
            //ANUNCIO
            try {

                $userInfo = Anuncio::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->update([
                    'DS_ANUNCIO_PRODUTO' => $credentials['nome'],
                    'DS_DETALHE_PRODUTO' => $credentials['descricao'],
                    'QT_DISPONIVEL' => $credentials['quatidade'],
                    'QT_MINIMA_PEDIDO' => $credentials['quatidadeMinima'],
                    'DS_CAPACIDADE_FORNECIMENTO' => $credentials['quatidade'],
                    'VL_PRODUTO_UNITARIO' => floatval($credentials['preco']),
                    'DS_GARANTIA' => $credentials['garantia'],
                ]);
            } catch (\Exception $e) {
                return 0;
            }


            // TAMANHO

            try {
                if (Tamanho::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->count() > 0) {
                    Tamanho::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->delete();
                }
                foreach ($credentials['tamanho'] as $i) {

                    if (!(($i['tamanho'] == "0") && ($i['metragem'] == ''))) {

                        $idTamanho = DB::table('TB_TAMANHO')->where('DS_TAMANHO', $i['tamanho'])->select('ID_TAMANHO')->first();

                        $corinfo = Tamanho::insert([
                            'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                            'ID_TAMANHO' => $idTamanho->ID_TAMANHO,
                            'DS_TAMANHO' => $i['tamanho'],
                            'DS_METRAGEM' => $i['metragem'],
                        ]);
                    }
                }
            } catch (\Exception $e) {

                return 0;
            }

            // PRECO
            try {

                if (Preco::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->count() > 0) {
                    Preco::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->delete();
                }

                foreach ($credentials['precos'] as $key => $item) {
                    $pieces = explode(" ", $item['preco']);
                    if (count($pieces) > 1) {
                        $item['preco'] = str_replace(',', '.', $pieces[1]);
                    }

                    $precoinfo = Preco::insert([
                        'ID_ANUNCIO_PRODUTO' =>  $credentials['anuncioId'],
                        'VL_PRODUTO' => floatval($item['preco']),
                        'QT_INICIAL' => floatval($item['inicio']),
                        'QT_FINAL' => floatval($item['fim']),
                    ]);
                }
            } catch (\Exception $e) {

                return 0;
            }

            //           // COR
            try {

                if (Cor::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->count() > 0) {
                    Cor::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->delete();
                }

                foreach ($credentials['cor'] as $item) {
                    $corinfo = Cor::insert([
                        'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                        'DS_COR' => $item,
                        'ID_COR' => 1,
                    ]);
                }
            } catch (\Exception $e) {

                return 0;
            }

            //            //FOTOS

            try {
                $fotos = [];
                $files = glob("images/anuncio/" .  $credentials['anuncioId'] . "/*"); // get all file names

                foreach ($files as $file) { // iterate files

                    $pieces = explode("images/anuncio/" .  $credentials['anuncioId'] . "/", $file);

                    if (!in_array($pieces[1], $credentials['fotos'])) {

                        array_push($fotos, $pieces[1]);
                        if (unlink($file)) {
                            $cert = DB::table('TB_FOTO_PRODUTO')
                                ->where('DS_FOTO_PRODUTO', $pieces[1])->delete();
                        }
                    }
                }

                foreach ($credentials['fotos'] as $item) {

                    $newPath = ("C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/anuncio/" . $credentials['anuncioId']);
                    $extencao = explode(".", $item);
                    $extencao = end($extencao);
                    if (!file_exists($newPath)) {
                        mkdir($newPath, 0777, true);
                        chmod($newPath, 0777);
                    }
                    $file = new Filesystem();
                    //$file->moveDirectory('C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\\images\\resource\\tmp\\anuncio\\'.$usuario['input'][$i],  "C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\images\\anuncios\\".$anuncio."\\".$usuario['input'][$i]);
                    //adicionar pasta usuario
                    $foto = "photo" . substr(md5(rand(600000, 12000000)), 0, 8) . "." . $extencao;

                    if ($file->moveDirectory('images/resource/tmp/anuncio/' . $item,  "images/anuncio/" . $credentials['anuncioId'] . "/" . $foto)) {

                        $foto = FotoAnuncio::insert([
                            'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                            'DS_FOTO_PRODUTO' => $foto,
                        ]);
                    } else {
                        $errors = error_get_last();
                        $error = $errors['type'];
                        $response = [
                            'error' => $error
                        ];
                    }
                }
            } catch (\Exception $e) {
                return 0;
            }
            //            //CERTIFICADOS
            try {

                $fotosC = [];
                $files = glob("images/certificados/" .  $credentials['anuncioId'] . "/*"); // get all file names

                foreach ($files as $file) { // iterate files

                    $pieces = explode("images/certificados/" . $credentials['anuncioId'] . "/", $file);

                    if (!in_array($pieces[1], $credentials['certificados'])) {

                        if (unlink($file)) {
                            array_push($fotosC, $pieces[1]);

                            $cert = DB::table('TB_CERTIFICACAO')
                                ->where('DS_FOTO_CERTIFICACAO', $pieces[1])->delete();
                        }
                    }
                }
                foreach ($credentials['certificados'] as $key => $item) {
                    $newPath = ("images/certificados/" . $credentials['anuncioId']);
                    $extencao = explode(".", $item);
                    $extencao = end($extencao);
                    if (!file_exists($newPath)) {
                        mkdir($newPath, 0777, true);
                        chmod($newPath, 0777);
                    }
                    $file = new Filesystem();
                    $foto = "cetificado" . substr(md5(rand(600000, 12000000)), 0, 8) . "." . $extencao;

                    //adicionar pasta usuario
                    if ($file->moveDirectory('images/resource/tmp/anuncio/' . $item,  "images/certificados/" . $credentials['anuncioId'] . "/" . $foto)) {
                        //$file->moveDirectory('images\\resource\\tmp\\empresa\\'.$data[$j],  "images\\empresas\\".$usuarioId."\\".$data[$j])
                        $id = Atacadista::findId(session()->all()['id']);

                        $foto = Certificado::updateOrCreate([
                            'ID_PRODUTOR' => $id,
                            'DS_FOTO_CERTIFICACAO' => $foto,
                            'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId']
                        ]);
                        //                \File::delete('images\\resource\\tmp\\empresa\\'.$data[$j]);

                    } else {
                        $errors = error_get_last();
                        $error = $errors['type'];
                        $response = [
                            'error' => $error
                        ];
                    }
                }
            } catch (\Exception $e) {
                return 0;
            }

            return 1;
        }
    }
    public function removerFoto($id, $foto)
    {

        //FOTOS
        try {
            $fotos = [];
            $files = glob("images/anuncio/" .  $id . "/*"); // get all file names

            foreach ($files as $file) { // iterate files

                $pieces = explode("images/anuncio/" .  $id . "/", $file);

                if ($pieces[1] == $foto) {

                    array_push($fotos, $pieces[1]);
                    if (unlink($file)) {
                        FotoAnuncio::where('DS_FOTO_PRODUTO', $foto)->delete();
                    }
                }
            }
        } catch (\Exception $e) {
        }

        //CERTIFICADOS
        try {
            $fotosC = [];
            $files = glob("images/certficados/" . $id . "/*"); // get all file names

            foreach ($files as $file) { // iterate files

                $pieces = explode("images/certficados/" . $id . "/", $file);

                if ($pieces[1] == $foto) {

                    array_push($fotosC, $pieces[1]);
                    if (unlink($file)) {
                        Certificado::where('DS_FOTO_CERTIFICACAO', $pieces[1])->delete();
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }

    public function addComentario(Request $request)
    {
        $credenciais = $request->input;

        try {
            $comentario = DB::table('TB_AVALIACAO_PRODUTO')
                ->insert([
                    'ID_ANUNCIO_PRODUTO' => $credenciais[2],
                    'ID_COMPRADOR' => session()->all()['id'],
                    'DS_AVALIACAO' => $credenciais[0],
                    'VL_AVALIACAO' => $credenciais[1],
                    'DT_AVALIACAO' => date("Y-m-d H:i:s")
                ]);
        } catch (\Exception $e) {
            return 0;
        }
        return  1;
    }
    public function ComentarioShowMore($skip, $id)
    {
        $comentarios = Anuncio::MoreComents($skip, $id);

        return $comentarios;
    }
}
