<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorito extends Model
{
    protected $table = 'TB_FAVORITO';

    protected $fillable=[
        'ID_COMPRADOR',
        'ID_ANUNCIO_PRODUTO'
    ];
    public static function getData($id,$usuario){

        $data =  DB::table('TB_FAVORITO')
            ->where('ID_COMPRADOR', intval($usuario))
            ->where('ID_ANUNCIO_PRODUTO',$id)
            ->select(
                'ID_COMPRADOR','ID_ANUNCIO_PRODUTO')
            ->get();

        return $data;
    }
}
