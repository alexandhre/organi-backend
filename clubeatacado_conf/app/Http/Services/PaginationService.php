<?php

namespace App\Http\Services;

use App\Pagination;

class PaginationService
{
   public function getNumberPages()
   {      
      return Pagination::getNumberPages(); 
   }  
}
