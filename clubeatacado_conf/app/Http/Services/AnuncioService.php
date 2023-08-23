<?php

namespace App\Http\Services;

use App\Anuncio;
use App\Produto;

class AnuncioService
{   

   public function montarFotoProduto($produtos)
   {
      foreach($produtos as $item){
         $DS_FOTO = $this->validarFotoProduto($item->ID_ANUNCIO_PRODUTO);
         //pegar dominio automatico
         $item->DS_FOTO_ANUNCIO_PRODUTO = "http://testetendering.myappnow.com.br/images/anuncios/". $DS_FOTO;
      }
      return $produtos;
   }

   public function validarFotoProduto($ID_ANUNCIO_PRODUTO)
   {
      $DS_FOTO = Produto::recuperarFotoProduto($ID_ANUNCIO_PRODUTO);      
      return count($DS_FOTO) > 0 ? $ID_ANUNCIO_PRODUTO . '/' . $DS_FOTO[0]->DS_FOTO_PRODUTO : '';
   }  

   public function cadastrarAnuncio($dados, $idProdutor)
   {           
      return Anuncio::novoAnuncio($dados, $idProdutor); 
   } 

   public function cadastrarDadosAdicionais($dados)
   {           
      return Anuncio::cadastrarDadosAdicionais($dados); 
   } 

   public function editarAnuncio($dados, $idProduto)
   {           
      return Anuncio::editarAnuncio($dados, $idProduto); 
   }
   
   public function recuperarAnuncioById($idAnuncio, $idComprador)
   {           
      return Anuncio::getAnuncioById($idAnuncio, $idComprador); 
   } 

   public function recuperarTipoAnuncio()
   {           
      return Anuncio::recuperarTipoAnuncio(); 
   }  

   public function salvarCheckout($dados)
   {           
      return Anuncio::salvarCheckout($dados); 
   }  

   public function recuperarCheckout($idComprador)
   {           
      return Anuncio::recuperarCheckout($idComprador); 
   }  

   public function validarCupom($dados)
   {           
      return Anuncio::validarCupom($dados); 
   }  

   public function recuperarAnuncios()
   {           
      return Anuncio::recuperarAnuncios(session()->all()['id']); 
   } 

   public function recuperarUltimosAnuncios($idComprador, $idAnuncioProduto)
   {           
      return $this->montarFotoProduto(Anuncio::recuperarUltimosAnuncios($idComprador, $idAnuncioProduto)); 
   } 

   public function recuperarCarrinho($idComprador)
   {           
      return $this->montarFotoProduto(Anuncio::getCarrinhoUsuario($idComprador)); 
   } 

   public function recuperarMeusAnuncios($idUsuario)
   {           
      return Anuncio::getAnuncioByIdComprador($idUsuario); 
   } 

   public function deletarAnuncio($idAnuncioProduto)
   {           
      try{
         Anuncio::deletarAnuncio($idAnuncioProduto);  
         $response = [
            'erro' => false,
            'message' => ''
         ];
      } catch (\Exception $e) {
         $response = [
            'erro' => true,
            'message' => 'Anuncio: ' .$e->getMessage()
         ];
      }  
      return $response;
   }

   public function favoritarAnuncio($idAnuncioProduto, $idComprador)
   {           
      try{
         $idFavorito = Anuncio::favoritarAnuncio($idAnuncioProduto, $idComprador);  
         $response = [
            'erro' => false,
            'message' => '',
            'returnFavorito' => $idFavorito
         ];
      } catch (\Exception $e) {         
         $response = [
            'erro' => true,
            'message' => 'Anuncio: ' .$e->getMessage(),
            'returnFavorito' => $idFavorito
         ];
      }  
      return $response;
   }

   public function favoritarLeilao($idLeilao, $idComprador)
   {           
      try{
         $idFavorito = Anuncio::favoritarLeilao($idLeilao, $idComprador);  
         $response = [
            'erro' => false,
            'message' => '',
            'returnFavorito' => $idFavorito
         ];
      } catch (\Exception $e) {         
         $response = [
            'erro' => true,
            'message' => 'Anuncio: ' .$e->getMessage()
         ];
      }  
      return $response;
   }

   public function addCarrinho($idAnuncioProduto, $idComprador)
   {            
      try{
         $idCarrinho = Anuncio::addCarrinho($idAnuncioProduto, $idComprador);  
         $response = [
            'erro' => false,
            'message' => '',
            'returnCarrinho' => $idCarrinho
         ];
      } catch (\Exception $e) {         
         $response = [
            'erro' => true,
            'message' => 'Anuncio: ' .$e->getMessage(),
            'returnCarrinho' => $idCarrinho
         ];
      }  
      return $response;
   }
}
