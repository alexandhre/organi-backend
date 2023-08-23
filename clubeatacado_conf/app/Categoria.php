<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $table = 'TB_TIPO_PRODUTO';

    protected $fillable=[
        'ID_CATEGORIA_PRODUTO',
        'ID_TIPO_PRODUTO',
        'DS_TIPO_PRODUTO'
    ];

    public static function listarTipocategorias(){
        $categoria = DB::table('TB_TIPO_PRODUTO')
            //->join('TB_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO')
            ->select(
                'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO AS tipoId',
                'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO AS tipoCategoria',
                'TB_TIPO_PRODUTO.DS_ICONE_TIPO_PRODUTO AS iconeTipo')
              //  'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO as categoriaProduto')
            ->get();
        foreach($categoria as $item){
            $item->iconeTipo = "https://testetendering.myappnow.com.br/clubeatacado\images\categorias\\".$item->iconeTipo;
        }


        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO','!=',NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as idAnuncio',
                'ID_PRODUTOR as IdAtacadista',
                'ID_PRODUTO as idProduto',
                'DS_ANUNCIO_PRODUTO as titulo',
                'DS_DETALHE_PRODUTO as descricao',
                'VL_DESCONTO as vlDesconto',
                'TB_PRECO_PRODUTO.VL_PRODUTO as vlProduto')
            ->orderBy('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'DSC')
            ->limit(8)
            ->get();

//        foreach ($listAnuncio as $key => $item){
//
//            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
//                ->where('ID_ANUNCIO_PRODUTO', $item->idAnuncio)
//                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
//                ->limit(1)
//                ->get();
//
//           // $item->FOTO_ANUNCIO = "http://192.168.1.125:8000\images\\". $item->FOTO_ANUNCIO->DS_FOTO_PRODUTO;
//        }

        $home = [
            $categoria,
            $listAnuncio
        ];

        return $home;
    }

    public static function listarCategorias($numeroElementos){
        $offset = $numeroElementos;
        $limit = 9;
        $categorias = DB::table('TB_CATEGORIA_PRODUTO')  
            ->offset($offset)->limit($limit)     
            ->orderBy('ID_CATEGORIA_PRODUTO','ASC')
            ->get();  
                    
        return $categorias;
    }

    public static function listarCategoriasByNome($DS_INPUT_PESQUISA){
        $categorias = DB::table('TB_CATEGORIA_PRODUTO')  
            ->where('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO','LIKE','%'.$DS_INPUT_PESQUISA.'%')
            ->orderBy('ID_CATEGORIA_PRODUTO','ASC')
            ->get();  
                    
        return $categorias;
    }

    public static function listarCategoriasSemOffset(){
        $categorias = DB::table('TB_CATEGORIA_PRODUTO') 
            ->orderBy('ID_CATEGORIA_PRODUTO','ASC')
            ->get();  
                    
        return $categorias;
    }

    public static function listMoreAnuncio($inicio){
        $categoria = DB::table('TB_TIPO_PRODUTO')
            ->select(
                'ID_TIPO_PRODUTO',
                'DS_TIPO_PRODUTO',
                'DS_ICONE_TIPO_PRODUTO')
            ->orderBy('ID_TIPO_PRODUTO','ASC')
            ->skip($inicio)
            ->take(4)
            ->get();

        return $categoria;
    }

    public static function listarcategoriasPorId($id){
        $categoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('ID_TIPO_PRODUTO',$id)
            ->select(
                'ID_CATEGORIA_PRODUTO AS categoriaId',
                'DS_CATEGORIA_PRODUTO AS categoria',
                'DS_FOTO_CATEGORIA_PRODUTO AS fotoCategoria')
            ->get();
        foreach($categoria as $item){
            $item->fotoCategoria = "https://testetendering.myappnow.com.br/clubeatacado\images\categorias\\".$item->fotoCategoria;
        }
        return $categoria;
    }
    public static function listarcategoriasWeb($id){
        $categoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('ID_TIPO_PRODUTO',$id)
            ->select(
                'ID_CATEGORIA_PRODUTO',
                'DS_CATEGORIA_PRODUTO',
                'DS_FOTO_CATEGORIA_PRODUTO')
            ->get();

        return $categoria;
    }
    public static function getId($id){
        $categoria = DB::table('TB_CATEGORIA_PRODUTO')
            ->where('DS_CATEGORIA_PRODUTO',$id)
            ->select('ID_CATEGORIA_PRODUTO')
            ->get();

        return $categoria[0]->ID_CATEGORIA_PRODUTO;
    }

    public static function listCategoriaMenu(){
        $categoria = DB::table('TB_TIPO_PRODUTO')
            ->select(
                'DS_TIPO_PRODUTO',
                'ID_TIPO_PRODUTO')
            ->get();

        return $categoria;
    }

    public static function categoriaBuscada($produto){

        $listAnuncio = DB::table('TB_TIPO_PRODUTO')

            ->join('TB_CATEGORIA_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO','TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_PRODUTO','TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO','TB_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_ANUNCIO_PRODUTO','TB_PRODUTO.ID_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO')
          //  ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('DS_TIPO_PRODUTO','like','%'.$produto.'%')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO',
                'TB_ANUNCIO_PRODUTO.VL_DESCONTO',
                'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO'
            //    'TB_PRECO_PRODUTO.VL_PRODUTO'
            )
            ->limit(8)
            ->get();

        if(count($listAnuncio)<1){
            return $listAnuncio;
        }else{
            foreach ($listAnuncio as $item){
                $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, '.', '');

                $FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                    ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                    ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                        'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO')
                    ->limit(1)
                    ->get();

                if(count( $FOTO_ANUNCIO)>0){
                    $item->DS_FOTO_ANUNCIO = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\'.$item->ID_ANUNCIO_PRODUTO.'\\'.$FOTO_ANUNCIO['0']->DS_FOTO_PRODUTO;
                }else{
                    $item->DS_FOTO_ANUNCIO = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
                }
            }
        }

        return $listAnuncio;
    }
}
