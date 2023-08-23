<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ResponseService;
use App\Http\Services\LeilaoService;
use App\Http\Services\ProdutoService;
use App\Http\Services\UsuarioService;
use App\Http\Services\SharedService;


class LeilaoController_ extends Controller
{

    protected $usuarioService;

    protected $leilaoService;

    protected $sharedService;

    protected $responseService;

    protected $produtoService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UsuarioService $usuarioService,
        LeilaoService $leilaoService,
        SharedService $sharedService,
        ResponseService $responseService,
        ProdutoService $produtoService
    ) {
        $this->usuarioService = $usuarioService;
        $this->leilaoService = $leilaoService;
        $this->sharedService = $sharedService;
        $this->responseService = $responseService;
        $this->produtoService = $produtoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        }
        //if(session()->all()['atacadista'])
        //Transformar esse 3 em constante            
        $leiloes = $this->leilaoService->recuperarLeiloes(0);
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
            //dd($dateEnd); 
            if (($dateCurrent >= $dateBegin) && ($dateCurrent <= $dateEnd)) {
                $leiloes[$i]->IN_LEILAO = 1;
                $dateInterval = $dataAtual->diff($data_fim);
                if ($dateInterval->d > 0) {
                    $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->d . ' dias';
                } else if ($dateInterval->d == 0) {
                    $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->h . ' horas';
                }
            } else if (($dateCurrent > $dateEnd)) {
                $leiloes[$i]->IN_LEILAO = 0;
                $leiloes[$i]->VL_DIAS_FALTANTES = 0;
            } else if (($dateCurrent < $dateBegin)) {
                $leiloes[$i]->IN_LEILAO = 2;
                $dateInterval = $dataAtual->diff($data_inicio);
                if ($dateInterval->d > 0) {
                    $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->d . ' dias';
                } else if ($dateInterval->d == 0) {
                    $leiloes[$i]->VL_DIAS_FALTANTES = $dateInterval->h . ' horas';
                }
            }
        }
        return view('leilao', compact('leiloes'));
    }

    public function telaDetalheLeilao()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.login');
        }
        return view('detalheLeilao');
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

    public function enviarLanceLeilao(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        try {
            $this->leilaoService->cadastrarLanceLeilao($dados);
            $response = [
                'error' => false,
                'message' => 'Lance cadastrado com sucesso!'
            ];
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        return $this->responseService->responseSucessoJson(200, $response);
    }
}
