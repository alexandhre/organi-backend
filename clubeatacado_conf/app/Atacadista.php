<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Atacadista extends Model
{
    protected $table = 'TB_PRODUTOR';

    protected $fillable = [
        'ID_QUALIFICACAO',
        'ID_CIDADE',
        'DS_RAZAO_SOCIAL',
        'DS_NOME_FANTASIA',
        'NR_CNPJ',
        'VL_TAXA_RESPOSTA',
        'VL_TEMPO_RESPOSTA',
        'QT_TRANSACOES',
        'DS_ENDERECO',
        'NR_ENDERECO',
        'DS_COMPLEMENTO',
        'NR_CEP',
        'DS_LOGOTIPO',
        'DS_VIDEO_PROMOCIONAL',
        'DS_TAMANHO_FABRICA',
        'QT_EMPREGADOS',
        'DS_CONTROLE_QUALIDADE',
        'ID_COMPRADOR',
    ];


    //CRIA UM NOVO USUAIRO
    public static function registrar($id)
    {
        
        $userInfo = Atacadista::insertGetId([
            'ID_QUALIFICACAO' => 1,
            'ID_CIDADE' => 1,
            'ID_COMPRADOR' => $id
        ]);
        
        DB::table('TB_CONTATO')->insert(['ID_PRODUTOR' => $userInfo]);

        return $userInfo;
    }

    public static function usuario($id)
    {
        $comprador = DB::table('TB_PRODUTOR')
            ->join('TB_COMPRADOR', 'TB_PRODUTOR.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->join('TB_CONTATO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_CONTATO.ID_PRODUTOR')
            ->join('TB_CIDADE', 'TB_COMPRADOR.ID_CIDADE', 'TB_CIDADE.ID_CIDADE')
            ->join('TB_UF', 'TB_CIDADE.ID_UF', 'TB_UF.ID_UF')
            ->where('TB_PRODUTOR.ID_COMPRADOR', $id)
            ->select(
                'TB_COMPRADOR.ID_COMPRADOR as idUsuario',
                'TB_PRODUTOR.DS_RAZAO_SOCIAL AS razaoSocial',
                'TB_PRODUTOR.DS_NOME_FANTASIA AS nomeFantasia',
                'TB_PRODUTOR.NR_CNPJ AS cnpj',
                'TB_PRODUTOR.VL_TAXA_RESPOSTA AS taxaResposta',
                'TB_PRODUTOR.VL_TEMPO_RESPOSTA AS tempoResposta',
                'TB_PRODUTOR.QT_TRANSACOES AS transacoes',
                'TB_PRODUTOR.DS_ENDERECO AS enderecoEmp',
                'TB_PRODUTOR.NR_ENDERECO AS numEnderecoEmp',
                'TB_PRODUTOR.DS_COMPLEMENTO AS complementoEmp',
                'TB_PRODUTOR.NR_CEP AS cep',
                'TB_PRODUTOR.DS_LOGOTIPO AS logo',
                'TB_PRODUTOR.DS_VIDEO_PROMOCIONAL AS video',
                'TB_PRODUTOR.DS_TAMANHO_FABRICA AS tamanhoFab',
                'TB_PRODUTOR.QT_EMPREGADOS AS empregados',
                'TB_PRODUTOR.DS_CONTROLE_QUALIDADE  AS controle',
                'TB_COMPRADOR.ID_QUALIFICACAO AS qualificacaoId',
                'TB_COMPRADOR.DS_NOME AS nome',
                'TB_COMPRADOR.DS_SOBRENOME AS sobrenome',
                'TB_COMPRADOR.NR_CPF AS cpf',
                'TB_COMPRADOR.DS_ENDERECO AS endereco',
                'TB_COMPRADOR.DS_COMPLEMENTO AS completo',
                'TB_COMPRADOR.NR_ENDERECO AS numEndereco',
                'TB_COMPRADOR.NR_CEP AS cep',
                'TB_COMPRADOR.DS_GMAIL AS gmail',
                'TB_COMPRADOR.DS_FACEBOOK AS facebook',
                'TB_COMPRADOR.DS_INSTAGRAM AS instagram',
                'TB_COMPRADOR.DS_FOTO_COMPRADOR AS fotoComprador',
                'TB_COMPRADOR.DS_EMAIL AS email',
                'TB_COMPRADOR.DS_TOKEN AS expoToken',
                'TB_COMPRADOR.NR_DDD_TELEFONE AS dddTelefone',
                'TB_COMPRADOR.NR_TELEFONE  AS telefone',
                'TB_CONTATO.NR_DDD_TELEFONE AS dddTelefoneContato',
                'TB_CONTATO.NR_TELEFONE  AS telefoneContato',
                'TB_CONTATO.DS_EMAIL AS emailContato',
                'TB_CIDADE.DS_CIDADE as cidade',
                'TB_UF.DS_UF as uf',
                'TB_PRODUTOR.ID_TIPO_NEGOCIO'
            )
            ->get();

        if ($comprador['0']->ID_TIPO_NEGOCIO !== null) {

            $negocio = DB::table('TB_TIPO_NEGOCIO')
                ->where('ID_TIPO_NEGOCIO', $comprador['0']->ID_TIPO_NEGOCIO)
                ->select('TB_TIPO_NEGOCIO.DS_TIPO_NEGOCIO as negocioTipo')->get();

            $comprador['0']->negocioTipo = $negocio['0']->negocioTipo;
        } else {
            $comprador['0']->negocioTipo = null;
        }

        $comprador[0]->cidadeNome = $comprador[0]->cidade;
        $cidade = DB::table('cepbr_cidade')->where('cidade', $comprador[0]->cidade)->select('id_cidade')->first();
        $comprador[0]->cidade =  $cidade->id_cidade;

        if ($comprador[0]->fotoComprador != "") {
            $comprador[0]->fotoComprador = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/" . $comprador[0]->idUsuario . "/" . $comprador[0]->fotoComprador;
        } else {
            $comprador[0]->fotoComprador = NULL;
        }

        return $comprador;
    }

    public static function getAtacadista($id)
    {
        $comprador = DB::table('TB_PRODUTOR')
            ->where('TB_PRODUTOR.ID_PRODUTOR', $id)
            ->select(
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.VL_TAXA_RESPOSTA'
            )
            ->get();

        //        if($comprador[0]->fotoComprador != ""){
        //            $comprador[0]->fotoComprador = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/". $comprador[0]->idUsuario."/".$comprador[0]->fotoComprador;
        //        }else{
        //            $comprador[0]->fotoComprador = NULL;
        //        }


        return $comprador;
    }

    public static function updateById($data)
    {

        $items = [];
        $userItem = [];    
        
        $validateAtacadista = DB::table('TB_PRODUTOR')->where('ID_COMPRADOR', $data->id)->select('ID_COMPRADOR')->first();
        if(count($validateAtacadista) > 0){
            if (array_key_exists("razaoSocial", $data)) {
                $items['DS_RAZAO_SOCIAL'] =  $data->razaoSocial;
            }
            if (array_key_exists("nomeFantasia", $data)) {
    
                $items['DS_NOME_FANTASIA'] = $data->nomeFantasia;
            }
            if (array_key_exists("cnpj", $data)) {
                $items['NR_CNPJ'] = $data->cnpj;
            }
            if (array_key_exists("enderecoEmp", $data)) {
                $items['DS_ENDERECO'] = $data->enderecoEmp;
            }
            if (array_key_exists("numEnderecoEmp", $data)) {
                $items['NR_ENDERECO'] = $data->numEnderecoEmp;
            }
            if (array_key_exists("complementoEmp", $data)) {
                $items['DS_COMPLEMENTO'] = $data->complementoEmp;
            }
            if (array_key_exists("cepEmp", $data)) {
                $items['NR_CEP'] =  $data->cepEmp;
            }
            if (array_key_exists("logo", $data)) {
                $items['DS_LOGOTIPO'] = $data->logo;
            }
            if (array_key_exists("video", $data)) {
                $items['DS_VIDEO_PROMOCIONAL'] = $data->video;
            }
            if (array_key_exists("tamanhoFab", $data)) {
                $items['DS_TAMANHO_FABRICA'] = $data->tamanhoFab;
            }
            if (array_key_exists("empregadosQt", $data)) {
                $items['QT_EMPREGADOS'] = $data->empregadosQt;
            }
            if (array_key_exists("controle", $data)) {
                $items['DS_CONTROLE_QUALIDADE'] = $data->controle;
            }
            if (array_key_exists("transacoes", $data)) {
                $items['QT_TRANSACOES'] = $data->transacoes;
            }
            
            if ($items != []) {
                $update = DB::table('TB_PRODUTOR')
                    ->where('ID_COMPRADOR', $data->id)
                    ->update($items);
            } else {
                $update = 0;
            }
        } else {
            $update = 0;
        }           

        return $update;
    }

    public static function updateByIdWeb($data, $usuarioId)
    {


        $uf = DB::table('TB_UF')->where('DS_UF', $data[24])->select('ID_UF')->first();

        if (DB::table('TB_CIDADE')->where('DS_CIDADE', $data[24])->count() < 1) {

            DB::table('TB_CIDADE')->insert(['ID_UF' => $uf->ID_UF, 'DS_CIDADE' => $data[25]]);
        }

        $cidade = DB::table('TB_CIDADE')
            ->where('DS_CIDADE', $data[25])
            ->where('ID_UF', $uf->ID_UF)
            ->select('ID_CIDADE')
            ->first();

        $update = DB::table('TB_PRODUTOR')
            ->where('ID_COMPRADOR', $usuarioId)
            ->update([
                //'ID_QUALIFICACAO' => $data[0],
                'ID_CIDADE' => $cidade->ID_CIDADE,
                'DS_RAZAO_SOCIAL' => $data[19],
                'DS_NOME_FANTASIA' => $data[0],
                'NR_CNPJ' => $data[1],
                'DS_ENDERECO' => $data[20],
                'NR_ENDERECO' => $data[22],
                'DS_COMPLEMENTO' => $data[21],
                'NR_CEP' => $data[23],
                //'DS_LOGOTIPO'=>$data[12],
                //'DS_VIDEO_PROMOCIONAL'=>$data[13],
                'DS_TAMANHO_FABRICA' => $data[41],
                'QT_EMPREGADOS' => $data[18],
                'ID_TIPO_NEGOCIO' => $data[46],
                'ID_CATEGORIA_EMPRESA' => $data[47],
            ]);

        $id_atacado = Atacadista::findId($usuarioId);

        $update = DB::table('TB_CONTATO')
            ->where('ID_PRODUTOR', $id_atacado)
            ->update([
                'DS_NOME' => $data[33],
                'DS_SOBRENOME' => $data[34],
                'NR_DDD_TELEFONE' => $data[35],
                'NR_TELEFONE' => $data[36],
                'DS_EMAIL' => $data[37],
                'DS_CARGO' => $data[38],
                'NR_WHATSAP' => $data[39],
                'DS_SENHA' => Hash::make($data[40]),
                'DS_LOGIN' => $data[37],
            ]);

        $uf = DB::table('TB_UF')->where('DS_UF', $data[43])->select('ID_UF')->first();

        if (DB::table('TB_CIDADE')->where('DS_CIDADE', $data[44])->count() < 1) {

            DB::table('TB_CIDADE')->insert(['ID_UF' => $uf->ID_UF, 'DS_CIDADE' => $data[44]]);
        }

        $cidade = DB::table('TB_CIDADE')
            ->where('DS_CIDADE', $data[44])
            ->where('ID_UF', $uf->ID_UF)
            ->select('ID_CIDADE')
            ->first();

        $update = DB::table('TB_CIDADE_ATENDIDA')
            ->where('ID_PRODUTOR', $id_atacado)
            ->update([
                'ID_PRODUTOR' => $id_atacado,
                'ID_CIDADE' => $cidade->ID_CIDADE,
            ]);

        if ($data[40] != '') {
            $updateUser = DB::table('TB_CONTATO')
                ->where('ID_PRODUTOR', $id_atacado)
                ->update([
                    'DS_SENHA' => Hash::make($data[40]),
                ]);
        }

        if ($update == 1) {

            return $data;
        } else {
            return 'update erro';
        }
    }

    public static function findId($id_user)
    {
        $id = DB::table('TB_PRODUTOR')
            ->where('ID_COMPRADOR', $id_user)
            ->select('ID_PRODUTOR')
            ->get();

        return $id['0']->ID_PRODUTOR;
    }

    public static function empresaFoto($id)
    {
        $fotos = DB::table('TB_FOTO_PRODUTOR')
            ->where('ID_PRODUTOR', $id)
            ->select('DS_FOTO_PRODUTOR')
            ->get();

        return $fotos;
    }

    public static function getprinciaisCat($id)
    {

        $categorias = DB::table('TB_PRODUTOR')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->where('TB_PRODUTOR.ID_COMPRADOR', $id)
            ->groupBy('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO')
            ->select('TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO', DB::raw('count(*) as total'))
            ->orderby('total', 'DSC')
            ->limit(3)
            ->get();

        return $categorias;
    }
}
