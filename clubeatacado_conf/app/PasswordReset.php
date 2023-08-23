<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PasswordReset extends Model
{
    protected $table = 'TB_COMPRADOR';

    protected $fillable = [
        'ID_QUALIFICACAO',
        'ID_CIDADE',
        'DS_NOME',
        'DS_SOBRENOME',
        'ND_CPF',
        'DS_ENDERECO',
        'DS_COMPLETO',
        'NR_ENDERECO',
        'NR_CEP',
        'DS_EMAIL',
        'NR_DDD_TELEFONE',
        'NR_TELEFONE',
        'DS_GMAIL',
        'DS_LOGIN',
        'DS_SENHA',
        'DS_FACEBOOK',
        'DS_INSTAGRAM',
        'DS_FOTO_COMPRADOR',
        'DT_CADASTRO_COMPRADOR',
        'id_user',
//        'name', 'email', 'password','id_perfil','validade'
    ];
}
