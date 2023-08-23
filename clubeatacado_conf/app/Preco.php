<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    protected $table = 'TB_PRECO_PRODUTO';

    protected $fillable=[
        'ID_PRECO_PRODUTO',
        'ID_ANUNCIO_PRODUTO',
        'VL_PRODUTO',
        'QT_INICIAL',
        'QT_FINAL',
        'VL_INICIO_PRODUTO',
        'VL_FINAL_PRODUTO',
    ];

    public static function preco($id, $data, $preco)
    {

        foreach ($data as $key => $item){

//            if (strripos($item['preco'], "-")) {
//
////                $precos = explode("-", $item['preco']);
//
//                $precoinfo = Preco::create([
//                    'ID_ANUNCIO_PRODUTO' => $id,
//                    'VL_INICIO_PRODUTO' => floatval($precos[0]),
//                    'VL_FINAL_PRODUTO' => floatval($precos[1]),
//                    'QT_INICIAL' => floatval($item['inicio']),
//                    'QT_FINAL' => floatval($item['fim']),
//                    'VL_PRODUTO' => floatval($preco)
//                ]);
//
//            }else{
            $pieces = explode(" ", $item['preco']);
            if(count($pieces) > 1){
                $item['preco'] = str_replace(',', '.', $pieces[1]);
            }

                $precoinfo = Preco::insert([
                    'ID_ANUNCIO_PRODUTO' => $id,
                    'VL_PRODUTO' => floatval($item['preco']),
                    'QT_INICIAL' => floatval($item['inicio']),
                    'QT_FINAL' => floatval($item['fim']),
                ]);
//            }




        }
        return $precoinfo;
    }
    public static function precoWeb($id, $data)
    {
        $corinfo = Preco::insert([
            'ID_ANUNCIO_PRODUTO' => $id,
            'VL_PRODUTO' => $data->preco,
            'QT_INICIAL' => $data->qtInicial,
            'QT_FINAL' => $data->qtFinal,
        ]);

        return $corinfo;
    }


}
