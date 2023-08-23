<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Produto extends Model
{
    protected $table = 'TB_PRODUTO';

    protected $fillable = [
        'ID_PRODUTO',
        'ID_TIPO_PRODUTO',
        'DS_PRODUTO',
        'DS_UNIDADE_MEDIDA',
        'CD_NCM_2017',
        'CD_CPC_21',
        'DS_NOME_CIENTIFICO',
        'CD_ICC_FAO_2006',
        'CD_ICC_FAO_V1',
        'CD_FAO_COMMODITIES_1990',
        'CD_ALTERACOES_2018',
        'DS_DESCRICAO'
    ];

    public static function produto($data)
    {
        $value[] = $data['codigo'];
        $value[] = $data['nome'];
        $value[] = $data['nome'];

        $value[] = md5(strval(date("Y-m-d H:i:s")));

        $produto = DB::select("exec adm_myapp.insertNovoProduto ?,?,?,?", $value);
        // if(Produto::where('DS_PRODUTO',$data['nome'])->count() < 1){
        //     $value[] = $data['codigo'];
        //     $value[] = $data['nome'];
        //     $value[] = $data['nome'];

        //     $value[] = md5(strval(date("Y-m-d H:i:s")));

        //     $produto = DB::select("exec adm_myapp.insertNovoProduto ?,?,?,?", $value);
        // }
        // else{
        //     $produto = Produto::where('DS_PRODUTO',$data['nome'])->limit(1)->orderBy('DS_PRODUTO','DSC')->get();
        // }

        //        $produto = Produto::create([
        //            'ID_CATEGORIA_PRODUTO' => $data['codigo'],
        //            'DS_PRODUTO' => $data['produto'],
        //            'DS_FOTO_PRODUTO' => $data['produto'],
        //        ]);

        return $produto[0]->ID_PRODUTO;
    }

    public static function recuperarTipoProduto()
    {

        $listaTipoProdutos = DB::table('TB_TIPO_PRODUTO')->get();
        return $listaTipoProdutos;
    }

    public static function produtoByCategoria($id)
    {

        $produtos = Produto::join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('ID_CATEGORIA_PRODUTO', $id)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'ID_PRODUTOR as IdAtacadista',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO as idProduto',
                'DS_ANUNCIO_PRODUTO as titulo',
                'DS_DETALHE_PRODUTO as descricao',
                'VL_DESCONTO as vlDesconto',
                'VL_PRODUTO_UNITARIO as vlProduto',
                'QT_MINIMA_PEDIDO as qtMinima'
            )
            ->orderBy('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'DSC')
            ->get();

        foreach ($produtos as $key => $item) {
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            $item->foto = "http://atacado.club/clubeatacado/images/anuncio/" . $item->anuncioId . "/" . $item->foto[0]->DS_FOTO_PRODUTO;
        }


        return $produtos;
    }

    public static function listarProdutos($in_promocao, $id_comprador)
    {

        $produtos = DB::table('TB_PRODUTO');

        if ($in_promocao) {
            $produtos->where("TB_ANUNCIO_PRODUTO.IN_PROMOCAO", 1);
        }

        $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO', 'TB_CATEGORIA_PRODUTO.DS_FEATURED_CONTROL')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->where('TB_CATEGORIA_PRODUTO.IN_HOME', "1")
            ->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC');
        $produtosPage = $produtos->paginate(9);
        // if($limite != 0){
        //     $produtos = $produtos->offset($inicio)->limit($limite)->get();
        // }
        $produtos = $produtos->get();
        
        foreach ($produtos as $key => $item) {
            $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_FAVORITO.ID_COMPRADOR', $id_comprador)
                ->get();
            if (count($item->FLAG_FAVORITO) > 0) {
                $item->FLAG_FAVORITO = 1;
            } else if (count($item->FLAG_FAVORITO) == 0) {
                $item->FLAG_FAVORITO = 0;
            }
        }
        
        foreach ($produtos as $key => $item) {
            $item->FLAG_CARRINHO = DB::table('TB_CARRINHO_PRODUTO')
                ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $id_comprador)
                ->get();
            if (count($item->FLAG_CARRINHO) > 0) {
                $item->FLAG_CARRINHO = 1;
            } else if (count($item->FLAG_CARRINHO) == 0) {
                $item->FLAG_CARRINHO = 0;
            }
        }
        
        $response = [
            'produtos' => $produtos,
            'produtosPage' => $produtosPage
        ];

        return $response;
    }

    public static function listarProdutosRecentes($id_comprador)
    {

        $produtos = DB::table('TB_PRODUTO');
        $dataAtual = Carbon::now();
        $dataFormatada = $dataAtual->subDays(30)->format('Y-m-d');
        $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO')
            ->whereDate('TB_ANUNCIO_PRODUTO.DT_ANUNCIO_PRODUTO', '>=', $dataFormatada)
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC');
        $produtos = $produtos->skip(0)->take(10)->get();
        foreach ($produtos as $key => $item) {
            $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_FAVORITO.ID_COMPRADOR', $id_comprador)
                ->get();
            if (count($item->FLAG_FAVORITO) > 0) {
                $item->FLAG_FAVORITO = 1;
            } else if (count($item->FLAG_FAVORITO) == 0) {
                $item->FLAG_FAVORITO = 0;
            }
        }

        foreach ($produtos as $item) {
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->FOTO_ANUNCIO) > 0) {
                $item->FOTO_ANUNCIO =  'https://testetendering.myappnow.com.br/images/anuncios/' . $item->ID_ANUNCIO_PRODUTO . '/' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            }
        }

        return $produtos;
    }

    public static function listarProdutosSemOffset($in_promocao, $id_comprador)
    {

        $produtos = DB::table('TB_PRODUTO');

        if ($in_promocao) {
            $produtos->where("TB_ANUNCIO_PRODUTO.IN_PROMOCAO", 1);
        }

        $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.IN_PROMOCAO', 1)
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC');
        $produtos = $produtos->get();
        foreach ($produtos as $key => $item) {
            $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_FAVORITO.ID_COMPRADOR', $id_comprador)
                ->get();
            if (count($item->FLAG_FAVORITO) > 0) {
                $item->FLAG_FAVORITO = 1;
            } else if (count($item->FLAG_FAVORITO) == 0) {
                $item->FLAG_FAVORITO = 0;
            }
        }

        return $produtos;
    }

    public static function listaProdutosFavoritosByUsuario($idComprador)
    {
        $produtos = DB::table('TB_FAVORITO')
            ->where('TB_FAVORITO.ID_COMPRADOR', $idComprador)
            ->join('TB_ANUNCIO_PRODUTO', 'TB_FAVORITO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->get();

        foreach ($produtos as $key => $item) {
            $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_FAVORITO.ID_COMPRADOR', session()->all()['id'])
                ->get();
            if (count($item->FLAG_FAVORITO) > 0) {
                $item->FLAG_FAVORITO = 1;
            } else if (count($item->FLAG_FAVORITO) == 0) {
                $item->FLAG_FAVORITO = 0;
            }
        }

        return $produtos;
    }

    public static function listarProdutosByUsuario($inicio, $limite, $idComprador)
    {
        $produtor = DB::table('TB_PRODUTOR')->where('TB_PRODUTOR.ID_COMPRADOR', $idComprador)->get();

        if (count($produtor) > 0) {

            $produtos = DB::table('TB_PRODUTO');

            $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
                ->offset($inicio)->limit($limite)
                ->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC');

            $produtos->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $produtor[0]->ID_PRODUTOR);

            return $produtos->get();
        } else {
            return [];
        }
    }

    public static function listarProdutosByCategoria($dados, $VL_PRECO1, $VL_PRECO2)
    {
        $produtos = DB::table('TB_PRODUTO');

        $categorias_array = explode(",", $dados->categoriasId);
        foreach ($categorias_array as $key => $item) {
            $produtos->orWhere("TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO", $item);
        }

        $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO', 'TB_CATEGORIA_PRODUTO.DS_FEATURED_CONTROL')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_TIPO_PRODUTO.ID_CATEGORIA_PRODUTO');

        $produtos = $produtos->orderBy('TB_ANUNCIO_PRODUTO.updated_at', 'DSC')->get();

        foreach ($produtos as $key => $item) {
            $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_FAVORITO.ID_COMPRADOR', $dados->idComprador)
                ->get();
            if (count($item->FLAG_FAVORITO) > 0) {
                $item->FLAG_FAVORITO = 1;
            } else if (count($item->FLAG_FAVORITO) == 0) {
                $item->FLAG_FAVORITO = 0;
            }
        }

        foreach ($produtos as $key => $item) {
            $item->FLAG_CARRINHO = DB::table('TB_CARRINHO_PRODUTO')
                ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $dados->idComprador)
                ->get();
            if (count($item->FLAG_CARRINHO) > 0) {
                $item->FLAG_CARRINHO = 1;
            } else if (count($item->FLAG_CARRINHO) == 0) {
                $item->FLAG_CARRINHO = 0;
            }
        }

        //jogar esse metodo de imprimir query no utils
        // dd($produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO')
        // ->join('TB_TIPO_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')        
        // ->join('TB_ANUNCIO_PRODUTO','TB_PRODUTO.ID_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO')->toSql());   

        return $produtos;
    }

    public static function listarProdutosByNome($DS_INPUT_PESQUISA)
    {
        $produtos = DB::table('TB_PRODUTO');

        $produtos->where('TB_PRODUTO.DS_PRODUTO', 'LIKE', '%' . $DS_INPUT_PESQUISA . '%');

        $produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTO.ID_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO');
        //jogar esse metodo de imprimir query no utils
        // dd($produtos->select('TB_ANUNCIO_PRODUTO.*', 'TB_PRODUTO.DS_UNIDADE_MEDIDA', 'TB_PRODUTO.DS_PRODUTO', 'TB_PRODUTO.ID_TIPO_PRODUTO')
        // ->join('TB_TIPO_PRODUTO','TB_PRODUTO.ID_TIPO_PRODUTO','TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')        
        // ->join('TB_ANUNCIO_PRODUTO','TB_PRODUTO.ID_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTO')->toSql());           
        return $produtos->get();
    }


    public static function recuperarFotoProduto($ID_ANUNCIO_PRODUTO)
    {
        return DB::table('TB_FOTO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $ID_ANUNCIO_PRODUTO)
            ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
            ->limit(1)
            ->get();
    }

    public static function cadastrarNovoProduto($produtos)
    {
        $produto['ID_TIPO_PRODUTO'] = 1;
        $produto['DS_PRODUTO'] = $produtos->nomeProduto;
        $produto['DS_UNIDADE_MEDIDA'] = $produtos->unidade_medida;
        $produto['CD_NCM_2017'] = $produtos->ncm_2017;
        $produto['CD_CPC_21'] = $produtos->cpc_21;
        $produto['DS_NOME_CIENTIFICO'] = $produtos->nome_cientifico;
        $produto['CD_ICC_FAO_2006'] = $produtos->icc_fao_2016;
        $produto['CD_ICC_FAO_V1'] = $produtos->icc_fao_v1;
        $produto['CD_FAO_COMMODITIES_1990'] = $produtos->fao_commodities;
        $produto['CD_ALTERACOES_2018'] = $produtos->alteracoes_2018;
        $produto['CD_PRODUTO'] = $produtos->cd_produto;
        $produto['DS_DESCRICAO'] = $produtos->descricao;

        $idProduto = DB::table('TB_PRODUTO')->insertGetId($produto);
        return $idProduto;
    }

    public static function atualizarProduto($produtos)
    {
        $produto['ID_TIPO_PRODUTO'] = $produtos->tipo_produto;
        $produto['DS_PRODUTO'] = $produtos->nomeProduto;
        $produto['DS_UNIDADE_MEDIDA'] = $produtos->unidade_medida;
        $produto['CD_NCM_2017'] = $produtos->ncm_2017;
        $produto['CD_CPC_21'] = $produtos->cpc_21;
        $produto['DS_NOME_CIENTIFICO'] = $produtos->nome_cientifico;
        $produto['CD_ICC_FAO_2006'] = $produtos->icc_fao_2016;
        $produto['CD_ICC_FAO_V1'] = $produtos->icc_fao_v1;
        $produto['CD_FAO_COMMODITIES_1990'] = $produtos->fao_commodities;
        $produto['CD_ALTERACOES_2018'] = $produtos->alteracoes_2018;
        $produto['CD_PRODUTO'] = $produtos->cd_produto;
        $produto['DS_DESCRICAO'] = $produtos->descricao;

        $idProduto = DB::table('TB_PRODUTO')
            ->where('ID_PRODUTO', $produtos->idProduto)
            ->update($produto);
        return $idProduto;
    }

    public static function recuperarProdutos()
    {
        return DB::table('TB_PRODUTO')
            ->where('TB_PRODUTO.PRODUTO_EXISTENTE', '1')
            ->get();
    }
}
