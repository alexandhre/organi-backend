<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoNegocio extends Model
{
    protected $table = 'TB_TIPO_NEGOCIO';

    protected $fillable=[
        'ID_TIPO_NEGOCIO',
        'DS_TIPO_NEGOCIO',
        'ID_CATEGORIA_EMPRESA'
    ];

    public static function listarTipos(){
        $listaTipoNegocio = DB::table('myappnow_superadm.TB_TIPO_NEGOCIO')           
            ->get();    
        return $listaTipoNegocio;
    }  
}
