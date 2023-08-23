<?php

namespace App\Http\Services;

use App\Anexo;
use App\FotoAnuncio;
use Illuminate\Support\Facades\DB;
use App\Http\Services\SharedService;

class DocumentService
{
   protected $sharedService;

   public function __construct( 
      SharedService $sharedService
      )
  {       
      $this->sharedService = $sharedService;
  }

   public function cadastrarDocumentos($fotosAnuncios, $fotosAnexos, $idAnuncioProduto)
   {      
      if (count($fotosAnuncios) > 0) {
         foreach ($fotosAnuncios as $item => $i) {
            $newPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anuncios\\" .  $idAnuncioProduto);
            $oldPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\resource\\tmp\\anuncio\\" . $i);
            $sourcePatch = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anuncios\\" .  $idAnuncioProduto . '\\' . $i);

            if (!file_exists($newPath)) {
               mkdir($newPath, 0777, true);
               chmod($newPath, 0777);
            }

            try {
               if (\File::move($oldPath, $sourcePatch)) {    
                  //mover isso para a entidade de fotoAnuncio             
                  $anexo['DS_FOTO_PRODUTO'] = $i;
                  $anexo['ID_ANUNCIO_PRODUTO'] = $idAnuncioProduto;

                  $id = DB::table('TB_FOTO_PRODUTO')->insertGetId($anexo);                
               } else {                  
                  $errors = error_get_last();
                  $error = $errors['type'];
                  $response = [
                     'erro' => true,
                     'message' => $error
                  ];
               }
            } catch (\Exception $e) {                     
               $response = [
                  'erro' => true,
                  'message' => $e->getMessage()
               ];
            }
         }
      }
      
      if (count($fotosAnexos) > 0) {        
         foreach ($fotosAnexos as $item => $i) {           
            $newPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anexos\\" .  $idAnuncioProduto);
            $oldPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\resource\\tmp\\anuncio\\" . $i);
            $sourcePatch = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anexos\\" .  $idAnuncioProduto . '\\' . $i);

            if (!file_exists($newPath)) {
               mkdir($newPath, 0777, true);
               chmod($newPath, 0777);
            }

            try {               
               if (\File::move($oldPath, $sourcePatch)) {
                  //mover isso para a entidade de anexo 
                  $foto['DS_ARQUIVO'] = $i;
                  $foto['ID_ANUNCIO_PRODUTO'] = $idAnuncioProduto;

                  DB::table('TB_ANEXO')->insertGetId($foto);
                  
               } else {
                  $errors = error_get_last();
                  $error = $errors['type'];
                  
                  $response = [
                     'erro' => true,
                     'message' => $error
                  ];
               }
            } catch (\Exception $e) {
              
               $response = [
                  'erro' => true,
                  'message' => $e->getMessage()
               ];
            }
         }
      }
      $response = [
         'erro' => false
      ];
      return $response;
   }

   public function cadastrarLogotipo($fotoLogotipo, $idProdutor)
   {
      if ($fotoLogotipo !== null) {
         $newPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\produtor\\" .  $idProdutor);
         $oldPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\resource\\tmp\\anuncio\\" . $fotoLogotipo);
         $sourcePatch = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\produtor\\" .  $idProdutor . '\\' . $fotoLogotipo);
       
         if (!file_exists($newPath)) {
            mkdir($newPath, 0777, true);
            chmod($newPath, 0777);
         }        
         try {
            if (\File::move($oldPath, $sourcePatch)) {               
               DB::table('TB_PRODUTOR')
                  ->where('ID_PRODUTOR', $idProdutor)
                  ->update(['DS_LOGOTIPO' => $fotoLogotipo]);
            } else {
               
               $errors = error_get_last();
               $error = $errors['type'];
               $response = [
                  'erro' => true,
                  'message' => $error
               ];   
               return $response;            
            }
         } catch (\Exception $e) {
            $response = [
               'erro' => true,
               'message' => $e->getMessage()
            ];
            return $response;           
         }
      }
      $response = [
         'erro' => false
      ];
      return $response;
   }

   public function deletarDocumentos($idAnuncioProduto)
   {      
      try{  
         $sourcePathFoto = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anuncios\\" .  $idAnuncioProduto);
         $this->sharedService->deletarArquivos($sourcePathFoto);       
         FotoAnuncio::deletarFoto($idAnuncioProduto);  
         $sourcePathAnexo = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\anexos\\" .  $idAnuncioProduto);
         $this->sharedService->deletarArquivos($sourcePathAnexo);        
         Anexo::deletarAnexo($idAnuncioProduto);         
         $response = [
            'erro' => false,
            'message' => ''
         ];
      } catch (\Exception $e) {
         $response = [
            'erro' => true,
            'message' => 'Documentos: ' .$e->getMessage()
         ];
      }       

      $response = [
         'erro' => false
      ];
      return $response;
   }
}
