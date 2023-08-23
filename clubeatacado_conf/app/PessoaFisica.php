<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PessoaFisica extends Model
{
    protected $table = 'TB_PESSOA_FISICA';

    protected $fillable=[
        'ID_USUARIO','ID_PESSOA_FISICA','NR_CPF','NR_CONTRATO_ENERGIA',
    ];

    public static function listaPessoa($id_user){
        $listaPessoa = DB::table('TB_PESSOA_FISICA')
            ->where('TB_PESSOA_FISICA.ID_USUARIO',$id_user)
            ->get();
        return $listaPessoa;
    }
}
