<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Services\SharedService;
use App\Http\Services\ProdutoService;
use App\Http\Services\AnuncioService;
use App\Http\Services\ResponseService;


class DocumentController extends Controller
{
    protected $sharedService;

    protected $produtoService;

    protected $anuncioService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProdutoService $produtoService, 
        SharedService $sharedService,
        AnuncioService $anuncioService,
        ResponseService $responseService
        )
    {       
        $this->sharedService = $sharedService;
        $this->produtoService = $produtoService;
        $this->anuncioService = $anuncioService;
        $this->responseService = $responseService;
    }

    public function create(Request $request)
    {                                
        $responseFotos = $this->uploadfoto($request);
        return response()->json(compact('responseFotos'));
    }

    public function uploadfoto(Request $request)
    {
        
        $image_file[] = $request["myFiles"];
        $names_fotos = [];
        //Adicionar id no nome da pasta
        if ($request->hasFile('myFiles')) {
           
            $image = $request->file('myFiles');
            //deixar pasta temporaria padrão para todos
            $destinationPath = ("C:\\Inetpub\\vhosts\\myappnow.com.br\\testetendering.myappnow.com.br\\clubeatacado\\images\\resource\\tmp\\anuncio");

            if (is_array($request["myFiles"])) {
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                    chmod($destinationPath, 0777);
                }    
                
                foreach ($image as $item) {
                    $name = $item->getClientOriginalName();     
                    $DS_FOTO = $this->separarExtensaoFoto($name);                                  
                    $item->move($destinationPath, $DS_FOTO);
                    array_push($names_fotos, $DS_FOTO);
                }
            } else {    
                $name = $image->getClientOriginalName();
                $DS_FOTO = $this->separarExtensaoFoto($name);
                $image->move($destinationPath, $DS_FOTO);
                array_push($names_fotos, $DS_FOTO);
            }

            $response = [
                'erro' => false,
                'fotos' => $names_fotos
            ];          

        } else {
            $response = [
                'erro' => true,
                'fotos' => []
            ];
        }

        return $response;
    }

    public function separarExtensaoFoto($uploadFileName) {
        $tmp = explode('.', $uploadFileName);
        $file_extension = end($tmp);
        return $this->concatenarNomeFoto($file_extension, $uploadFileName);
    }

    public function concatenarNomeFoto($file_extension, $uploadFileName) {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');
        $DS_FOTO = md5($uploadFileName) . md5($date);
        $DS_FOTO = substr($DS_FOTO,0,50);
        $DS_FOTO = $DS_FOTO . "." . $file_extension;
        return $DS_FOTO;
    }
}
