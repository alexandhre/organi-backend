<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cotacao extends Model
{
    protected $table = 'TB_COTACAO_RESIDUO';
    protected $fillable = ['ID_COTACAO','ID_RESIDUO','DT_COTACAO','VL_COTACAO'];

    protected $tableresiduo = 'TB_RESIDUO';
    protected $fillableresiduo = ['ID_TIPO_RESIDUO','ID_CATEGORIA_RESIDUO'];

    protected $tableresiduocat = 'TB_CATEGORIA_RESIDUO';
    protected $fillableresiduocat = ['DS_TIPO_RESIDUO','DS_DESCRICAO','ID_RESIDUO'];

    public static function listarCotacao(){

        $cotacao = DB::table('TB_COTACAO_RESIDUO')
            ->join('TB_RESIDUO', 'TB_COTACAO_RESIDUO.ID_RESIDUO', 'TB_RESIDUO.ID_RESIDUO')
            ->join('TB_CATEGORIA_RESIDUO', 'TB_RESIDUO.ID_CATEGORIA_RESIDUO', 'TB_CATEGORIA_RESIDUO.ID_CATEGORIA_RESIDUO')
            ->join('TB_TIPO_RESIDUO', 'TB_CATEGORIA_RESIDUO.ID_TIPO_RESIDUO', 'TB_TIPO_RESIDUO.ID_TIPO_RESIDUO')
            ->select('TB_COTACAO_RESIDUO.VL_COTACAO','TB_TIPO_RESIDUO.DS_TIPO_RESIDUO')
            ->get();

        return $cotacao;
    }
}
