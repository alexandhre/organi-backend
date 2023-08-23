<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class listar extends Model
{

    protected $table = 'TB_USUARIO';

    public static function listaUsers()
    {
        $list= DB::table('TB_USUARIO')
            ->select('TB_USUARIO.DS_NOME')
            ->get();

        return $list;
    }



}
