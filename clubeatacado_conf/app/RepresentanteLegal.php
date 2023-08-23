<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RepresentanteLegal extends Model
{
    protected $table = 'TB_REPRESENTANTE_LEGAL';

    protected $fillable = [
        'ID_REPRESENTANTE_LEGAL'
        ,'DS_NOME'
        ,'DS_ENDERECO'
        ,'NR_RG'
        ,'NR_CPF'
        ,'DT_NASCIMENTO'
    ];

    public static function cadastrarRepresentanteLegal($data)
    {     
          
        $items = [];          
            if (array_key_exists("representanteLegal", $data)) {
                $items['DS_NOME'] =  $data->representanteLegal;
            }
            if (array_key_exists("RGRepresentanteLegal", $data)) {
                $items['NR_RG'] = $data->RGRepresentanteLegal;
            }
            if (array_key_exists("EnderecoRepresentanteLegal", $data)) {
                $items['DS_ENDERECO'] = $data->EnderecoRepresentanteLegal;
            }
            if (array_key_exists("CPFRepresentante", $data)) {
                $items['NR_CPF'] = $data->CPFRepresentante;
            }
            // if (array_key_exists("dtRepresentante", $data)) {
            //     $items['DT_NASCIMENTO'] = $data->dtRepresentante;
            // }                                        
            if ($items != []) {
                $idRepresentanteLegal = DB::table('TB_REPRESENTANTE_LEGAL')->insertGetId($items);                  
            } else {               
                $idRepresentanteLegal = 0;
            }         
        return $idRepresentanteLegal;
    }

    public static function recuperarRepresentanteLegal($dados)
    {        
        $representante = DB::table('TB_PRODUTOR')   
        ->where('TB_PRODUTOR.ID_PRODUTOR', $dados->idProdutor)   
        ->select('TB_PRODUTOR.ID_REPRESENTANTE_LEGAL')
        ->get();  
        return $representante[0]->ID_REPRESENTANTE_LEGAL;
    }

    public static function atualizarRepresentanteLegal($dados, $idRepresentanteLegal)
    {
        $representante['DS_NOME'] = $dados->DS_NOME_REPRESENTANTE_LEGAL;
        $representante['DS_ENDERECO'] = $dados->DS_ENDERECO_REPRESENTANTE_LEGAL;
        $representante['NR_RG'] = $dados->NR_RG_REPRESENTANTE_LEGAL;
        $representante['NR_CPF'] = $dados->NR_CPF_REPRESENTANTE_LEGAL;
        $representante['DT_NASCIMENTO'] = $dados->DT_NASCIMENTO_REPRESENTANTE_LEGAL;
        $idProduto = DB::table('TB_REPRESENTANTE_LEGAL')
            ->where('TB_REPRESENTANTE_LEGAL.ID_REPRESENTANTE_LEGAL', $idRepresentanteLegal)
            ->update($representante);
        return $representante;
    }
       
}
