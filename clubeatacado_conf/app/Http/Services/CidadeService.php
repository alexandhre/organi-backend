<?php

namespace App\Http\Services;

use App\Cidade;

class CidadeService
{  
   public function recuperarCidades()
   { 
      return Cidade::recuperarCidades();
   }  
}
