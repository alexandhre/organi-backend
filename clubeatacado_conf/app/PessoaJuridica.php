<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PessoaJuridica extends Model
{
    protected $table = 'TB_PESSOA_JURIDICA';

    protected $fillable=[
        'ID_USUARIO','ID_PESSOA_JURIDICA','ID_TIPO_PJ','DS_RAZAO_SOCIAL','DS_NOME_FANTASIA','NR_CNPJ','IN_COLETA_REVERSA','IN_VALE_LUZ'
    ];

    public static function listaJuridico($id_user){
        $listaJuridico = DB::table('TB_PESSOA_JURIDICA')
            ->where('TB_PESSOA_JURIDICA.ID_USUARIO',$id_user)
            ->get();
        return $listaJuridico;
    }
}
