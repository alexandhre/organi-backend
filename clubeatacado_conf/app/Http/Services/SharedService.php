<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Anuncio;

class SharedService
{
   public function converterRequestToJson(Request $request)
   {      
      return json_decode(json_encode($request->all(),true));
   } 

   public function limparUsuario()
   {      
      Session()->flush();
      Auth()->logout();
   } 

   public function deletarArquivos($caminho) { 
      $arquivos = array_diff(scandir($caminho), array('.','..')); 
      foreach ($arquivos as $arquivo) { 
        (is_dir("$caminho/$arquivo")) ? $this->deletarArquivos("$caminho/$arquivo") : unlink("$caminho/$arquivo"); 
      } 
      return rmdir($caminho); 
   }  
   
   public function getNumberCarrinho($idComprador){
      return Anuncio::getNumberCarrinho($idComprador); 
   }

   public function getNumberFavorito($idComprador){
      return Anuncio::getNumberFavorito($idComprador); 
   }
}
