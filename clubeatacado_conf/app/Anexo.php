<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anexo extends Model
{
    protected $table = 'TB_ANEXO';

    protected $fillable=[
        'ID_ANEXO',
        'ID_ANUNCIO_PRODUTO',
        'DT_CREATE',
        'DS_ARQUIVO'
    ];

    public static function Anexo(){}

    public static function deletarAnexo($idAnuncioProduto)
    {
        return DB::table('TB_ANEXO')->where('TB_ANEXO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)->delete();  
    }
}
