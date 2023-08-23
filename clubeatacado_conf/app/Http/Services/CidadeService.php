<?php

namespace App\Http\Services;

use App\Cidade;

class CidadeService
{  
   //generalizar esses metodos
   public function recuperarCidades()
   { 
      return Cidade::recuperarCidades();
   }  
}
