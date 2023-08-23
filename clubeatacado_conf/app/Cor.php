<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cor extends Model
{

    protected $table = 'TB_COR_PRODUTO';

    protected $fillable=[
        'ID_ANUNCIO_PRODUTO',
        'DS_FOTO_COR',
        'ID_COR',
        'DS_COR'
    ];

    public static function cor($cor, $id)
    {
        foreach ($cor as $item) {

            $corinfo = Cor::insert([
                'ID_ANUNCIO_PRODUTO' => $id,
                'DS_COR' => $item,
                'ID_COR' => 1,
            ]);
        }
        return $corinfo;
    }

    public static function listcor()
    {
        $cores = DB::table('TB_COR')
            ->select('DS_COR'
                            ,'ID_COR'
                            ,'DS_CODIGO')
            ->get();

        return $cores;
    }
    public static function corAnuncio($id){
        $cores = DB::table('TB_COR_PRODUTO')
            ->where('DS_COR', $id)
            ->select('DS_COR','ID_ANUNCIO_PRODUTO')
            ->get();

        return $cores;
    }


}
