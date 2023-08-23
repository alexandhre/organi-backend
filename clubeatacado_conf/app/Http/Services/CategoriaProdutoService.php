<?php

namespace App\Http\Services;

use App\Categoria;

class CategoriaProdutoService
{
   public function montarFotoCategoriaProduto($categorias)
   {
      foreach($categorias as $item){
         $item->DS_FOTO_CATEGORIA_PRODUTO != 0 ? "https://testetendering.myappnow.com.br/images/categorias/".$item->DS_FOTO_CATEGORIA_PRODUTO : '';
      }
      return $categorias;
   }

   //generalizar esses metodos

   public function recuperarCategorias($numeroElementos)
   {
      return $this->montarFotoCategoriaProduto(Categoria::listarCategorias($numeroElementos));
   }  

   public function recuperarCategoriasByNome($DS_INPUT_PESQUISA)
   {
      return $this->montarFotoCategoriaProduto(Categoria::listarCategoriasByNome($DS_INPUT_PESQUISA));
   }  

   public function recuperarCategoriasSemOffset()
   {
      return $this->montarFotoCategoriaProduto(Categoria::listarCategoriasSemOffset());
   }  
}
