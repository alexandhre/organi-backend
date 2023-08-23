<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoLeilao extends Model
{
    protected $table = 'TB_PRODUTO_LEILAO';

    protected $fillable=[
        'ID_LEILAO_PRODUTO',
        'ID_PRODUTO',
        'DS_DESCRICAO_DETALHADA',
        'VL_PRECO_INICIAL'
    ];

    public static function ProdutoLeilao(){}
}
