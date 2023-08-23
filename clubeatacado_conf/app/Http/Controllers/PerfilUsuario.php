<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PerfilUsuario extends Controller
{
    protected $table = 'TB_TIPO_SELO';

    protected $fillable = [
        'ID_TIPO_SELO', 'DS_TIPO_SELO'

    ];

    public static function listarperfil(){

            $perfis = DB::table('TB_TIPO_SELO')
                ->select( 'ID_TIPO_SELO', 'DS_TIPO_SELO')
                ->get();
            foreach ($perfis as $value){
                $perfil[] =[
                    'perfilId'=>$value->ID_TIPO_SELO,
                    'perfilNome'=>$value->DS_TIPO_SELO
                ];
            }

            $response=[
                'tipoperfil'=>$perfil,
            ];

        return response()->json(compact('response'));
    }
}
