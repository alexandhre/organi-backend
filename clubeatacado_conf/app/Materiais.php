<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Anuncio;

class Materiais extends Model
{
    protected $table = 'TB_TIPO_RESIDUO';
    protected $fillable = ['DS_TIPO_RESIDUO','DS_DESCRICAO'];


    public static function listarMateriais(){
        $materiais = DB::table('TB_TIPO_RESIDUO')
            ->select('DS_TIPO_RESIDUO','DS_DESCRICAO')
            ->get();

        return $materiais;
    }

    public static function pesquisa($dados){

            $anuncio =  Anuncio::pesquisaAnuncio($dados);

            $json = json_decode(json_encode($anuncio,true));

            foreach ($json as $item){

                $item->fotos = DB::table('TB_FOTO_ANUNCIO')
                    ->where('ID_ANUNCIO_RESIDUO', $item->ID_ANUNCIO_RESIDUO)
                    ->select('DS_FOTO_ANUNCIO')
                    ->get();

                $item->endereco = DB::table('TB_ENDERECO')
                    ->where('ID_USUARIO', $item->ID_USUARIO_ANUNCIANTE)
                    ->select('DS_ENDERECO')
                    ->get();

                $item->nome = DB::table('TB_USUARIO')
                    ->where('ID_USUARIO', $item->ID_USUARIO_ANUNCIANTE)
                    ->select('DS_NOME')
                    ->get();

            }

            $pesquisares=[
                $json
            ];
            return $pesquisares;
    }
}
