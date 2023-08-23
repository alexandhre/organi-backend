<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FotoAtacadista extends Model
{
    protected $table = 'TB_FOTO_PRODUTOR';

    protected $fillable=[
        'ID_PRODUTOR',
        'DS_FOTO_PRODUTOR'

    ];

    public static function fotoAtacadista($id_usuario,$foto_atacadista){

        $update = FotoAtacadista::create([
            'ID_PRODUTOR' => $id_usuario,
            'DS_FOTO_PRODUTOR' => $foto_atacadista,

        ]);
        return $update;
    }

    public static function listar($ID_PRODUTOR)
    {
        $fotos = DB::table('TB_FOTO_PRODUTOR')
            ->where('ID_PRODUTOR',$ID_PRODUTOR)
            ->select('DS_FOTO_PRODUTOR')
            ->get();
        return $fotos;
    }

}
