<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Certificado extends Model
{
    protected $table = 'TB_CERTIFICACAO';

    protected $fillable=[
        'ID_PRODUTOR',
        'DS_FOTO_CERTIFICACAO',
        'ID_ANUNCIO_PRODUTO',
        'DS_CERTIFICACAO',
        'DS_DETALHE_CERTIFICACAO',
        'ID_CERTIFICACAO'
    ];


    //
    public static function updatefoto($id, $i, $anuncio){


        $anuncio = Certificado::create([
            'ID_PRODUTOR' => $id,
            'DS_FOTO_CERTIFICACAO' => $i,
            'ID_ANUNCIO_PRODUTO' => $anuncio
        ]);
    }

    public static function fotos($id){
        $listaUsers = DB::table('TB_CERTIFICACAO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'ID_PRODUTOR',
                 'DS_FOTO_CERTIFICACAO')
            ->get();

        return $listaUsers;

    }


}
