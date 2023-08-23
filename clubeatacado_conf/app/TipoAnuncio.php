<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoAnuncio extends Model
{
    protected $table = 'TB_TIPO_ANUNCIO';

    protected $fillable=[
        'ID_TIPO_ANUNCIO',
        'DS_TIPO_ANUNCIO'
    ];

    public static function TipoAnuncio() {}
}
