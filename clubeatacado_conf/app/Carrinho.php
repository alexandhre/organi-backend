<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Carrinho extends Model
{

    protected $table = 'TB_CARRINHO_PRODUTO';

    protected $fillable = [
        'ID_CARRINHO_PRODUTO',
        'ID_COMPRADOR',
        'ID_ANUNCIO_PRODUTO'
    ];

    public static function recuperarListaCarrinho($idComprador)
    {    
        
        $carrinho = DB::table('TB_CARRINHO_PRODUTO')
        ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO') 
        ->join('TB_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO','TB_PRODUTO.ID_PRODUTO') 
        ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idComprador)
        ->get();

        return $carrinho;
    }

    public static function limparCheckout($idComprador)
    {    
        
        $carrinho = DB::table('TB_CHECKOUT_PRODUTO')
        ->where('TB_CHECKOUT_PRODUTO.ID_COMPRADOR', $idComprador)
        ->delete();

        return $carrinho;
    }

   
}
