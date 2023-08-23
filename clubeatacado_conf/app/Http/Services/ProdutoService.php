<?php

namespace App\Http\Services;

use App\FotoAnuncio;
use App\Produto;

class ProdutoService
{
   public function montarFotoProduto($produtos, $action = '')
   {
      $arrayProdutos = [];      
      if($action == 'pagination'){
         $arrayProdutos = $produtos['produtos'];
      } else {
         $arrayProdutos = $produtos;
      }
      foreach($arrayProdutos as $item){
         $DS_FOTO = $this->validarFotoProduto($item->ID_ANUNCIO_PRODUTO);
         //pegar dominio automatico
         $item->DS_FOTO_ANUNCIO_PRODUTO = "http://testetendering.myappnow.com.br/images/anuncios/". $DS_FOTO;
      }
      return $produtos;
   }

   public function listarProdutos($in_promocao, $id_comprador)
   {
      return $this->montarFotoProduto(Produto::listarProdutos($in_promocao, $id_comprador), 'pagination');
   } 

   public function listarProdutosSemOffset($in_promocao, $id_comprador)
   {
      return $this->montarFotoProduto(Produto::listarProdutosSemOffset($in_promocao, $id_comprador));
   } 

   public function listarProdutosRecentes($id_comprador)
   {
      return $this->montarFotoProduto(Produto::listarProdutosRecentes($id_comprador));
   } 

   public function recuperarProdutos()
   {
      return Produto::recuperarProdutos();
   } 

   public function listarProdutosByUsuario($inicio, $limite)
   {
      return $this->montarFotoProduto(Produto::listarProdutosByUsuario($inicio, $limite, session()->all()['id']));
   } 

   public function listaProdutosFavoritosByUsuario()
   {
      return $this->montarFotoProduto(Produto::listaProdutosFavoritosByUsuario(session()->all()['id']));
   }
   
   public function listarProdutosByCategoria($dados, $VL_PRECO1, $VL_PRECO2)
   {
      return $this->montarFotoProduto(Produto::listarProdutosByCategoria($dados, $VL_PRECO1, $VL_PRECO2));
   } 

   public function listarProdutosByNome($DS_INPUT_PESQUISA)
   {
      return $this->montarFotoProduto(Produto::listarProdutosByNome($DS_INPUT_PESQUISA));
   } 

   public function validarFotoProduto($ID_ANUNCIO_PRODUTO)
   {
      $DS_FOTO = Produto::recuperarFotoProduto($ID_ANUNCIO_PRODUTO);      
      return count($DS_FOTO) > 0 ? $ID_ANUNCIO_PRODUTO . '/' . $DS_FOTO[0]->DS_FOTO_PRODUTO : '';
   }  

   public function cadastrarProduto($produtos)
   {           
      return Produto::cadastrarNovoProduto($produtos); 
   }  

   public function editarProduto($produtos)
   {           
      return Produto::atualizarProduto($produtos); 
   }

   public function recuperarFotosProduto($idAnuncioProduto)
   {       
      $fotos = FotoAnuncio::recuperarFotosProduto($idAnuncioProduto); 
      foreach($fotos as $item){        
         //pegar dominio automatico
         $item->DS_FOTO_ANUNCIO_PRODUTO = "http://testetendering.myappnow.com.br/images/anuncios/". $item->ID_ANUNCIO_PRODUTO . "/" . $item->DS_FOTO_PRODUTO;
      }    
      return $fotos;
   }  

   public function recuperarTipoProduto()
   {           
      return Produto::recuperarTipoProduto(); 
   }  
}
