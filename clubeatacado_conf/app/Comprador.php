<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Comprador extends Model
{

    protected $table = 'TB_COMPRADOR';

    protected $fillable = [
        'ID_QUALIFICACAO',
        'ID_CIDADE',
        'DS_NOME',
        'DS_SOBRENOME',
        'ND_CPF',
        'DS_ENDERECO',
        'DS_COMPLEMENTO',
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

    ];

    public static function registrar($dados)
    {

        $comprador = Comprador::create([
            'ID_CIDADE' => 1,
            'DS_NOME' => $dados->DS_NOME,
            'DS_EMAIL' => $dados->DS_EMAIL,
            'DS_LOGIN' => $dados->DS_EMAIL,
            'DS_SENHA' => Hash::make($dados->DS_SENHA)
        ]);
        return $comprador;
    }

    public static function atualizarSenha($email, $senha)
    {
        $updateUser = DB::table('TB_COMPRADOR')
            ->where('DS_EMAIL', $email)
            ->update([
                'DS_SENHA' => Hash::make($senha),
            ]);
        return $updateUser;
    }

    // public static function recuperarDadosComprador($ID_COMPRADOR)
    // {
    //     $comprador = Comprador::
    //     ->where('ID_COMPRADOR', $ID_COMPRADOR)->get();

    //     return $comprador;
    // }

    public static function recuperarDadosComprador($ID_COMPRADOR)
    {
        $comprador = DB::table('TB_COMPRADOR')
            ->leftJoin('TB_PRODUTOR', 'TB_COMPRADOR.ID_COMPRADOR', 'TB_PRODUTOR.ID_COMPRADOR')
            ->where('TB_COMPRADOR.ID_COMPRADOR', $ID_COMPRADOR)
            ->select(
                'TB_COMPRADOR.ID_COMPRADOR',
                'TB_COMPRADOR.ID_QUALIFICACAO',
                'TB_COMPRADOR.DS_NOME',
                'TB_COMPRADOR.DS_SOBRENOME',
                'TB_COMPRADOR.NR_CPF',
                'TB_COMPRADOR.DS_ENDERECO AS DS_ENDERECO_COMPRADOR',
                'TB_COMPRADOR.DS_COMPLEMENTO AS DS_COMPLEMENTO_COMPRADOR',
                'TB_COMPRADOR.NR_ENDERECO AS NR_ENDERECO_COMPRADOR',
                'TB_COMPRADOR.NR_CEP AS NR_CEP_COMPRADOR',
                'TB_COMPRADOR.ID_CIDADE AS ID_CIDADE_COMPRADOR',
                'TB_COMPRADOR.DS_EMAIL',
                'TB_COMPRADOR.NR_DDD_TELEFONE',
                'TB_COMPRADOR.NR_TELEFONE',
                'TB_COMPRADOR.DS_GMAIL',
                'TB_COMPRADOR.DS_LOGIN',
                'TB_COMPRADOR.DS_FACEBOOK',
                'TB_COMPRADOR.DS_INSTAGRAM',
                'TB_COMPRADOR.DS_VALIDACAO',
                'TB_PRODUTOR.ID_PRODUTOR',
                'TB_PRODUTOR.DS_RAZAO_SOCIAL',
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.ID_CIDADE',
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.NR_CNPJ',
                'TB_PRODUTOR.DS_ENDERECO AS DS_ENDERECO_PRODUTOR',
                'TB_PRODUTOR.NR_ENDERECO AS NR_ENDERECO_PRODUTOR',
                'TB_PRODUTOR.DS_COMPLEMENTO AS DS_COMPLEMENTO_PRODUTOR',
                'TB_PRODUTOR.NR_CEP AS NR_CEP_PRODUTOR',
                'TB_PRODUTOR.DS_TAMANHO_FABRICA',
                'TB_PRODUTOR.QT_EMPREGADOS',
                'TB_PRODUTOR.ID_CATEGORIA_EMPRESA',
                'TB_PRODUTOR.ID_TIPO_NEGOCIO'
            )->get();

        return $comprador;
    }

    public static function recuperarComprasUsuario($ID_COMPRADOR)
    {

        $listaCompras = DB::table('TB_PEDIDO')
            ->where('TB_PEDIDO.ID_COMPRADOR', $ID_COMPRADOR);
        $listaComprasPage = $listaCompras->paginate(9);
        $listaCompras = $listaCompras->get();

        foreach ($listaCompras as $key => $value) {
            $listaItens = DB::table('TB_ITEM_PEDIDO')
                ->join('TB_PEDIDO', 'TB_PEDIDO.ID_PEDIDO', 'TB_ITEM_PEDIDO.ID_PEDIDO')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PEDIDO.ID_ANUNCIO_PRODUTO')
                ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
                ->join('TB_FOTO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->where('TB_ITEM_PEDIDO.ID_PEDIDO', $value->ID_PEDIDO)
                ->where('TB_PEDIDO.DT_PEDIDO', '<' , Carbon::now())
                ->select(
                    'TB_ITEM_PEDIDO.*',
                    'TB_ANUNCIO_PRODUTO.ID_PRODUTO',
                    'TB_PRODUTO.DS_PRODUTO',
                    'TB_FOTO_PRODUTO.*'
                )
                ->get();
            foreach ($listaItens as $key => $item) {
                if ($key == 0) {
                    $value->VL_TOTAL_PEDIDO = $item->VL_ITEM;
                    $value->VL_TOTAL_PEDIDO = $value->VL_TOTAL_PEDIDO + $item->VL_ENVIO;
                    $value->QUANTIDADE_TOTAL_PEDIDO = $item->QT_PRODUTO;
                } else {
                    $value->VL_TOTAL_PEDIDO = $value->VL_TOTAL_PEDIDO + $item->VL_ITEM;
                    $value->VL_TOTAL_PEDIDO = $value->VL_TOTAL_PEDIDO + $item->VL_ENVIO;
                    $value->QUANTIDADE_TOTAL_PEDIDO = $value->QUANTIDADE_TOTAL_PEDIDO + $item->QT_PRODUTO;
                }
            }
            $value->ITENS_PEDIDO = $listaItens;
        }

        $response = [
            'listaCompras' => $listaCompras,
            'listaComprasPage' => $listaComprasPage
        ];

        return $response;

    }

    public static function recuperarFavoritosByUser($ID_COMPRADOR)
    {
        $listaFavoritos = DB::table('TB_FAVORITO')
            ->select('TB_FAVORITO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO', 'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_FAVORITO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')           
            ->where('TB_FAVORITO.ID_COMPRADOR', $ID_COMPRADOR)
            ->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC');
            
            $listaFavoritosPage = $listaFavoritos->paginate(9);           
            $listaFavoritos = $listaFavoritos->get();   

            foreach ($listaFavoritos as $key => $item){
                $item->foto = DB::table('TB_FOTO_PRODUTO')
                    ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                    ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                        'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO')
                    ->limit(1)
                    ->get();     
                    if(count($item->foto) > 0){
                        $item->DS_FOTO_PRODUTO = "http://testetendering.myappnow.com.br/images/anuncios/". $item->ID_ANUNCIO_PRODUTO . "/" . $item->foto[0]->DS_FOTO_PRODUTO;
                    }                                                
            }  
            

            $response = [
                'listaFavoritos' => $listaFavoritos,
                'listaFavoritosPage' => $listaFavoritosPage
            ];
    
            return $response;
    }

    public static function recuperarDadosCompradorPorEmail($DS_EMAIL)
    {
        $comprador = DB::table('TB_COMPRADOR')
            ->leftJoin('TB_PRODUTOR', 'TB_PRODUTOR.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->where('DS_EMAIL', $DS_EMAIL)
            ->select(
                'TB_COMPRADOR.ID_COMPRADOR',
                'TB_COMPRADOR.ID_QUALIFICACAO',
                'TB_COMPRADOR.DS_NOME',
                'TB_COMPRADOR.DS_SOBRENOME',
                'TB_COMPRADOR.NR_CPF',
                'TB_COMPRADOR.DS_ENDERECO AS DS_ENDERECO_COMPRADOR',
                'TB_COMPRADOR.DS_COMPLEMENTO AS DS_COMPLEMENTO_COMPRADOR',
                'TB_COMPRADOR.NR_ENDERECO AS NR_ENDERECO_COMPRADOR',
                'TB_COMPRADOR.NR_CEP AS NR_CEP_COMPRADOR',
                'TB_COMPRADOR.ID_CIDADE AS ID_CIDADE_COMPRADOR',
                'TB_COMPRADOR.DS_EMAIL',
                'TB_COMPRADOR.NR_DDD_TELEFONE',
                'TB_COMPRADOR.NR_TELEFONE',
                'TB_COMPRADOR.DS_GMAIL',
                'TB_COMPRADOR.DS_LOGIN',
                'TB_COMPRADOR.DS_FACEBOOK',
                'TB_COMPRADOR.DS_INSTAGRAM',
                'TB_COMPRADOR.DS_VALIDACAO',
                'TB_PRODUTOR.ID_PRODUTOR',
                'TB_PRODUTOR.DS_RAZAO_SOCIAL',
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.ID_CIDADE',
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.NR_CNPJ',
                'TB_PRODUTOR.DS_ENDERECO AS DS_ENDERECO_PRODUTOR',
                'TB_PRODUTOR.NR_ENDERECO AS NR_ENDERECO_PRODUTOR',
                'TB_PRODUTOR.DS_COMPLEMENTO AS DS_COMPLEMENTO_PRODUTOR',
                'TB_PRODUTOR.NR_CEP AS NR_CEP_PRODUTOR',
                'TB_PRODUTOR.DS_TAMANHO_FABRICA',
                'TB_PRODUTOR.QT_EMPREGADOS',
                'TB_PRODUTOR.ID_CATEGORIA_EMPRESA',
                'TB_PRODUTOR.ID_TIPO_NEGOCIO'
            )->first();

        return $comprador;
    }

    public static function atualizarDadosComprador($data)
    {
        $foto_usuario = '0';
        $items = [];
        if (array_key_exists("DS_NOME", $data)) {
            $items['DS_NOME'] =  $data->DS_NOME;
        }
        if (array_key_exists("DS_SOBRENOME", $data)) {
            $items['DS_SOBRENOME'] = $data->DS_SOBRENOME;
        }
        if (array_key_exists("NR_CPF", $data)) {
            $items['NR_CPF'] = $data->NR_CPF;
        }
        if (array_key_exists("DS_EMAIL", $data)) {
            $items['DS_EMAIL'] = $data->DS_EMAIL;
            $items['DS_LOGIN'] = $data->DS_EMAIL;
        }
        if (array_key_exists("gmail", $data)) {
            $items['DS_GMAIL'] = $data->gmail;
        }
        if (array_key_exists("telefone", $data)) {
            $ddd_cliente = substr($data->telefone, 1, 3);
            $items['NR_DDD_TELEFONE'] = $ddd_cliente;
            $items['NR_TELEFONE'] = $data->telefone;
        }
        if (array_key_exists("id_cidade", $data)) {
            $items['ID_CIDADE'] = $data->id_cidade;
        }
        if (array_key_exists("endereco", $data)) {
            $items['DS_ENDERECO'] = $data->endereco;
        }
        if (array_key_exists("nr_endereco", $data)) {
            $items['NR_ENDERECO'] = $data->nr_endereco;
        }
        if (array_key_exists("complemento", $data)) {
            $items['DS_COMPLEMENTO'] = $data->complemento;
        }
        if (array_key_exists("cep", $data)) {
            $items['NR_CEP'] = $data->cep;
        }
        // if (array_key_exists("senha", $data)) {
        //     $items['DS_SENHA'] = Hash::make($data->senha);
        // }
        if (array_key_exists("facebook", $data)) {
            $items['DS_FACEBOOK'] = $data->facebook;
        }
        if (array_key_exists("instagram", $data)) {
            $items['DS_INSTAGRAM'] = $data->instagram;
        }
        // if (array_key_exists("fotoComprador", $data)) {
        //     $items['DS_FOTO_COMPRADOR'] = $data->fotoComprador;
        //     $foto_usuario = $data->fotoComprador;
        // }                       
        if ($items != []) {
            $update = DB::table('TB_COMPRADOR')
                ->where('ID_COMPRADOR', $data->id_comprador)
                ->update($items);
        } else {
            $update = 0;
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
        return $update;
    }

    public static function updateByIdWeb($data, $usuarioId)
    {

        $uf = DB::table('TB_UF')->where('DS_UF', $data[11])->select('ID_UF')->first();

        if (DB::table('TB_CIDADE')->where('DS_CIDADE', $data[12])->count() < 1) {

            DB::table('TB_CIDADE')->insert(['ID_UF' => $uf->ID_UF, 'DS_CIDADE' => $data[12]]);
        }

        $cidade = DB::table('TB_CIDADE')
            ->where('DS_CIDADE', $data[12])
            ->where('ID_UF', $uf->ID_UF)
            ->select('ID_CIDADE')
            ->first();


        $update = DB::table('TB_COMPRADOR')
            ->where('ID_COMPRADOR', $usuarioId)
            ->update([
                //                'ID_QUALIFICACAO' => $data[0],
                'ID_CIDADE' => $cidade->ID_CIDADE,
                'DS_NOME' => $data[2],
                'DS_SOBRENOME' => $data[6],
                //                'NR_CPF'=>$data[4],
                'DS_ENDERECO' => $data[8],
                'NR_ENDERECO' => $data[9],
                'DS_COMPLEMENTO' => $data[7],
                'NR_CEP' => $data[10],
                'NR_DDD_TELEFONE' => $data[4],
                'NR_TELEFONE' => $data[3],
                'DS_EMAIL' => $data[5],
                'DS_LOGIN' => $data[5],
                'DS_FACEBOOK' => $data[30],
                'DS_INSTAGRAM' => $data[31],
                'DS_GMAIL' => $data[32],

            ]);

        if ($data[17] != null) {

            $updateUser = DB::table('TB_COMPRADOR')
                ->where('ID_COMPRADOR', $usuarioId)
                ->update([
                    'DS_SENHA' => Hash::make($data[17]),
                ]);
        }

        if (isset($data[42])) {

            if (!(file_exists("images\\usuarios\\" . $usuarioId))) {

                \File::makeDirectory('images\\usuarios\\' . $usuarioId, 0777, false);
            }

            $launch = explode(".", $data[42]);

            $form = end($launch);

            $name = "photoUser" . substr(md5(rand(600000, 12000000)), 0, 8) . '.' . $form;


            $oldPath = ("images\\resource\\tmp\\usuarios\\" . $data[42]);
            $newPath = ("images\\usuarios\\" . $usuarioId . "\\" . $name);
            $file = new Filesystem();

            if ($file->moveDirectory($oldPath, $newPath)) {
                $files = glob("images/usuarios/" . $usuarioId . "/*"); // get all file names
                foreach ($files as $file) { // iterate files

                    if ($file !== 'images/usuarios/' . $usuarioId . '/' . $name)
                        unlink($file); // delete file
                }

                $update = DB::table('TB_COMPRADOR')
                    ->where('ID_COMPRADOR', $usuarioId)
                    ->update(['DS_FOTO_COMPRADOR' => $name]);
                session([
                    'photo' => $name,
                ]);
            }
        }


        for ($i = 13; $i < 17; $i++) {

            if ($data[$i] != null) {
                $newPath =  ("images\\empresas\\" . $usuarioId);
                $extecao = explode(".", $data[$i]);
                $extecao = end($extecao);
                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }

                $fotos = [];
                $files = glob("images\\empresas\\" . $usuarioId . "/*"); // get all file names

                foreach ($files as $file) { // iterate files
                    $pieces = explode("images\\empresas\\" . $usuarioId . "/", $file);
                    if (!in_array($pieces[1], $data[45])) {
                        array_push($fotos, $pieces[1]);
                        if (unlink($file)) {
                            FotoAtacadista::where('DS_FOTO_PRODUTOR', $pieces[1])->delete();
                        }
                    }
                }

                $file = new Filesystem();
                //adicionar pasta usuario
                $extecao = explode(".", $data[$i]);
                $extecao = end($extecao);
                $name = "photoEmp" . ($i - 12) . substr(md5(rand(600000, 12000000)), 0, 8) . "." . $extecao;
                if ($file->moveDirectory('images\\resource\\tmp\\empresa\\' . $data[$i],  'images\\empresas\\' . $usuarioId . "\\" . $name)) {
                    $id_atacado = Atacadista::findId($usuarioId);
                    $foto = FotoAtacadista::fotoAtacadista($id_atacado, $name);
                } else {

                    $errors = error_get_last();
                    $error = $errors['type'];
                    $response = [
                        'error' => $error
                    ];
                }
            }
        }
        if ($update == 1 || $updateUser == 1) {
            return "ok";
        } else {
            return response()->json(['error' => 'update erro'], 423);
        }
    }

    public static function findId($id_user)
    {
        $id = DB::table('TB_PRODUTOR')
            ->where('ID_PRODUTOR', $id_user)
            ->select('ID_COMPRADOR')
            ->first();

        return $id->ID_COMPRADOR;
    }

    public static function getEstados()
    {
        return DB::table('cepbr_estado')->select('estado', 'uf')->get();
    }

    public static function getCidades($id)
    {
        return DB::table('cepbr_cidade')->where('uf', $id)->select('cidade', 'id_cidade')->orderBy('cidade', 'ASC')->get();
    }
}
