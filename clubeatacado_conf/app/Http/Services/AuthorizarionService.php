<?php

namespace App\Http\Services;

use App\Authorization;

class AuthorizarionService
{   

   public function salvarSessao($idComprador)
   {
      return Authorization::salvarSessao($idComprador);
   }

   public function validarSessao($idComprador)
   {           
      return Authorization::validarSessao($idComprador);
   }  

   public function deletarSessao($idComprador)
   {           
      return Authorization::deletarSessao($idComprador);
   }   
}
