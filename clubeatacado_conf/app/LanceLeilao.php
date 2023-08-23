<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LanceLeilao extends Model
{
    protected $table = 'TB_LANCE_LEILAO';

    protected $fillable=[
        'ID_LANCE',
        'ID_LEILAO',
        'VL_LANCE',
        'DT_LANCE',
        'ID_USUARIO'
    ];

    public static function LanceLeilao(){}
}
