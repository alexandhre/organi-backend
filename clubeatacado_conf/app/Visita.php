<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Visita extends Model
{
    protected $table = 'TB_VISITA_ANUNCIO';

    protected $fillable=[
        'ID_COMPRADOR',
        'ID_ANUNCIO_PRODUTO',
        'DT_VISITA',
    ];

    public static function inserir($id, $comprador){


            $userInfo = Visita::insert([
                'ID_COMPRADOR' => $comprador,
                'ID_ANUNCIO_PRODUTO' => $id,
                'DT_VISITA' => date("Y-m-d H:i:s")
            ]);


    }


}
