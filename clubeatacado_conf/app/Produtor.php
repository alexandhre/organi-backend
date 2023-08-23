<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produtor extends Model
{
    protected $table = 'TB_PRODUTOR';

    protected $fillable = [
        'ID_PRODUTOR'
        ,'ID_QUALIFICACAO'
        ,'ID_CIDADE'
        ,'DS_RAZAO_SOCIAL'
        ,'DS_NOME_FANTASIA'
        ,'NR_CNPJ'
        ,'VL_TAXA_RESPOSTA'
        ,'VL_TEMPO_RESPOSTA'
        ,'QT_TRANSACOES'
        ,'DS_ENDERECO'
        ,'NR_ENDERECO'
        ,'NR_CEP'
        ,'DT_CADASTRO'
        ,'DS_LOGOTIPO'
        ,'DS_VIDEO_PROMOCIONAL'
        ,'DS_TAMANHO_FABRICA'
        ,'QT_EMPREGADOS'
        ,'DS_CONTROLE_QUALIDADE'
        ,'ID_COMPRADOR'
        ,'ID_CATEGORIA_EMPRESA'
        ,'ID_TIPO_NEGOCIO'
    ];

    public static function recuperarDados($id)
    {
        $fornecedor = DB::table('TB_PRODUTOR')   
        ->leftJoin('TB_REPRESENTANTE_LEGAL','TB_PRODUTOR.ID_REPRESENTANTE_LEGAL','TB_REPRESENTANTE_LEGAL.ID_REPRESENTANTE_LEGAL')
        ->where('TB_PRODUTOR.ID_COMPRADOR',$id)   
        ->select(
            'TB_REPRESENTANTE_LEGAL.*',
            'TB_PRODUTOR.*',
            'TB_PRODUTOR.DS_ENDERECO AS DS_ENDERECO_PRODUTOR')
        ->get();           
        return $fornecedor;
    }

    public static function atualizarDadosProdutor($data)
    {     
        $foto_usuario = '0';
        $items = [];          
        if (array_key_exists("ID_CATEGORIA_EMPRESA", $data)) {
            $items['ID_CATEGORIA_EMPRESA'] =  $data->ID_CATEGORIA_EMPRESA;
        }
        if (array_key_exists("ID_TIPO_NEGOCIO", $data)) {
            $items['ID_TIPO_NEGOCIO'] =  $data->ID_TIPO_NEGOCIO;
        }
            if (array_key_exists("DS_RAZAO_SOCIAL", $data)) {
                $items['DS_RAZAO_SOCIAL'] =  $data->DS_RAZAO_SOCIAL;
            }
            if (array_key_exists("DS_NOME_FANTASIA", $data)) {
                $items['DS_NOME_FANTASIA'] = $data->DS_NOME_FANTASIA;
            }
            if (array_key_exists("NR_CNPJ", $data)) {
                $items['NR_CNPJ'] = $data->NR_CNPJ;
            }
            if (array_key_exists("DS_TELEFONE", $data)) {
                $items['DS_TELEFONE'] = $data->DS_TELEFONE;
            }
            if (array_key_exists("DS_TELEFONE_COMERCIAL", $data)) {
                $items['DS_TELEFONE_COMERCIAL'] = $data->DS_TELEFONE_COMERCIAL;
            }
            if (array_key_exists("DT_NASCIMENTO_FUNDACAO", $data)) {
                //converter data
                $items['DT_NASCIMENTO_FUNDACAO'] = $data->DT_NASCIMENTO_FUNDACAO;
            }
            if (array_key_exists("QT_EMPREGADOS", $data)) {
                $items['QT_EMPREGADOS'] = $data->QT_EMPREGADOS;
            }
            if (array_key_exists("ID_CIDADE", $data)) {               
                $items['ID_CIDADE'] = $data->ID_CIDADE;
            }
            if (array_key_exists("DS_ENDERECO_PRODUTOR", $data)) {
                $items['DS_ENDERECO'] = $data->DS_ENDERECO_PRODUTOR;
            }
            if (array_key_exists("NR_ENDERECO_PRODUTOR", $data)) {
                $items['NR_ENDERECO'] = $data->NR_ENDERECO_PRODUTOR;
            }
            if (array_key_exists("DS_COMPLEMENTO_PRODUTOR", $data)) {
                $items['DS_COMPLEMENTO'] = $data->DS_COMPLEMENTO_PRODUTOR;
            }
            if (array_key_exists("DS_PONTO_REFERENCIA", $data)) {
                $items['DS_PONTO_REFERENCIA'] = $data->DS_PONTO_REFERENCIA;
            }
            if (array_key_exists("NR_CEP_PRODUTOR", $data)) {
                $items['NR_CEP'] = $data->NR_CEP_PRODUTOR;
            }                              
            if (array_key_exists("DS_ENQUADRAMENTO_AGRICULTOR", $data)) {
                $items['DS_ENQUADRAMENTO_AGRICULTOR'] = $data->DS_ENQUADRAMENTO_AGRICULTOR;
            }
            if (array_key_exists("DS_INSCRICAO_INCRA", $data)) {
                $items['DS_INSCRICAO_INCRA'] = $data->DS_INSCRICAO_INCRA;
            }
            if (array_key_exists("cooperativa", $data)) {
                $items['IN_COOPERATIVA_ASSOCIACAO'] = 1;
            } else {
                $items['IN_COOPERATIVA_ASSOCIACAO'] = 0;
            }
            if (array_key_exists("DS_TERRITORIO_IDENTIDADE", $data)) {
                $items['DS_TERRITORIO_IDENTIDADE'] = $data->DS_TERRITORIO_IDENTIDADE;
            }
            if (array_key_exists("DS_TAMANHO_FABRICA", $data)) {
                $items['DS_TAMANHO_FABRICA'] = $data->DS_TAMANHO_FABRICA;
            }
            if (array_key_exists("DS_DECLARACAO_PRODUTOR", $data)) {
                $items['DS_DECLARACAO_PRODUTOR'] = $data->DS_DECLARACAO_PRODUTOR;
            }
            if (array_key_exists("DS_DECLARACAO_PRONAF_DAF", $data)) {
                $items['DS_DECLARACAO_PRONAF_DAF'] = $data->DS_DECLARACAO_PRONAF_DAF;
            }  
            if (array_key_exists("IN_COOPERATIVA_ASSOCIACAO", $data)) {                
                if($data->IN_COOPERATIVA_ASSOCIACAO == 'true'){
                    $items['IN_COOPERATIVA_ASSOCIACAO'] = 1;
                } else if($data->IN_COOPERATIVA_ASSOCIACAO == 'false'){
                    $items['IN_COOPERATIVA_ASSOCIACAO'] = 0;
                }                
            }            
            $items['ID_COMPRADOR'] = $data->idComprador;
            // if (array_key_exists("fotoComprador", $data)) {
            //     $items['DS_FOTO_COMPRADOR'] = $data->fotoComprador;
            //     $foto_usuario = $data->fotoComprador;
            // }                       
            if ($items != []) {
                $idProdutor = DB::table('TB_PRODUTOR')
                ->where('TB_PRODUTOR.ID_PRODUTOR', $data->idProdutor)
                ->update($items);              
            } else {               
                $idProdutor = 0;
            }           
    
            // if ($foto_usuario != '0') {          
            //     $newPath =  ("images\\usuarios\\" . $data->id);
            //     $oldPath = ("images\\resource\\tmp\\usuarios\\" . $foto_usuario);
    
            //     $launch = explode(".", $foto_usuario);
            //     $form = end($launch);
            //     $string = substr(md5(rand(600000, 12000000)), 0, 4);
            //     $foto = "photoUser" . $string . "." . $form;
    
            //     if (!file_exists($newPath)) {
            //         mkdir($newPath, 0777, true);
            //         chmod($newPath, 0777);
            //     }
            //     $file = new Filesystem();
    
            //     if (file_exists($oldPath)) {
            //         //adicionar pasta usuario
            //         if ($file->moveDirectory("images\\resource\\tmp\\usuarios\\" . $foto_usuario,  "images\\usuarios\\" . $data->id . '\\' . $foto)) {
            //             $update = DB::table('TB_COMPRADOR')
            //                 ->where('ID_COMPRADOR', $data->id)
            //                 ->update(['DS_FOTO_COMPRADOR' => $foto]);
            //         } else {                   
            //             $update = 0;
            //         }
            //     }
            // }       
        return $idProdutor;
    }
       
}
