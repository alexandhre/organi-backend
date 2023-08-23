<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Endereco extends Model
{
    protected $table = 'TB_BAIRRO';

    protected $fillable = [
        'ID_BAIRRO'
        ,'ID_CIDADE'
        ,'DS_BAIRRO'
        ,'DS_COMPLEMENTO'
        ,'NR_ENDERECO'
        ,'DS_CEP'
    ];
    public static function updateOrCreat($data, $id)
    {
        $address = Endereco::join('TB_ANUNCIANTE','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')->where('TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL', '=', $id)->get();

        if(count($address)>0){


            $endereco = DB::table('TB_BAIRRO')
                ->join('TB_ANUNCIANTE','TB_BAIRRO.ID_BAIRRO','TB_ANUNCIANTE.ID_BAIRRO')
                ->where('TB_ANUNCIANTE.ID_ANUNCIANTE_LARAVEL',$id)
                ->update([
                    'ID_CIDADE'=>1,
                    'TB_BAIRRO.DS_COMPLEMENTO'=>$data[5],
                    'TB_BAIRRO.DS_BAIRRO'=>$data[6],
                    'TB_BAIRRO.NR_ENDERECO'=>$data[7],
                    'TB_BAIRRO.DS_CEP'=>$data[8],

                ]);
                if($endereco == 1) return $address['0']->ID_BAIRRO;

        }else{
           $endereco= Endereco::create([
                'ID_CIDADE' => 1,
                'DS_COMPLEMENTO' =>$data[5],
                'DS_BAIRRO' =>$data[6],
                'NR_ENDERECO' =>$data[7],
                'DS_CEP' => $data[8],

            ]);
            return $endereco->id;
        }

    }



}
