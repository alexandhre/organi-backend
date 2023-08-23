<?php

namespace App\Http\Services;

class ResponseService
{
   public function responseErroJson($codigo, $mensagem)
   {
      $erro = [
         'code' => $codigo,
         'message' => $mensagem
      ];

      $response = [
            'erro' => $erro
      ];
     return response()->json(compact('response'), $codigo);
   }

   public function responseSucessoJson($codigo, $mensagem)
   {
      $sucesso = [
         'code' => $codigo,
         'message' => $mensagem
      ];

      $response = [
            'sucesso' => $sucesso
      ];
     return response()->json(compact('response'), $codigo);
   }
  
}
