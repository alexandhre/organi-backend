<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cidade extends Model
{
    protected $table = 'TB_CIDADE';

    protected $fillable=[
        'ID_CIDADE',
        'ID_UF',
        'DS_CIDADE',
        'ID_TERRITORIO'
    ];

    public static function recuperarCidades() {
        return DB::table('TB_CIDADE')->get();
    }

}
