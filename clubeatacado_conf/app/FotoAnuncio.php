<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FotoAnuncio extends Model
{
    protected $table = 'TB_FOTO_PRODUTO';

    protected $fillable=[
        'ID_ANUNCIO_PRODUTO',
        'DS_FOTO_PRODUTO',
    ];
    
    public static function updatefoto($anuncio_id, $i){

        $anuncio = FotoAnuncio::create([
            'ID_ANUNCIO_PRODUTO' => $anuncio_id,
            'DS_FOTO_PRODUTO' => $i,
        ]);
    }

    public static function recuperarFotosProduto($idAnuncioProduto)
    {
        $fotos = DB::table('TB_FOTO_PRODUTO')  
        ->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)              
        ->get();                           
        return $fotos;
    }

    public static function deletarFoto($idAnuncioProduto)
    {
        return DB::table('TB_FOTO_PRODUTO')->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)->delete();  
    }
}
