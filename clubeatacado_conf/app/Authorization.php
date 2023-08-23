<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Authorization extends Model
{
    protected $table = 'TB_AUTHORIZATION';

    protected $fillable = [
        'ID_AUTHORIZATION',
        'ID_USUARIO',
        'DT_CREATE',
        'DT_EXPIRACAO'
    ];

    public static function salvarSessao($idUsuario)
    {
        $sessao = Authorization::create([
            'ID_USUARIO' => $idUsuario
        ]);
        return $sessao;
    }

    public static function validarSessao($idUsuario)
    {
        $sessao = DB::table('TB_AUTHORIZATION')
            ->where('TB_AUTHORIZATION.ID_USUARIO', $idUsuario)
            ->get();

        $date1 = Carbon::parse(Carbon::now());
        $date2 = Carbon::parse($sessao[0]->DT_EXPIRACAO);
        if ($date1->gt($date2)) {
            $sessao[0]->SESSAO_VALIDA = false;
        } else if ($date2->gt($date1)) {
            $sessao[0]->SESSAO_VALIDA = true;
        } else if ($date1->eq($date2)) {
            $sessao[0]->SESSAO_VALIDA = true;
        }

        return $sessao[0]->SESSAO_VALIDA;
    }

    public static function deletarSessao($idUsuario)
    {
        $sessao = DB::table('TB_AUTHORIZATION')
        ->where('TB_AUTHORIZATION.ID_USUARIO', $idUsuario)
        ->delete();

        return $sessao;
    }
}
