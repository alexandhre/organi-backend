<?php

namespace App\Http\Controllers\categoria;

use App\Anuncio;
use App\Categoria;
use App\Cor;
use App\Produto;
use App\Atacadista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CategoriaController extends Controller
{
    public function listarTipocategorias(){

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $categorias = Categoria::listarTipocategorias();

            $response=[
              'categorias' =>  $categorias['0'],
            ];

            return response()->json(compact('response'));

        }else{

            $categorias = Categoria::listarTipocategoriasWeb();

          return $categorias;
        }


    }

    public function morelist($inicio){

        $moreListAnuncio = Categoria::listMoreAnuncio($inicio);

        return $moreListAnuncio;
    }
    public function morelistType($id,$inicio){

        $categorias = Anuncio::anuncioTipomoreList($id,$inicio);

        return $categorias;
    }

    public function listarcategorias($id){

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $categorias = Categoria::listarcategorias($id);

            if(strlen($categorias) <= 2){
                $response = $categorias = [
                    'categorias' => null
                ];
                return response()->json(compact('response'));

            }
            $response=[
                'categorias' =>  $categorias
            ];

            return response()->json(compact('response'));
        }else{

            $cores = Cor::listcor();
            $subCat = Categoria::join('TB_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO')
                                ->where('TB_TIPO_PRODUTO.DS_TIPO_PRODUTO',$id )
                                ->select('TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO','TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO')
                                ->get();

            $categorias = Anuncio::anuncioTipo($id);

            return view('categoria.tipoCategoria',compact('categorias','cores','subCat'));

        }

    }
    public function listar(){

        return $categoria = DB::table('TB_TIPO_PRODUTO')->select('DS_TIPO_PRODUTO')->get();
    }
    public function listarProduto(Request $request){
        $cat = $request->cat;

        return $categoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO' )
            ->where('TB_TIPO_PRODUTO.DS_TIPO_PRODUTO','like','%'.$cat.'%')->select('DS_CATEGORIA_PRODUTO')->get();
    }
    public function todosProdutos(){
        $categorias = Categoria::listarTipocategoriasWeb();

        return view('categoria.categorias',compact('categorias'));

    }

    public function produtoByCategoria($id){

        $categorias = Produto::produtoByCategoria($id);
        $response =  [
            'anuncios' => $categorias
        ];

        return response()->json(compact('response'));

    }

    public function listmenu(){
        $categoria = Categoria::listCategoriaMenu();

        return $categoria;

    }

    public function principaisCat($id){
        
       $categoria = Atacadista::getprinciaisCat($id);
       return $categoria;
    }

}
