<?php

namespace App\Http\Services;

use App\Leilao;

class LeilaoService
{
   //generalizar esses metodos
   public function recuperarLeiloes($idLeilao)
   {
      return Leilao::recuperarLeiloesSemIdLeilao($idLeilao);
   }

   public function recuperarDetalheLeilao($idLeilao)
   {
      return Leilao::recuperarDetalheLeilao($idLeilao);
   }

   public function recuperarQuantidadeLances($idLeilao)
   {
      return Leilao::recuperarQuantidadeLances($idLeilao);
   }

   public function recuperarMaiorValorLance($idLeilao)
   {
      return Leilao::recuperarMaiorValorLance($idLeilao);
   }

   public function cadastrarLanceLeilao($dados)
   {
      return Leilao::cadastrarLanceLeilao($dados);
   }

   public function recuperarLeiloesUsuario($id_comprador)
   {
      return $this->tratarlistaLeiloes(Leilao::recuperarLeiloesUsuario($id_comprador));
   }

   public function recuperarLeiloesUsuarioFavoritos($id_comprador)
   {
      return $this->tratarlistaLeiloes(Leilao::recuperarLeiloesUsuarioFavoritos($id_comprador));
   }

   public function recuperarLeiloesByUsuario($id_comprador)
   {
      return $this->tratarlistaLeiloes(Leilao::recuperarLeiloesByUsuario($id_comprador));
   }

   public function tratarlistaLeiloes($leiloes)
   {
      for ($i = 0; $i < count($leiloes['leiloes']); $i++) {
         date_default_timezone_set('America/Sao_Paulo');

         $data_inicio = new \DateTime($leiloes['leiloes'][$i]->DT_INICIO);
         $data_fim = new \DateTime($leiloes['leiloes'][$i]->DT_FIM);

         $dateCurrent = date('Y-m-d H:i:s');
         $dataAtual = new \DateTime(date('Y-m-d'));
         $arrayDtInicio = explode(" ", $leiloes['leiloes'][$i]->DT_INICIO);
         $arrayDtFim = explode(" ", $leiloes['leiloes'][$i]->DT_FIM);

         $dateBegin = date('Y-m-d', strtotime($arrayDtInicio[0]));
         $dateEnd = date('Y-m-d', strtotime($arrayDtFim[0]));
         if (($dateCurrent >= $dateBegin) && ($dateCurrent <= $dateEnd)) {
            $leiloes['leiloes'][$i]->IN_LEILAO = 1;
            $dateInterval = $dataAtual->diff($data_fim);
            $leiloes['leiloes'][$i]->VL_DIAS_FALTANTES = $dateInterval->d;
         } else if (($dateCurrent > $dateEnd)) {
            $leiloes['leiloes'][$i]->IN_LEILAO = 0;
            $leiloes['leiloes'][$i]->VL_DIAS_FALTANTES = 0;
         } else if (($dateCurrent < $dateBegin)) {
            $leiloes['leiloes'][$i]->IN_LEILAO = 2;
            $dateInterval = $dataAtual->diff($data_inicio);
            $leiloes['leiloes'][$i]->VL_DIAS_FALTANTES = $dateInterval->d;
         }
      }
      return $leiloes;
   }

   public function cadastrarLeilao($dados, $idAnuncioProduto)
   {
      try {
         $idLeilaoProduto = Leilao::cadastrarProdutoLeilao($dados, $idAnuncioProduto);
         $idLeilao = Leilao::cadastrarLeilao($dados, $idLeilaoProduto);
         Leilao::cadastrarLeilaoComprador($idLeilao, $dados->id_comprador);
         $response = [
            'erro' => false,
            'message' => ''
         ];
      } catch (\Exception $e) {
         $response = [
            'erro' => true,
            'message' => 'Leilao: ' . $e->getMessage()
         ];
      }
      return $response;
   }

   public function editarLeilao($dados)
   {
      try {
         Leilao::editarProdutoLeilao($dados);
         Leilao::editarLeilao($dados);
         $response = [
            'erro' => false,
            'message' => ''
         ];
      } catch (\Exception $e) {
         $response = [
            'erro' => true,
            'message' => $e->getMessage()
         ];
      }
      return $response;
   }

   public function deletarLeilao($idAnuncioProduto)
   {
      try {
         $leilaoAnuncio = Leilao::recuperarLeilaoAnuncio($idAnuncioProduto);
         if (count($leilaoAnuncio) > 0) {
            $idLeilao = Leilao::deletarLeilaoComprador($idAnuncioProduto);
            Leilao::deletarLances($idLeilao);
            Leilao::deletarFavoritoLeilao($idLeilao);
            Leilao::deletarLeilao($idAnuncioProduto);
            Leilao::deletarLeilaoProduto($idAnuncioProduto);
         }

         $response = [
            'erro' => false,
            'message' => ''
         ];
      } catch (\Exception $e) {
         dd($e->getMessage());
         $response = [
            'erro' => true,
            'message' => 'Leilao: ' . $e->getMessage()
         ];
      }
      return $response;
   }

   public function recuperarLeilaoAnuncio($idAnuncio)
   {
      return Leilao::recuperarLeilaoAnuncio($idAnuncio);
   }
}
