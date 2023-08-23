<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tamanho extends Model
{
    protected $table = 'TB_TAMANHO_PRODUTO';

    protected $fillable=[
        'ID_ANUNCIO_PRODUTO',
        'ID_TAMANHO',
        'DS_TAMANHO',
        'DS_METRAGEM',
    ];

    public static function tamanho($tamanho, $id)
    {
        if($tamanho != []){
            foreach ($tamanho as $item) {

                $idTamanho = DB::table('TB_TAMANHO')->where('DS_TAMANHO', $item['tamanho'])->select('ID_TAMANHO')->first();

                $corinfo = Tamanho::insert([
                    'ID_ANUNCIO_PRODUTO' =>$id ,
                    'ID_TAMANHO' =>$idTamanho->ID_TAMANHO,
                    'DS_TAMANHO' =>$item['tamanho'] ,
                    'DS_METRAGEM' =>$item['medida'] ,
                ]);
            }
            return $corinfo;

        }
        return null;
    }
}
