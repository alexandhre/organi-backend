<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Json extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        foreach ($request as $item){
            $item->ID_USUARIO,
            $item->ID_PERFIL_USUARIO,
            $item->DS_NOME,
            $item->DS_SOBRENOME,
            $item->DS_DDD_TELEFONE,
            $item->DS_NR_TELEFONE,
            $item->DS_EMAIL,
            $item->DS_FOTO,
            $item->VL_AVALIACAO_COLETOR,
            $item->VL_AVALIACAO_ANUNCIANTE,
            $item->QT_COLETAS,
            $item->QT_DOACOES,
            $item->ID_SELO,
            $item->pessoaFisica,
            $item->pessoaJuridica
        }

        return parent::toArray($request);
    }
}
