<?php

namespace App\Http\Services;
use App\Carrinho;
use App\Produto;

class CarrinhoService
{

   public function recuperarListaCarrinho()
   {
      return $this->montarFotoProduto(Carrinho::recuperarListaCarrinho(session()->all()['id']));
   }

   public function montarFotoProduto($produtos)
   {
      foreach($produtos as $item){
         $DS_FOTO = $this->validarFotoProduto($item->ID_ANUNCIO_PRODUTO);
         //pegar dominio automatico
         $item->DS_FOTO_ANUNCIO_PRODUTO = "http://testetendering.myappnow.com.br/clubeatacado/images/anuncios/". $DS_FOTO;
      }
      return $produtos;
   }

   public function validarFotoProduto($ID_ANUNCIO_PRODUTO)
   {
      $DS_FOTO = Produto::recuperarFotoProduto($ID_ANUNCIO_PRODUTO);      
      return count($DS_FOTO) > 0 ? $ID_ANUNCIO_PRODUTO . '/' . $DS_FOTO[0]->DS_FOTO_PRODUTO : '104/plasticos.png';
   } 

   public function validarCarrinho($idComprador)
   {
      $carrinho = Carrinho::recuperarListaCarrinho($idComprador); 
      if(count($carrinho) > 19){
         return false;
      } else {
         return true;
      }
   } 

   public function limparCheckout($idComprador)
   {
      return Carrinho::limparCheckout($idComprador);      
   } 

}
