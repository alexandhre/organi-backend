<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriaEmpresa extends Model
{
    protected $table = 'TB_CATEGORIA_EMPRESA';

    protected $fillable=[
        'ID_CATEGORIA_EMPRESA',
        'DS_CATEGORIA_EMPRESA'
    ];

    public static function listarCategorias(){
        $categorias = DB::table('myappnow_superadm.TB_CATEGORIA_EMPRESA')           
            ->get();    
        return $categorias;
    }  
}
