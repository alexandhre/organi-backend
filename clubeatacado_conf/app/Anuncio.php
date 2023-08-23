<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Preco;
use App\Favorito;
use App\Visita;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class Anuncio extends Model
{
    protected $table = 'TB_ANUNCIO_PRODUTO';

    protected $fillable = [
        'ID_PRODUTOR',
        'ID_PRODUTO',
        'DS_ANUNCIO_PRODUTO',
        'DS_DETALHE_PRODUTO',
        'DS_VIDEO',
        'DT_ANUNCIO_PRODUTO',
        'QT_DISPONIVEL',
        'QT_MINIMA_PEDIDO',
        'DS_CAPACIDADE_FORNECIMENTO',
        'IN_ADULTO',
        'IN_INFANTIL',
        'IN_MASCULINO',
        'IN_FEMININO',
        'VL_DESCONTO',
        'VL_ALTURA_PACOTE',
        'VL_LARGURA_PACOTE',
        'VL_COMPRIMENTO_PACOTE',
        'QT_ITEM_PACOTE',
        'VL_PESO_PACOTE_KG',
        'DS_PACOTE',
        'DS_DETALHES_TRANSPORTE',
        'VL_PRODUTO_UNITARIO',
        'DS_TOKEN',
        'DS_GARANTIA',
        'ID_TIPO_ANUNCIO',
        'IN_PROMOCAO',
        'FLAG_LEILAO'
    ];

    protected $tableFavorito = 'TB_FAVORITO';

    protected $fillablefavotirtos = [
        'ID_COMPRADOR',
        'ID_ANUCIO_PRODUTO',
    ];

    protected $tableCarrinho = 'TB_CARRINHO_PRODUTO';

    protected $fillablecarrinho = [
        'ID_CARRINHO_PRODUTO',
        'ID_COMPRADOR',
        'ID_ANUCIO_PRODUTO',
    ];

    public static function getAnuncioByIdComprador($idComprador)
    {

        $listaAnunciosComprador = DB::table('TB_ANUNCIO_PRODUTO')
            ->select('TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_PRODUTOR','TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->where('TB_PRODUTOR.ID_COMPRADOR', $idComprador);
        $anunciosPage = $listaAnunciosComprador->paginate(9); 
        $listaAnunciosComprador = $listaAnunciosComprador->get();

        foreach ($listaAnunciosComprador as $item) {

            $foto =  self::fotoAnuncioApp($item->ID_ANUNCIO_PRODUTO);

            if (count($foto) <= 0) {
                $item->foto = null;
            } else {
                $item->foto = 'https://testetendering.myappnow.com.br/images/anuncios/' . $item->ID_ANUNCIO_PRODUTO . '/' . $foto['0']->foto;
            }
        }

        $response = [
            'anuncios' => $listaAnunciosComprador,
            'anunciosPage' => $anunciosPage
        ];

        return $response;
    }

    public static function favoritarLeilao($idLeilao, $idUsuario)
    {

        $favoritoLeilao = DB::table('TB_FAVORITO_LEILAO')
            ->where('TB_FAVORITO_LEILAO.ID_LEILAO', $idLeilao)
            ->where('TB_FAVORITO_LEILAO.ID_COMPRADOR', $idUsuario)
            ->get();

        if (count($favoritoLeilao) == 0) {
            DB::table('TB_FAVORITO_LEILAO')
                ->insertGetId([
                    'ID_COMPRADOR' => $idUsuario,
                    'ID_LEILAO' => $idLeilao
                ]);
            $idFavoritoLeilao = 1;
        } else if (count($favoritoLeilao) == 1) {
            DB::table('TB_FAVORITO_LEILAO')
                ->where('TB_FAVORITO_LEILAO.ID_LEILAO', $idLeilao)
                ->where('TB_FAVORITO_LEILAO.ID_COMPRADOR', $idUsuario)
                ->delete();
            $idFavoritoLeilao = 0;
        }

        return $idFavoritoLeilao;
    }

    public static function favoritarAnuncio($idAnuncioProduto, $idUsuario)
    {

        $favoritoUsuario = DB::table('TB_FAVORITO')
            ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)
            ->where('TB_FAVORITO.ID_COMPRADOR', $idUsuario)
            ->get();

        if (count($favoritoUsuario) == 0) {
            DB::table('TB_FAVORITO')
                ->insertGetId([
                    'ID_COMPRADOR' => $idUsuario,
                    'ID_ANUNCIO_PRODUTO' => $idAnuncioProduto
                ]);
            $idFavorito = 1;
        } else if (count($favoritoUsuario) == 1) {
            DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)
                ->where('TB_FAVORITO.ID_COMPRADOR', $idUsuario)
                ->delete();
            $idFavorito = 0;
        }

        return $idFavorito;
    }

    public static function addCarrinho($idAnuncioProduto, $idUsuario)
    {

        $carrinhoProduto = DB::table('TB_CARRINHO_PRODUTO')
            ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)
            ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idUsuario)
            ->get();

        if (count($carrinhoProduto) == 0) {
            DB::table('TB_CARRINHO_PRODUTO')
                ->insertGetId([
                    'ID_COMPRADOR' => $idUsuario,
                    'ID_ANUNCIO_PRODUTO' => $idAnuncioProduto
                ]);
            $idCarrinho = 1;
        } else if (count($carrinhoProduto) == 1) {
            DB::table('TB_CARRINHO_PRODUTO')
                ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)
                ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idUsuario)
                ->delete();
            $idCarrinho = 0;
        }

        return $idCarrinho;
    }

    public static function editarAnuncio($dados, $idProduto)
    {

        $anuncioValor = DB::table('TB_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO'
            )
            ->get();

        $changeValor['VL_PRODUTO_ANTIGO'] = $anuncioValor[0]->VL_PRODUTO_UNITARIO;

        $idAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $dados->idAnuncio)
            ->update($changeValor);

        $idProdutor = Atacadista::findId(session()->all()['id']);

        $anuncio['ID_PRODUTOR'] = $idProdutor;
        $anuncio['ID_PRODUTO'] = $idProduto;
        $anuncio['DS_ANUNCIO_PRODUTO'] = $dados->nomeProduto;
        $anuncio['DS_DETALHE_PRODUTO'] = $dados->descricao;
        $anuncio['QT_DISPONIVEL'] = $dados->qtd_disponivel;
        $anuncio['QT_MINIMA_PEDIDO'] = $dados->qtd_minima;
        $anuncio['DS_CAPACIDADE_FORNECIMENTO'] = $dados->capacidade_fornecimento;
        $anuncio['IN_ADULTO'] = filter_var($dados->adulto, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['IN_INFANTIL'] = filter_var($dados->infantil, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['IN_MASCULINO'] = filter_var($dados->masculino, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['IN_FEMININO'] = filter_var($dados->feminino, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['IN_PROMOCAO'] = filter_var($dados->promocao, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['FLAG_LEILAO'] = filter_var($dados->leilao, FILTER_VALIDATE_BOOLEAN) == true ? 1 : 0;
        $anuncio['VL_DESCONTO'] = $dados->desconto;
        $anuncio['VL_ALTURA_PACOTE'] = $dados->altura_pacote;
        $anuncio['VL_LARGURA_PACOTE'] = $dados->largura_pacote;
        $anuncio['VL_COMPRIMENTO_PACOTE'] = $dados->comprimento_pacote;
        $anuncio['QT_ITEM_PACOTE'] = $dados->qtd_item_pacote;
        $anuncio['VL_PESO_PACOTE_KG'] = $dados->peso_pacote;
        $anuncio['DS_PACOTE'] = $dados->nome_pacote;
        $anuncio['DS_DETALHES_TRANSPORTE'] = $dados->transporte;
        $anuncio['ID_TIPO_ANUNCIO'] = $dados->tipo_anuncio;
        $anuncio['DS_TAGS'] = $dados->tagProduto;
        $anuncio['VL_PRODUTO_UNITARIO'] = $dados->vl_unitario;
        $anuncio['DS_GARANTIA'] = $dados->garantia;

        $idAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $dados->idAnuncio)
            ->update($anuncio);
        return $idAnuncio;
    }

    public static function deletarAnuncio($idAnuncioProduto)
    {
        return DB::table('TB_ANUNCIO_PRODUTO')->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)->delete();
    }

    public static function novoAnuncio($dados, $idProdutor)
    {
        $anuncio = Anuncio::create([
            'ID_PRODUTOR' => $idProdutor,
            'ID_PRODUTO' => $dados->idProdutoNovo,
            'DS_ANUNCIO_PRODUTO' => $dados->nomeProduto,
            'DS_DETALHE_PRODUTO' => $dados->descricao,
            'QT_DISPONIVEL' => $dados->qtd_disponivel,
            'QT_MINIMA_PEDIDO' => $dados->qtd_minima,
            'DS_CAPACIDADE_FORNECIMENTO' => $dados->capacidade_fornecimento,
            'IN_ADULTO' => $dados->adulto ? 1 : 0,
            'IN_INFANTIL' => $dados->infantil ? 1 : 0,
            'IN_MASCULINO' => $dados->masculino ? 1 : 0,
            'IN_FEMININO' => $dados->feminino ? 1 : 0,
            'ID_TIPO_ANUNCIO' => $dados->tipo_anuncio,
            'DS_TAGS' => $dados->tagProduto,
            'IN_PROMOCAO' => 0,
            'FLAG_LEILAO' => 0
        ]);
        return $anuncio->id;
    }

    public static function cadastrarDadosAdicionais($dados)
    {

        $anuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $dados->idAnuncioNovo)
            ->update([
                'VL_PRODUTO_UNITARIO' => $dados->vl_unitario,
                'VL_DESCONTO' => $dados->desconto,
                'VL_ALTURA_PACOTE' => $dados->altura_pacote,
                'VL_LARGURA_PACOTE' => $dados->largura_pacote,
                'VL_COMPRIMENTO_PACOTE' => $dados->comprimento_pacote,
                'QT_ITEM_PACOTE' => $dados->qtd_item_pacote,
                'VL_PESO_PACOTE_KG' => $dados->peso_pacote,
                'DS_PACOTE' => $dados->nome_pacote,
                'DS_DETALHES_TRANSPORTE' => $dados->transporte,
                'DS_GARANTIA' => $dados->garantia,
                'IN_PROMOCAO' => $dados->promocao ? 1 : 0,

            ]);
        return $anuncio;
    }

    public static function salvarCheckout($dados)
    {
        
        $array = explode(',', $dados->anunciosId);
        foreach ($array as $item) {
            $anuncio = DB::table('TB_CHECKOUT_PRODUTO')
            ->insertGetId([
                'ID_ANUNCIO_PRODUTO' => $item,
                'ID_COMPRADOR' => $dados->idComprador
            ]);
        }
       
        return $anuncio;
    }

    public static function novoAnuncioWeb($credentials)
    {

        $credentials['codigo'] = Categoria::getId($credentials['codigo']);

        $prrodutoId = Produto::produto($credentials);

        $value[] =  $credentials['usuarioId'];
        $value[] =  $prrodutoId;
        $value[] =   $credentials['nome'];
        $value[] =  $credentials['descricao'];
        $value[] =  $credentials['quatidade'];
        $value[] =  $credentials['quatidadeMinima'];
        $value[] =   $credentials['quatidade'];
        $value[] =   $credentials['preco'];

        $value[] = md5(strval(date("Y-m-d H:i:s")));

        //        $userInfo = DB::select("exec adm_myapp.insertNovoAnuncio ?,?,?,?,?,?,?,?,?", $value);
        //
        //        foreach ($userInfo as $item)
        //             return $item;

        $userInfo = Anuncio::insert([
            'ID_PRODUTOR' => $credentials['usuarioId'],
            'ID_PRODUTO' => $prrodutoId,
            'DS_ANUNCIO_PRODUTO' => $credentials['nome'],
            'DS_DETALHE_PRODUTO' => $credentials['descricao'],
            //            'DS_VIDEO' => $credentials,
            'QT_DISPONIVEL' => $credentials['quatidade'],
            'QT_MINIMA_PEDIDO' => $credentials['quatidadeMinima'],
            'DS_CAPACIDADE_FORNECIMENTO' => $credentials['quatidade'],
            'VL_PRODUTO_UNITARIO' => $credentials['preco'],
            'DS_TOKEN' => md5(strval(date("Y-m-d H:i:s"))),
            'DS_GARANTIA' => $credentials['garantia']
        ]);

        $anuncio = Anuncio::where('ID_PRODUTOR', $credentials['usuarioId'])->orderBy('ID_ANUNCIO_PRODUTO', 'DSC')->first();

        return $anuncio->ID_ANUNCIO_PRODUTO;
    }

    public static function listar()
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'DS_DETALHE_PRODUTO AS descricao',
                'QT_DISPONIVEL AS quantidade',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO as precoUnitario',
                'TB_PRECO_PRODUTO.VL_PRODUTO AS preco',
                'TB_PRECO_PRODUTO.QT_INICIAL AS qtInicial',
                'TB_PRECO_PRODUTO.QT_FINAL AS qtFinal'
            )
            ->get();

        foreach ($listAnuncio as $item) {
            $item->fotos = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();
            $item->fotos = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->fotos['0']->foto;
        }

        return $listAnuncio;
    }

    // public static function getAnuncioById($idAnuncio){

    //     $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
    //         ->join('TB_PRODUTOR','TB_ANUNCIO_PRODUTO.ID_PRODUTOR','TB_PRODUTOR.ID_PRODUTOR')
    //         ->join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
    //         ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
    //         ->select(
    //             'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
    //             'TB_ANUNCIO_PRODUTO.ID_PRODUTOR AS atacadistaId',
    //             'ID_PRODUTO AS produtoId',
    //             'DS_ANUNCIO_PRODUTO AS nome',
    //             'DS_DETALHE_PRODUTO AS descricao',
    //             'QT_DISPONIVEL AS quantidade',
    //             'QT_MINIMA_PEDIDO AS quantidadeMinima',
    //             'VL_DESCONTO AS desconto',
    //             'VL_PRODUTO_UNITARIO as precoUnitario',
    //             'TB_PRODUTOR.DS_NOME_FANTASIA As nomeFantasia',
    //             'TB_PRODUTOR.NR_CNPJ As cnpj',
    //             'TB_PRODUTOR.DS_ENDERECO As endereco',
    //             'TB_PRODUTOR.NR_ENDERECO As nrEndereco',
    //             'TB_PRODUTOR.DS_COMPLEMENTO As complemento',
    //             'TB_PRODUTOR.NR_CEP as cep',
    //             'TB_PRODUTOR.QT_EMPREGADOS As qtEmpregados',
    //             'TB_PRODUTOR.ID_COMPRADOR As idUsuario',
    //             'TB_COMPRADOR.DS_FOTO_COMPRADOR As fotoAtacadista'
    //         )
    //         ->get();

    //     $listAnuncio[0]->precos = DB::table('TB_PRECO_PRODUTO') 
    //             ->join('TB_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
    //             ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
    //             ->select(
    //             'TB_PRECO_PRODUTO.VL_PRODUTO AS preco',
    //             'TB_PRECO_PRODUTO.QT_INICIAL AS qtInicial',
    //             'TB_PRECO_PRODUTO.QT_FINAL AS qtFinal')->get();

    //     $listAnuncio[0]->favorito = DB::table('TB_FAVORITO')
    //         ->where('ID_COMPRADOR', $id_user)
    //         ->where('ID_ANUNCIO_PRODUTO', $id)
    //         ->count();

    //     $listAnuncio[0]->fotos = DB::table('TB_FOTO_PRODUTO')
    //         ->where('ID_ANUNCIO_PRODUTO', $listAnuncio[0]->anuncioId)
    //         ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
    //             'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO')
    //         ->get();
    //     $listAnuncio[0]->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'.$listAnuncio[0]->anuncioId.'/'.$listAnuncio[0]->fotos[0]->foto;
    //     $listAnuncio[0]->fotoAtacadista = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/".$listAnuncio[0]->anuncioId.'/'. $listAnuncio[0]->fotoAtacadista;
    //     foreach($listAnuncio[0]->fotos as $item){
    //         $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/'.$listAnuncio[0]->anuncioId.'/'.$item->foto;
    //     }

    //     $listAnuncio[0]->cores = DB::table('TB_COR_PRODUTO')
    //                         ->join('TB_COR','TB_COR_PRODUTO.ID_COR','TB_COR.ID_COR')
    //                         ->where('TB_COR_PRODUTO.ID_ANUNCIO_PRODUTO',$listAnuncio[0]->anuncioId)
    //                         ->select(
    //                             'TB_COR_PRODUTO.DS_COR as cor')->get();
    //     $listAnuncio[0]->tamanhos = DB::table('TB_TAMANHO_PRODUTO')
    //                             ->join('TB_TAMANHO','TB_TAMANHO_PRODUTO.ID_TAMANHO','TB_TAMANHO.ID_TAMANHO')
    //                             ->where('TB_TAMANHO_PRODUTO.ID_ANUNCIO_PRODUTO', $listAnuncio[0]->anuncioId)
    //                             ->select(
    //                                 'TB_TAMANHO.DS_TAMANHO AS tamanho')->get();



    //     $listAnuncio[0]->comentarios = DB::table('TB_ANUNCIO_COMENTARIO')
    //         ->join('TB_COMPRADOR','TB_ANUNCIO_COMENTARIO.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
    //         ->where('TB_ANUNCIO_COMENTARIO.ID_ANUNCIO_PRODUTO',$id)
    //         ->select(
    //             'TB_ANUNCIO_COMENTARIO.DS_COMENTARIO as comentario'
    //             ,'TB_ANUNCIO_COMENTARIO.VL_AVALIACAO as avaliacao'
    //             ,'TB_COMPRADOR.DS_NOME as nome'
    //             ,'TB_COMPRADOR.DS_FOTO_COMPRADOR as foto'
    //             ,'TB_COMPRADOR.ID_COMPRADOR as compradorId')
    //         ->orderBy('ID_ANUNCIO_PRODUTO','DSC')
    //         ->limit(4)
    //         ->get();
    //     foreach ($listAnuncio[0]->comentarios as $i)
    //         $i->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/' . $i->compradorId . '/' .$i->foto;
    //     return $listAnuncio;
    // }

    public static function recuperarTipoAnuncio()
    {
        $listaTipoAnuncio = DB::table('TB_TIPO_ANUNCIO')->get();
        return $listaTipoAnuncio;
    }

    public static function getAnuncioById($idAnuncio, $idComprador)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncio)
            ->get();
        
            foreach ($listAnuncio as $key => $item) {
                $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                    ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $idAnuncio)
                    ->where('TB_FAVORITO.ID_COMPRADOR', $idComprador)
                    ->get();
                if (count($item->FLAG_FAVORITO) > 0) {
                    $item->FLAG_FAVORITO = 1;
                } else if (count($item->FLAG_FAVORITO) == 0) {
                    $item->FLAG_FAVORITO = 0;
                }
            }
    
            foreach ($listAnuncio as $key => $item) {
                $item->FLAG_CARRINHO = DB::table('TB_CARRINHO_PRODUTO')
                    ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncio)
                    ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idComprador)
                    ->get();
                if (count($item->FLAG_CARRINHO) > 0) {
                    $item->FLAG_CARRINHO = 1;
                } else if (count($item->FLAG_CARRINHO) == 0) {
                    $item->FLAG_CARRINHO = 0;
                }
            }
        
        return $listAnuncio;
    }

    public static function recuperarAnuncios($idProdutor)
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $idProdutor)
            ->get();
        return $listAnuncio;
    }

    public static function validarCupom($dados)
    { 
        $cupom = DB::table('TB_CUPOM')   
            ->where('TB_CUPOM.ID_COMPRADOR', $dados->idComprador)
            ->where('TB_CUPOM.DS_CODIGO', $dados->cupom)
            ->get();
        
            if(isset($cupom) && count($cupom) > 0){
                $date1 = Carbon::parse(Carbon::now());
                $date2 = Carbon::parse($cupom[0]->DT_EXPIRACAO);
                if($date1->gt($date2)){
                    $cupom[0]->CUPOM_VALIDO = false;                
                } else if($date2->gt($date1)){
                    $cupom[0]->CUPOM_VALIDO = true;
                } else if($date1->eq($date2)){
                    $cupom[0]->CUPOM_VALIDO = true;
                }     
            } else {
                $cupom = [];
            }

                         
        return $cupom;
    }

    public static function recuperarCheckout($idComprador)
    {
        $listAnuncio = DB::table('TB_CHECKOUT_PRODUTO')  
        ->join('TB_ANUNCIO_PRODUTO', 'TB_CHECKOUT_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')      
            ->where('TB_CHECKOUT_PRODUTO.ID_COMPRADOR', $idComprador)
            ->get();
        return $listAnuncio;
    }

    public static function recuperarUltimosAnuncios($idComprador, $idAnuncioProduto)
    {
        $date = Carbon::now()->subDays(7); 
        
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_FOTO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.created_at', '>=', $date)
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', '<>', $idAnuncioProduto)
            ->limit(4)
            ->orderBy('TB_ANUNCIO_PRODUTO.created_at','DSC')
            ->get();

            foreach ($listAnuncio as $key => $item) {
                $item->FLAG_FAVORITO = DB::table('TB_FAVORITO')
                    ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                    ->where('TB_FAVORITO.ID_COMPRADOR', $idComprador)
                    ->get();
                if (count($item->FLAG_FAVORITO) > 0) {
                    $item->FLAG_FAVORITO = 1;
                } else if (count($item->FLAG_FAVORITO) == 0) {
                    $item->FLAG_FAVORITO = 0;
                }
            }
    
            foreach ($listAnuncio as $key => $item) {
                $item->FLAG_CARRINHO = DB::table('TB_CARRINHO_PRODUTO')
                    ->where('TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO',  $item->ID_ANUNCIO_PRODUTO)
                    ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idComprador)
                    ->get();
                if (count($item->FLAG_CARRINHO) > 0) {
                    $item->FLAG_CARRINHO = 1;
                } else if (count($item->FLAG_CARRINHO) == 0) {
                    $item->FLAG_CARRINHO = 0;
                }
            }
        return $listAnuncio;
    }

    public static function getCarrinhoUsuario($idComprador)
    {
        
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_CARRINHO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_CARRINHO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idComprador)
            ->get();   
            
            foreach ($listAnuncio as $key => $item) {
                $item->DS_FOTO_PRODUTO = DB::table('TB_FOTO_PRODUTO')
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
                    ->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO',  $item->ID_ANUNCIO_PRODUTO)
                    ->get();                
            }

        return $listAnuncio;
    }

    public static function getNumberCarrinho($idComprador)
    {
        $numberCarrinho = DB::table('TB_CARRINHO_PRODUTO')
        ->where('TB_CARRINHO_PRODUTO.ID_COMPRADOR', $idComprador)
        ->get();
        return count($numberCarrinho);
    }

    public static function getNumberFavorito($idComprador)
    {
        $numberFavorito = DB::table('TB_FAVORITO')
        ->where('TB_FAVORITO.ID_COMPRADOR', $idComprador)
        ->get();
        return count($numberFavorito);
    }

    public static function listarWeb()
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'DS_VIDEO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'VL_DESCONTO',
                'QT_ITEM_PACOTE',
                'VL_PRODUTO_UNITARIO',
                'TB_PRECO_PRODUTO.VL_PRODUTO'
            )
            ->get();

        foreach ($listAnuncio as $item) {
            $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '');
            $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '');

            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->get();
            $item->DS_FOTO_ANUNCIO = 'images\anuncios\\' . $item->ID_ANUNCIO_PRODUTO . '\\' . $item->DS_FOTO_PRODUTO;
        }


        foreach ($listAnuncio as $item) {
            $item->cor =  DB::table('TB_COR_PRODUTO')
                ->join('TB_COR', 'TB_COR_PRODUTO.ID_COR', 'TB_COR.ID_COR')
                ->where('TB_COR_PRODUTO.ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_COR.DS_COR AS cor'
                )->get();
            $item->tamanho = DB::table('TB_TAMANHO_PRODUTO')
                ->join('TB_TAMANHO', 'TB_TAMANHO_PRODUTO.ID_TAMANHO', 'TB_TAMANHO.ID_TAMANHO')
                ->where('TB_TAMANHO_PRODUTO.ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_TAMANHO.DS_TAMANHO AS tamanho'
                )->get();
        }
        return $listAnuncio;
    }

    public static function listarMaisVistos()
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\' . $item->anuncioId . '\\' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }
        return $listAnuncio;
    }

    public static function listarMaisVistosApp()
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, '.', '');
            $item->preco = number_format(($item->preco), 2, '.', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\' . $item->anuncioId . '\\' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }
        return $listAnuncio;
    }

    public static function listarMoreMaisVistos($inicio)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO  AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(4)
                ->get();

            if (count($item->foto) > 0) {

                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\' . $item->anuncioId . '\\' . $item->foto[0]->DS_FOTO_PRODUTO;
            } else {
                $item->foto = null;
            }
        }
        return $listAnuncio;
    }

    public static function listarMoreMaisVistosApp($inicio)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $item) {

            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO as foto'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = '/images/anuncio/' . $item->ID_ANUNCIO_PRODUTO . '\\' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }
        return $listAnuncio;
    }


    public static function listarVistados($id)
    {

        $listAnuncio = DB::table('TB_VISITA_ANUNCIO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_VISITA_ANUNCIO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->where([['TB_VISITA_ANUNCIO.ID_COMPRADOR', '=', $id], ['TB_PRODUTOR.ID_COMPRADOR', '!=', $id]])
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR',
                'ID_PRODUTO',
                'DS_ANUNCIO_PRODUTO as nome',
                'QT_MINIMA_PEDIDO as quantidadeMinima',
                'VL_DESCONTO as desconto',
                'VL_PRODUTO_UNITARIO as preco'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->FOTO_ANUNCIO) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '\\' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            }
        }

        return $listAnuncio;
    }

    public static function listMoreMiasVisitados($inicio, $id)
    {

        $listAnuncio = DB::table('TB_VISITA_ANUNCIO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_VISITA_ANUNCIO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->where([['TB_VISITA_ANUNCIO.ID_COMPRADOR', '=', $id], ['TB_PRODUTOR.ID_COMPRADOR', '!=', $id]])
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'QT_MINIMA_PEDIDO',
                'VL_DESCONTO',
                'VL_PRODUTO_UNITARIO'
            )
            ->orderBy('VL_VISITA', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        if (count($listAnuncio) > 0) {
            foreach ($listAnuncio as $item) {
                $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '');
                $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '');

                $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                    ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                    ->select(
                        'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                        'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                    )
                    ->limit(1)
                    ->get();

                if (count($item->FOTO_ANUNCIO) > 0) {
                    $item->FOTO_ANUNCIO = '/images\anuncios\\' . $item->ID_ANUNCIO_PRODUTO . '\\' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
                } else {
                    $item->FOTO_ANUNCIO = '/images/photo.png';
                }
            }
        }

        return $listAnuncio;
    }    

    public static function meusAnunciosWeb($id)
    {

        $listaUsers = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_PRODUTOR', $id)
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_VIDEO',
                'VL_DESCONTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'VL_PRODUTO_UNITARIO',
                'DS_CAPACIDADE_FORNECIMENTO'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->get();

        foreach ($listaUsers as $item) {
            $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '.');
            $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '.');

            $item->fotos = self::fotoAnuncio($item->ID_ANUNCIO_PRODUTO);

            if (count($item->fotos) > 0) {
                $item->fotos = $item->fotos['0']->DS_FOTO_PRODUTO;
            } else {
                $item->fotos = 'photo.png';
            }
        }
        return $listaUsers;
    }

    public static function promocoesWeb($id)
    {
        $listaUsers = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_PRODUTOR', $id)
            ->where('VL_DESCONTO', '!=', NULL)
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'DS_VIDEO',
                'VL_DESCONTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'VL_PRODUTO_UNITARIO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'TB_PRECO_PRODUTO.VL_PRODUTO'
            )
            ->get();

        foreach ($listaUsers as $item) {

            $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '');
            $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '');
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->FOTO_ANUNCIO) > 0) {
                $item->FOTO_ANUNCIO = '/images/anuncio/' . $item->ID_ANUNCIO_PRODUTO . '\\' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            } else {
                $item->FOTO_ANUNCIO = '/images/photo.png';
            }
        }

        return $listaUsers;
    }

    public static function promocoes($id)
    {

        $listaUsers = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_PRODUTOR.id_user', $id)
            ->where('VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR as idAtacadista',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO as idProduto',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as idAnuncio',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO As titulo',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO as detalhe',
                'TB_ANUNCIO_PRODUTO.VL_DESCONTO as vlDsconto',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO as vlMinimo'
                //'TB_PRECO_PRODUTO.VL_PRODUTO as preco'
            )

            ->get();
        foreach ($listaUsers as $item) {

            $foto =  self::fotoAnuncioApp($item->idAnuncio);

            if (count($foto) <= 0) {
                $item->foto = null;
            } else {
                $item->foto = $foto['0'];
            }
        }

        return $listaUsers;
    }

    public static function addpromocoesWeb($data)
    {

        foreach ($data[0] as $item) {

            if (array_key_exists(1, $item) && array_key_exists(1, $item) && array_key_exists(1, $item)) {

                $items = [];

                if (!empty($item[1])) {
                    $items['QT_INICIAL'] =  $item[1];
                } else {

                    $value =  DB::table('TB_PRECO_PRODUTO')
                        ->where('ID_PRECO_PRODUTO', $item[0])
                        ->select('QT_INICIAL')->get();

                    $items['QT_INICIAL'] = $value[0]->QT_INICIAL;
                }

                if (!empty($item[2])) {

                    $items['QT_FINAL'] = $item[2];
                } else {

                    $value =  DB::table('TB_PRECO_PRODUTO')
                        ->where('ID_PRECO_PRODUTO', $item[0])
                        ->select('QT_FINAL')->get();

                    $items['QT_FINAL'] = $value[0]->QT_FINAL;
                }

                if (!empty($item[3])) {

                    $value =  DB::table('TB_PRECO_PRODUTO')
                        ->where('ID_PRECO_PRODUTO', $item[0])
                        ->select('VL_PRODUTO')->get();

                    $items['VL_DESCONTO_PRODUTO'] = floatval($value[0]->VL_PRODUTO) - $item[3];

                    //$items['VL_DESCONTO_PRODUTO']= $item[3];
                } else {
                    $items['VL_DESCONTO_PRODUTO'] = NULL;
                    // $value =  DB::table('TB_PRECO_PRODUTO')
                    //     ->where('ID_PRECO_PRODUTO',$item[0])
                    //     ->select('VL_PRODUTO')->get();

                    // $items['VL_PRODUTO']= $value[0]->VL_PRODUTO;

                }


                $promocao = DB::table('TB_PRECO_PRODUTO')
                    ->where('ID_PRECO_PRODUTO', $item[0])
                    ->update($items);
            }
        }


        $preco = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $data[2])
            ->select('VL_PRODUTO_UNITARIO')->first();
        if ($data[1] != 0.00) {
            $data[1] = $preco->VL_PRODUTO_UNITARIO - $data[1];
            $promocao = DB::table('TB_ANUNCIO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $data[2])
                ->update(['VL_DESCONTO' => $data[1]]);
        } else {
            $promocao = DB::table('TB_ANUNCIO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $data[2])
                ->update(['VL_DESCONTO' => NULL]);
        }


        return $promocao;
    }

    public static function pararPromocoesWeb($id)
    {

        $promocao = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->update([
                'VL_DESCONTO' => NULL,
            ]);

        return $promocao;
    }

    public static function todasPromocoes()
    {
        $listaUsers = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('VL_DESCONTO', '!=', NULL)
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'DS_VIDEO',
                'VL_DESCONTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'TB_PRECO_PRODUTO.VL_PRODUTO'
            )
            ->orderBy('TB_ANUNCIO_PRODUTO.VL_DESCONTO', 'DESC')
            ->limit(12)
            ->get();

        foreach ($listaUsers as $item) {

            $item->fotos = self::fotoAnuncio($item->ID_ANUNCIO_PRODUTO);
            if (count($item->fotos) > 0) {
                $currentPath = Route::getFacadeRoot()->current()->uri();
                $pattern = '/' . 'api' . '/';

                if (preg_match($pattern, $currentPath)) {

                    $item->fotos = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->ID_ANUNCIO_PRODUTO . '/' . $item->fotos['0']->DS_FOTO_PRODUTO;
                } else {

                    $item->fotos = $item->fotos['0'];
                }
            } else {
                $currentPath = Route::getFacadeRoot()->current()->uri();
                $pattern = '/' . 'api' . '/';

                if (preg_match($pattern, $currentPath)) {
                    $item->FOTO_ANUNCIO = 'http://192.168.1.127:8000/images/anuncio/images/photo.png';
                } else {

                    $item->FOTO_ANUNCIO = '/images/photo.png';
                }
            }
        }
        return $listaUsers;
    }

    public static function todasPromocoesApp()
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            ->orderBy('desconto', 'DSC')
            ->limit(4)
            ->get();
        foreach ($listAnuncio as $item) {
            $item->precoFinal = number_format(($item->preco - $item->desconto), 2, '.', '');

            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }
        return $listAnuncio;
    }

    public static function moreodasPromocoes($inicio)
    {

        $listaUsers = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('VL_DESCONTO', '!=', NULL)
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->select(
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'DS_VIDEO',
                'VL_DESCONTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'VL_PRODUTO_UNITARIO',
                'DS_CAPACIDADE_FORNECIMENTO'
                // 'TB_PRECO_PRODUTO.VL_PRODUTO'
            )
            ->orderBy('TB_ANUNCIO_PRODUTO.VL_DESCONTO', 'DESC')
            ->skip($inicio)
            ->take(12)
            ->limit(12)
            ->get();

        foreach ($listaUsers as $item) {
            $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '');
            $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '');

            $item->fotos = self::fotoAnuncio($item->ID_ANUNCIO_PRODUTO);
            if (count($item->fotos) > 0) {
                $item->fotos = $item->fotos['0'];
            } else {
                $item->FOTO_ANUNCIO = '/images/photo.png';
            }
        }
        return $listaUsers;
    }

    public static function favoritosAdd($id_comprador, $anuncio)
    {
        //adicionar anuncio

        $id =  intval($id_comprador);
        if (DB::table('TB_FAVORITO')->where('ID_COMPRADOR', $id)->where('ID_ANUNCIO_PRODUTO', $anuncio)->count() == 0) {

            DB::table('TB_FAVORITO')->insert(['ID_COMPRADOR' => $id, 'ID_ANUNCIO_PRODUTO' => intval($anuncio)]);
            return 1;
        } else {
            DB::table('TB_FAVORITO')->where('ID_COMPRADOR', $id)->where('ID_ANUNCIO_PRODUTO', $anuncio)->delete();
            return 0;
        }
    }

    public static function historicoAdd($id_comprador, $pedido)
    {

        $historico = DB::table('TB_PEDIDO')->insert(
            [
                'ID_COMPRADOR' => $id_comprador, 'ID_ANUNCIO_PRODUTO' => $pedido->anuncio
            ]
        );

        $historico = DB::table('TB_ITEM_PEDIDO')->insert(
            [
                'ID_PEDIDO' => $historico->ID_PEDIDO, 'QT_PRODUTO' => $pedido->quatidade,
                'ID_TAMANHO' => $pedido->tamanho, 'ID_COR' => $pedido->cor, 'VL_ITEM' => $pedido->valor,
            ]
        );


        return $historico;
    }

    public static function listarFavoritos($comprador)
    {
        $listaUsers = DB::table('TB_FAVORITO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_FAVORITO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_FAVORITO.ID_COMPRADOR', $comprador)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR AS atacadistaId',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO AS produtoId',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO AS nome',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO AS descricao',
                'TB_ANUNCIO_PRODUTO.QT_DISPONIVEL AS quatidade',
                'TB_ANUNCIO_PRODUTO.VL_DESCONTO AS desconto',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO AS quatidadeMinima',
                'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO as valor'
            )
            ->get();

        foreach ($listaUsers as $item) {
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }

        return $listaUsers;
    }

    public static function listarFavoritosWeb($comprador)
    {
        $listaUsers = DB::table('TB_FAVORITO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_FAVORITO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_FAVORITO.ID_COMPRADOR', $comprador)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR AS atacadistaId',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO AS produtoId',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO AS nome',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO AS descricao',
                'TB_ANUNCIO_PRODUTO.DS_VIDEO AS video',
                'TB_ANUNCIO_PRODUTO.QT_DISPONIVEL AS quatidade',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO AS quatidadeMinima',
                'TB_ANUNCIO_PRODUTO.DS_CAPACIDADE_FORNECIMENTO AS capacidade',
                'TB_ANUNCIO_PRODUTO.IN_ADULTO AS adulto',
                'TB_ANUNCIO_PRODUTO.IN_INFANTIL AS infantil',
                'TB_ANUNCIO_PRODUTO.IN_MASCULINO AS masculino',
                'TB_ANUNCIO_PRODUTO.IN_FEMININO AS feminino',
                'TB_ANUNCIO_PRODUTO.VL_DESCONTO AS desconto',
                'TB_ANUNCIO_PRODUTO.VL_ALTURA_PACOTE AS alturaPacote',
                'TB_ANUNCIO_PRODUTO.VL_LARGURA_PACOTE AS larguraPacote',
                'TB_ANUNCIO_PRODUTO.VL_COMPRIMENTO_PACOTE AS comprimentoPacote',
                'TB_ANUNCIO_PRODUTO.QT_ITEM_PACOTE AS ItemPacote',
                'TB_ANUNCIO_PRODUTO.VL_PESO_PACOTE_KG AS peso',
                'TB_ANUNCIO_PRODUTO.DS_PACOTE AS pacote',
                'TB_ANUNCIO_PRODUTO.DS_DETALHES_TRANSPORTE AS detalhe'
            )
            ->get();

        return $listaUsers;
    }

    public static function listarHistorico($comprador)
    {
        $listaUsers = DB::table('TB_FAVORITO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_FAVORITO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_FAVORITO.ID_COMPRADOR', $comprador)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR AS atacadistaId',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTO AS produtoId',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO AS nome',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO AS descricao',
                'TB_ANUNCIO_PRODUTO.DS_VIDEO AS video',
                'TB_ANUNCIO_PRODUTO.QT_DISPONIVEL AS quatidade',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO AS quatidadeMinima',
                'TB_ANUNCIO_PRODUTO.DS_CAPACIDADE_FORNECIMENTO AS capacidade',
                'TB_ANUNCIO_PRODUTO.IN_ADULTO AS adulto',
                'TB_ANUNCIO_PRODUTO.IN_INFANTIL AS infantil',
                'TB_ANUNCIO_PRODUTO.IN_MASCULINO AS masculino',
                'TB_ANUNCIO_PRODUTO.IN_FEMININO AS feminino',
                'TB_ANUNCIO_PRODUTO.VL_DESCONTO AS desconto',
                'TB_ANUNCIO_PRODUTO.VL_ALTURA_PACOTE AS alturaPacote',
                'TB_ANUNCIO_PRODUTO.VL_LARGURA_PACOTE AS larguraPacote',
                'TB_ANUNCIO_PRODUTO.VL_COMPRIMENTO_PACOTE AS comprimentoPacote',
                'TB_ANUNCIO_PRODUTO.QT_ITEM_PACOTE AS ItemPacote',
                'TB_ANUNCIO_PRODUTO.VL_PESO_PACOTE_KG AS peso',
                'TB_ANUNCIO_PRODUTO.DS_PACOTE AS pacote',
                'TB_ANUNCIO_PRODUTO.DS_DETALHES_TRANSPORTE AS detalhe'
            )
            ->get();

        return $listaUsers;
    }

    public static function removeFavorito($id_comprador, $anuncio)
    {
        if (DB::table('TB_FAVORITO')->where('ID_COMPRADOR', $id_comprador)->where('ID_ANUNCIO_PRODUTO', $anuncio)->count() > 0) {

            $anuncio = DB::table('TB_FAVORITO')
                ->where('TB_FAVORITO.ID_COMPRADOR', $id_comprador)
                ->where('TB_FAVORITO.ID_ANUNCIO_PRODUTO', $anuncio)
                ->delete();
            $anuncio = 1;
        } else {
            $anuncio = 2;
        }
        return $anuncio;
    }

    public static function infoGeralWeb($id)
    {

        $info = [
            'preco' => $preco = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_PRECO_PRODUTO.VL_PRODUTO',
                    'TB_PRECO_PRODUTO.QT_INICIAL',
                    'TB_PRECO_PRODUTO.QT_FINAL'
                )
                ->get(),


            'cor' => $cor = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_COR_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_COR_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->join('TB_COR', 'TB_COR_PRODUTO.ID_COR', 'TB_COR.ID_COR')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_COR.DS_COR',
                    'TB_COR.DS_ICONE_COR'
                )
                ->get(),

            'tamanho' => $tamanho = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_TAMANHO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_TAMANHO_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->join('TB_TAMANHO', 'TB_TAMANHO_PRODUTO.ID_TAMANHO', 'TB_TAMANHO.ID_TAMANHO')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_TAMANHO.DS_TAMANHO'
                )
                ->get()
        ];
        return $info;
    }
    public static function infoGeral($id)
    {

        $info = [
            'preco' => $preco = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_PRECO_PRODUTO.VL_PRODUTO AS valorPreco',
                    'TB_PRECO_PRODUTO.QT_INICIAL AS qtInicial',
                    'TB_PRECO_PRODUTO.QT_FINAL AS qtFinal'
                )
                ->get(),


            'cor' => $cor = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_COR_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_COR_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->join('TB_COR', 'TB_COR_PRODUTO.ID_COR', 'TB_COR.ID_COR')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_COR.DS_COR AS cor',
                    'TB_COR.DS_ICONE_COR AS fotoCor'
                )
                ->get(),

            'tamanho' => $tamanho = DB::table('TB_PRODUTOR')
                ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
                ->join('TB_TAMANHO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_TAMANHO_PRODUTO.ID_ANUNCIO_PRODUTO')
                ->join('TB_TAMANHO', 'TB_TAMANHO_PRODUTO.ID_TAMANHO', 'TB_TAMANHO.ID_TAMANHO')
                ->where('TB_ANUNCIO_PRODUTO.ID_PRODUTOR', $id)
                ->select(
                    'TB_TAMANHO.DS_TAMANHO AS tamanho'
                )
                ->get()
        ];

        return $info;
    }

    public static function infoProvedor($id)
    {

        $info = DB::table('TB_PRODUTOR')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
            ->join('cepbr_cidade', 'TB_PRODUTOR.ID_CIDADE', 'cepbr_cidade.id_cidade')
            // ->join('TB_CONTATO', 'TB_PRODUTOR.ID_PRODUTOR','TB_CONTATO.ID_PRODUTOR')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_PRODUTOR.DS_NOME_FANTASIA AS nomeFantasia',
                'TB_PRODUTOR.DS_RAZAO_SOCIAL AS razaoSocial',
                'TB_PRODUTOR.ID_PRODUTOR AS atacadistaId',
                'TB_PRODUTOR.NR_CNPJ AS cnpj',
                'TB_PRODUTOR.ID_COMPRADOR AS compradorId',
                'TB_PRODUTOR.DS_ENDERECO AS endereco',
                'TB_PRODUTOR.NR_ENDERECO AS numendereco',
                'TB_PRODUTOR.NR_CEP AS cep',
                'cepbr_cidade.cidade AS cidade',
                'cepbr_cidade.uf AS estado',
                'TB_PRODUTOR.DS_VIDEO_PROMOCIONAL AS video',
                'TB_PRODUTOR.DS_TAMANHO_FABRICA AS fabrica',
                'TB_PRODUTOR.QT_EMPREGADOS AS qtEmpregados'
            )
            ->first();

        $info->contatos = DB::table('TB_CONTATO')
            ->join('TB_PRODUTOR', 'TB_CONTATO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->join('TB_COMPRADOR', 'TB_PRODUTOR.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->select(
                'TB_CONTATO.DS_NOME as nomeContato',
                'TB_CONTATO.DS_SOBRENOME as sobrenomeContato',
                'TB_CONTATO.DS_CARGO as cargo',
                'TB_CONTATO.NR_DDD_TELEFONE as dddContato',
                'TB_CONTATO.NR_TELEFONE as telContato',
                'TB_CONTATO.NR_WHATSAP as whatsassp',
                'DS_GMAIL AS gmail',
                'DS_FACEBOOK AS facebook',
                'DS_INSTAGRAM AS instagram',
                'TB_CONTATO.DS_EMAIL as emailContato'
            )
            ->where('TB_CONTATO.ID_PRODUTOR', $info->atacadistaId)->get();

        $info->fotos = DB::table('TB_FOTO_PRODUTOR')
            ->where('TB_FOTO_PRODUTOR.ID_PRODUTOR', $info->atacadistaId)
            ->select('TB_FOTO_PRODUTOR.DS_FOTO_PRODUTOR')->get();

        $info->redesSociais = [];

        foreach ($info->contatos as  $key => $item) {

            if ($item->gmail != null) {
                $info->redesSociais[$key] = ['gmail' => $item->gmail];
                //array_push($info->redesSociais,$item->gmail);

            }
            unset($item->gmail);
            if ($item->facebook != null) {
                $info->redesSociais[$key] = ['facebook' => $item->facebook];
                //   array_push($info->redesSociais,$item->facebook);

            }
            unset($item->facebook);
            if ($item->instagram != null) {
                $info->redesSociais[$key] = ['instagram' => $item->instagram];
                //   array_push($info->redesSociais,$item->instagram);

            }
            unset($item->instagram);
        }

        if (count($info->fotos) > 0) {

            foreach ($info->fotos as  $key => $item) {

                $item->fotoEmp = 'https://testetendering.myappnow.com.br/clubeatacado/images/empresas/' . $info->compradorId . '/' . $item->DS_FOTO_PRODUTOR;
                unset($item->DS_FOTO_PRODUTOR);
            }
        } else {
            $info->fotos = [['fotoEmp' => 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png']];
        }

        if ($info->video !== null) {
            $info->video = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $id . '/' . $info->video;
        } else {
            $info->video = null;
        }

        return $info;
    }
    public static function infoProvedorWeb($id)
    {
        $info = DB::table('TB_PRODUTOR')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PRODUTOR.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
            ->join('users', 'TB_PRODUTOR.id_user', 'users.id')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_PRODUTOR.DS_NOME_FANTASIA',
                'TB_PRODUTOR.NR_CNPJ',
                'TB_PRODUTOR.DS_ENDERECO',
                'TB_PRODUTOR.NR_ENDERECO',
                'TB_PRODUTOR.NR_CEP'
            )
            ->get();

        return $info;
    }

    public static function espTecnica($id)
    {

        $certificacao = DB::table('TB_CERTIFICACAO')
            //->join('TB_ANUNCIO_PRODUTO', 'TB_CERTIFICACAO.ID_PRODUTOR','TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
            ->where('TB_CERTIFICACAO.ID_ANUNCIO_PRODUTO', $id)
            ->select(

                'TB_CERTIFICACAO.DS_CERTIFICACAO AS cetificado',
                'TB_CERTIFICACAO.DS_DETALHE_CERTIFICACAO AS detalheCertificado',
                'TB_CERTIFICACAO.DS_FOTO_CERTIFICACAO AS fotoCertificado'
            )
            ->get();

        if (count($certificacao) < 1) {
            $certificacao = [['fotoCertificado' => 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png']];
        } else {
            foreach ($certificacao as $item) {
                if ($item->fotoCertificado !== null) {
                    $item->fotoCertificado = 'https://testetendering.myappnow.com.br/clubeatacado/images/certificados/' . $id . '/' . $item->fotoCertificado;
                } else {
                    $item->fotoCertificado = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
                }
            }
        }


        return $certificacao;
    }
    public static function espTecnicaWeb($id)
    {
        $certificacao = DB::table('TB_CERTIFICACAO')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_CERTIFICACAO.ID_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_CERTIFICACAO.DS_CERTIFICACAO',
                'TB_CERTIFICACAO.DS_DETALHE_CERTIFICACAO',
                'TB_CERTIFICACAO.DS_FOTO_CERTIFICACAO'
            )
            ->get();

        return $certificacao;
    }

    public static function desconto($AnuncioId, $vlr)
    {

        $update = DB::table('TB_PRECO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $AnuncioId)
            ->update(['VL_PRODUTO' => $vlr]);

        if ($update == 1) {

            return $update;
        } else {
            return 'update erro';
        }
    }
    public static function infoAnuncio($id)
    {
        $anuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_PRODUTOR', 'TB_ANUNCIO_PRODUTO.ID_PRODUTOR', 'TB_PRODUTOR.ID_PRODUTOR')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO',
                'TB_ANUNCIO_PRODUTO.QT_DISPONIVEL',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO',
                'TB_ANUNCIO_PRODUTO.DS_CAPACIDADE_FORNECIMENTO',
                'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO',
                'TB_ANUNCIO_PRODUTO.DS_GARANTIA',
                'TB_PRODUTOR.ID_COMPRADOR'
                //,'TB_PRODUTOR.ID_COMPRADOR'
                ,
                'TB_PRODUTO.DS_PRODUTO'
                //   ,'TB_PRECO_PRODUTO.VL_PRODUTO'
                ,
                'TB_PRODUTO.DS_PRODUTO',
                'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO',
                'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO'
            )
            ->groupBy(
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_PRODUTOR',
                'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO',
                'TB_ANUNCIO_PRODUTO.QT_DISPONIVEL',
                'TB_ANUNCIO_PRODUTO.QT_MINIMA_PEDIDO',
                'TB_ANUNCIO_PRODUTO.DS_CAPACIDADE_FORNECIMENTO',
                'TB_ANUNCIO_PRODUTO.VL_PRODUTO_UNITARIO',
                'TB_ANUNCIO_PRODUTO.DS_GARANTIA',
                'TB_PRODUTOR.ID_COMPRADOR',
                'TB_PRODUTO.DS_PRODUTO'
                //   ,'TB_PRECO_PRODUTO.VL_PRODUTO'
                //   ,'TB_PRECO_PRODUTO.QT_INICIAL'
                //   ,'TB_PRECO_PRODUTO.QT_FINAL'
                ,
                'TB_CATEGORIA_PRODUTO.DS_CATEGORIA_PRODUTO',
                'TB_TIPO_PRODUTO.DS_TIPO_PRODUTO'
            )
            ->get();
        $anuncio['0']->VL_PRODUTO_UNITARIO = number_format(($anuncio['0']->VL_PRODUTO_UNITARIO), 2, ',', '');
        $anuncio['0']->urlsearch = 'https://testetendering.myappnow.com.br/clubeatacado/anuncio/searchproduto/' . Crypt::encrypt($id);

        if (key_exists('email', session()->all())) {
            $data =  Favorito::getData($id, session()->all()['id']);
            if (count($data) <= 0) {
                $anuncio['0']->favorito = null;
            } else {
                $anuncio['0']->favorito = 1;
            }
        } else {
            $anuncio['0']->favorito = null;
        }

        $foto = DB::table('TB_FOTO_PRODUTO')
            ->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')->get();

        $review = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR', 'TB_AVALIACAO_PRODUTO.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                DB::raw('SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao'),
                DB::raw('COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao')
            )->get();


        $cor = DB::table('TB_COR_PRODUTO')
            ->where('TB_COR_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select('TB_COR_PRODUTO.DS_COR')->get();

        $tamanho = DB::table('TB_TAMANHO_PRODUTO')
            ->where('TB_TAMANHO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_TAMANHO_PRODUTO.DS_TAMANHO',
                'TB_TAMANHO_PRODUTO.DS_METRAGEM'
            )->get();

        $comentarios = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR', 'TB_AVALIACAO_PRODUTO.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_AVALIACAO_PRODUTO.VL_AVALIACAO',
                'TB_COMPRADOR.DS_NOME',
                'TB_COMPRADOR.DS_FOTO_COMPRADOR',
                'TB_COMPRADOR.ID_COMPRADOR',
                'TB_AVALIACAO_PRODUTO.DS_AVALIACAO'
            )
            ->orderBy('TB_AVALIACAO_PRODUTO.DT_AVALIACAO', 'DSC')
            ->limit(5)
            ->get();

        foreach ($comentarios as $item) {
            $item->VL_AVALIACAO = intval($item->VL_AVALIACAO);
        }


        $precos = DB::table('TB_PRECO_PRODUTO')
            ->where('TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'VL_PRODUTO',
                'QT_INICIAL',
                'QT_FINAL',
                'VL_DESCONTO_PRODUTO'
            )->get();
        foreach ($precos as $item) {
            $item->VL_DESCONTO_PRODUTO = number_format(($item->VL_PRODUTO - $item->VL_DESCONTO_PRODUTO), 2, ',', '');
            $item->VL_PRODUTO = number_format(($item->VL_PRODUTO), 2, ',', '');
        }

        $anuncioinfo[] = [
            "anuncio" => $anuncio[0],
            "cor" =>  $cor,
            "foto" => $foto,
            "tamanho" => $tamanho,
            "review" => $review,
            "precos" => $precos,
            "comentarios" => $comentarios
        ];

        return $anuncioinfo;
    }
    public static function MoreComents($skip, $id)
    {
        $comentarios = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR', 'TB_AVALIACAO_PRODUTO.ID_COMPRADOR', 'TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'TB_AVALIACAO_PRODUTO.VL_AVALIACAO',
                'TB_COMPRADOR.DS_NOME',
                'TB_COMPRADOR.DS_FOTO_COMPRADOR',
                'TB_COMPRADOR.ID_COMPRADOR',
                'TB_AVALIACAO_PRODUTO.DS_AVALIACAO'
            )
            ->orderBy('TB_AVALIACAO_PRODUTO.DT_AVALIACAO', 'DSC')
            ->skip($skip)
            ->limit(5)
            ->get();

        foreach ($comentarios as $item) {
            $item->VL_AVALIACAO = intval($item->VL_AVALIACAO);
        }

        return $comentarios;
    }

    public static function fotoAnuncio($id)
    {

        $fotos =  DB::table('TB_FOTO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'DS_FOTO_PRODUTO'
            )
            ->limit(1)
            ->get();
        return $fotos;
    }
    public static function fotoAnuncioApp($id)
    {
        $fotos =  DB::table('TB_FOTO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'DS_FOTO_PRODUTO as foto'
            )
            ->limit(1)
            ->get();
        return $fotos;
    }

    public static function listaPromocoes()
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->join('TB_PRECO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as idAnuncio',
                'ID_PRODUTOR as IdAtacadista',
                'ID_PRODUTO as idProduto',
                'DS_ANUNCIO_PRODUTO as titulo',
                'DS_DETALHE_PRODUTO as descricao',
                'VL_DESCONTO as vlDesconto',
                'TB_PRECO_PRODUTO.VL_PRODUTO as vlProduto'
            )
            ->orderBy('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'DSC')
            ->limit(7)
            ->get();

        foreach ($listAnuncio as $key => $item) {
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();
            $item->FOTO_ANUNCIO = "http://192.168.1.125:8000\images\\" . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
        }

        return $listAnuncio;
    }

    public static function listaPromocoesWeb()
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'ID_PRODUTOR',
                'ID_PRODUTO  AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'DS_DETALHE_PRODUTO ',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->orderBy('TB_ANUNCIO_PRODUTO.DT_ANUNCIO_PRODUTO', 'DSC')
            ->limit(7)
            ->get();

        foreach ($listAnuncio as $key => $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
                ->limit(1)
                ->get();
            if (count($item->FOTO_ANUNCIO) > 0) {

                $item->foto =   'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            } else {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
            }
        }

        return $listAnuncio;
    }

    public static function anuncioTipo($id)
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->where('TB_TIPO_PRODUTO.DS_TIPO_PRODUTO', $id)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'DS_VIDEO',
                'QT_DISPONIVEL',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'VL_DESCONTO',
                'QT_ITEM_PACOTE',
                'VL_PRODUTO_UNITARIO',
                // 'TB_PRECO_PRODUTO.VL_PRODUTO',
                'TB_PRODUTO.ID_CATEGORIA_PRODUTO'
            )
            ->limit(12)
            ->orderBy('VL_PRODUTO_UNITARIO', 'DSC')
            ->get();

        foreach ($listAnuncio as $item) {
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->FOTO_ANUNCIO) > 0) {

                $item->FOTO_ANUNCIO =  'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->ID_ANUNCIO_PRODUTO . '/' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            } else {
                $item->FOTO_ANUNCIO = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
            }

            $item->CORES = DB::table('TB_COR_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select('DS_COR')
                ->get();
        }

        return $listAnuncio;
    }
    public static function anuncioTipomoreList($id, $inicio)
    {
        $inicio = intval($inicio);
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_PRODUTO', 'TB_PRODUTO.ID_PRODUTO')
            ->join('TB_CATEGORIA_PRODUTO', 'TB_PRODUTO.ID_CATEGORIA_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_CATEGORIA_PRODUTO')
            ->join('TB_TIPO_PRODUTO', 'TB_CATEGORIA_PRODUTO.ID_TIPO_PRODUTO', 'TB_TIPO_PRODUTO.ID_TIPO_PRODUTO')
            ->where('TB_TIPO_PRODUTO.DS_TIPO_PRODUTO', $id)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'VL_DESCONTO',
                'QT_ITEM_PACOTE',
                'VL_PRODUTO_UNITARIO',
                // 'TB_PRECO_PRODUTO.VL_PRODUTO',
                'TB_PRODUTO.ID_CATEGORIA_PRODUTO'

            )
            ->groupby(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'VL_DESCONTO',
                'QT_ITEM_PACOTE',
                'TB_PRODUTO.ID_CATEGORIA_PRODUTO'
            )
            ->orderBy('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'DSC')
            ->skip($inicio)
            ->take(8)
            ->get();

        foreach ($listAnuncio as $item) {
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();
            $item->CORES = DB::table('TB_COR_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select('DS_COR')
                ->get();
        }

        return $listAnuncio;
    }

    public static function precoProduto($id)
    {

        $produto = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select(
                'ID_PRODUTOR',
                'ID_ANUNCIO_PRODUTO',
                'ID_PRODUTO',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'VL_DESCONTO',
                'VL_PRODUTO_UNITARIO'
            )
            ->get();
        $produto[0]->VL_DESCONTO = number_format(($produto[0]->VL_PRODUTO_UNITARIO - $produto[0]->VL_DESCONTO), 2, ',', '');
        $produto[0]->VL_PRODUTO_UNITARIO = number_format(($produto[0]->VL_PRODUTO_UNITARIO), 2, ',', '');

        $produto[0]->review = DB::table('TB_AVALIACAO_PRODUTO')
            ->where('TB_AVALIACAO_PRODUTO.ID_ANUNCIO_PRODUTO', $produto[0]->ID_ANUNCIO_PRODUTO)
            ->select(
                DB::raw('SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao'),
                DB::raw('COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao')
            )->get();


        foreach ($produto as $item) {
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            $item->preco =  DB::table('TB_PRECO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select(
                    'VL_PRODUTO',
                    'ID_PRECO_PRODUTO',
                    'QT_INICIAL',
                    'QT_FINAL',
                    'VL_DESCONTO_PRODUTO'
                )
                ->get();

            foreach ($item->preco as $i) {
                $i->VL_DESCONTO_PRODUTO = number_format(($i->VL_PRODUTO - $i->VL_DESCONTO_PRODUTO), 2, ',', '');
                $i->VL_PRODUTO = number_format(($i->VL_PRODUTO), 2, ',', '');
            }
        }
        return $produto;
    }

    public static function anuncioById($item)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $item['anuncioId'])
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'VL_DESCONTO',
                'VL_PRODUTO_UNITARIO',
                'QT_MINIMA_PEDIDO',
                'QT_DISPONIVEL'
            )
            ->get();
        if (key_exists('email', session()->all())) {
            $data =  Favorito::getData($item['anuncioId'], session()->all()['id']);
            if (count($data) <= 0) {
                $listAnuncio['0']->fav = null;
            } else {
                $listAnuncio['0']->fav = 1;
            }
        } else {
            $listAnuncio['0']->fav = null;
        }
        $listAnuncio['0']->urlsearch = 'https://testetendering.myappnow.com.br/clubeatacado/anuncio/searchproduto/' . Crypt::encrypt($item['anuncioId']);

        $listAnuncio['0']->precos = DB::table('TB_PRECO_PRODUTO')
            ->where('TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO', $item['anuncioId'])
            ->select(
                'VL_PRODUTO',
                'QT_INICIAL',
                'QT_FINAL'
            )->get();

        $listAnuncio['0']->cor = $item['color'];
        $listAnuncio['0']->quantidade = $item['size'];
        $listAnuncio['0']->photo = $item['photo'];
        $listAnuncio['0']->price = floatval($item['price']);
        $listAnuncio['0']->tamanho = $item['tamanho'];

        return $listAnuncio;
    }

    public static function anuncioBuscado($produto)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            // ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('DS_ANUNCIO_PRODUTO', 'like', '%' . $produto . '%')
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
                'ID_PRODUTOR',
                'ID_PRODUTO',
                'DS_ANUNCIO_PRODUTO',
                'DS_DETALHE_PRODUTO',
                'QT_DISPONIVEL',
                'QT_MINIMA_PEDIDO',
                'DS_CAPACIDADE_FORNECIMENTO',
                'VL_DESCONTO',
                'QT_ITEM_PACOTE',
                'VL_PRODUTO_UNITARIO'
            )
            //   'TB_PRECO_PRODUTO.VL_PRODUTO')
            ->limit(8)
            ->get();

        if (count($listAnuncio) < 1) {
            return 0;
        } else {
            foreach ($listAnuncio as $item) {
                $item->VL_DESCONTO = number_format(($item->VL_PRODUTO_UNITARIO - $item->VL_DESCONTO), 2, ',', '');
                $item->VL_PRODUTO_UNITARIO = number_format(($item->VL_PRODUTO_UNITARIO), 2, ',', '');

                $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                    ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                    ->select(
                        'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                        'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                    )
                    ->limit(1)
                    ->get();
                if (count($item->FOTO_ANUNCIO) > 0) {
                    $item->DS_FOTO_ANUNCIO = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\' . $item->ID_ANUNCIO_PRODUTO . '\\' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
                } else {
                    $item->DS_FOTO_ANUNCIO = '/images/photo.png';
                }
            }
        }
        return $listAnuncio;
    }

    public static function addvisita($id)
    {


        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->select('VL_VISITA')
            ->get();


        $promocao = DB::table('TB_ANUNCIO_PRODUTO')
            ->where('ID_ANUNCIO_PRODUTO', $id)
            ->update(['VL_VISITA' => intval($listAnuncio[0]->VL_VISITA) + 1]);
    }

    public static function listMoreAnuncio($inicio)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //   ->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO AS anuncioId',
                'ID_PRODUTOR AS atacadistaId',
                'ID_PRODUTO AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS quantidadeMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->orderBy('TB_ANUNCIO_PRODUTO.DT_ANUNCIO_PRODUTO', 'DSC')
            ->skip($inicio)
            ->take(6)
            ->limit(7)
            ->get();

        foreach ($listAnuncio as $key => $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select(
                    'TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO'
                )
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images\anuncio\\' . $item->anuncioId . '\\' . $item->foto[0]->foto;
            } else {
                $item->foto = null;
            }
        }

        return $listAnuncio;
    }

    public static function Pedidos($id)
    {

        $listAnuncio = DB::table('TB_ITEM_PEDIDO')
            ->join('TB_PEDIDO', 'TB_ITEM_PEDIDO.ID_PEDIDO', 'TB_PEDIDO.ID_PEDIDO')
            ->join('TB_COR', 'TB_ITEM_PEDIDO.ID_COR', 'TB_COR.ID_COR')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PEDIDO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_TAMANHO', 'TB_ITEM_PEDIDO.ID_TAMANHO', 'TB_TAMANHO.ID_TAMANHO')
            ->where('TB_PEDIDO.ID_COMPRADOR', $id)
            ->select(
                'TB_ITEM_PEDIDO.ID_PEDIDO as idPedido',
                'TB_ITEM_PEDIDO.QT_PRODUTO as qtProduto',
                'TB_ITEM_PEDIDO.VL_ITEM as valor',
                'TB_COR.DS_COR as cor',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO as titulo',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as idAnuncio',
                'TB_TAMANHO.DS_TAMANHO as tamanho'
            )
            ->get();

        if (count($listAnuncio) > 0) {
            foreach ($listAnuncio as $item) {
                $fotos = DB::table('TB_FOTO_PRODUTO')
                    ->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO', $item->idAnuncio)
                    ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto')->first();

                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->idAnuncio . '/' . $fotos->foto;
            }
        }
        return $listAnuncio;
    }
    public static function PedidosDetalhe($id, $comprador)
    {

        $listAnuncio = DB::table('TB_ITEM_PEDIDO')
            ->join('TB_PEDIDO', 'TB_ITEM_PEDIDO.ID_PEDIDO', 'TB_PEDIDO.ID_PEDIDO')
            ->join('TB_COR', 'TB_ITEM_PEDIDO.ID_COR', 'TB_COR.ID_COR')
            ->join('TB_ANUNCIO_PRODUTO', 'TB_PEDIDO.ID_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->join('TB_TAMANHO', 'TB_ITEM_PEDIDO.ID_TAMANHO', 'TB_TAMANHO.ID_TAMANHO')
            ->where('TB_PEDIDO.ID_ANUNCIO_PRODUTO', $id)
            ->where('TB_PEDIDO.ID_COMPRADOR', $comprador)
            ->select(
                'TB_ITEM_PEDIDO.ID_PEDIDO as idPedido',
                'TB_ITEM_PEDIDO.QT_PRODUTO as qtProduto',
                'TB_ITEM_PEDIDO.VL_ITEM as valor',
                'TB_COR.DS_COR as cor',
                'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO as titulo',
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as idAnuncio',
                'TB_TAMANHO.DS_TAMANHO as tamanho',
                'TB_ITEM_PEDIDO.VL_CUPOM as cupom',
                'TB_ITEM_PEDIDO.VL_ENVIO as envio'
            )
            ->first();


        $listAnuncio->fotos = DB::table('TB_FOTO_PRODUTO')
            ->where('TB_FOTO_PRODUTO.ID_ANUNCIO_PRODUTO', $listAnuncio->idAnuncio)
            ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO as foto')->get();
        foreach ($listAnuncio->fotos as $i)
            $i->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $listAnuncio->idAnuncio . '/' . $i->foto;

        return $listAnuncio;
    }

    public static function Destaques()
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'ID_PRODUTO  AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS qtMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->orderBy('VL_VISITA', 'DSC')
            ->limit(8)
            ->get();
        foreach ($listAnuncio as $key => $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {

                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->foto[0]->DS_FOTO_PRODUTO;
            } else {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
            }
        }

        return $listAnuncio;
    }

    public static function DestaquesApp()
    {
        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'ID_PRODUTO  AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'QT_MINIMA_PEDIDO AS qtMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->orderBy('VL_VISITA', 'DSC')
            ->limit(8)
            ->get();
        foreach ($listAnuncio as $key => $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, '.', '');
            $item->preco = number_format(($item->preco), 2, '.', '');
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
                ->limit(1)
                ->get();

            if (count($item->foto) > 0) {

                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->foto[0]->DS_FOTO_PRODUTO;
            } else {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
            }
        }

        return $listAnuncio;
    }

    public static function destaquesMore($inicio)
    {

        $listAnuncio = DB::table('TB_ANUNCIO_PRODUTO')
            //->join('TB_PRECO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRECO_PRODUTO.ID_ANUNCIO_PRODUTO')
            ->where('TB_ANUNCIO_PRODUTO.VL_DESCONTO', '!=', NULL)
            ->select(
                'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO as anuncioId',
                'ID_PRODUTOR',
                'ID_PRODUTO  AS produtoId',
                'DS_ANUNCIO_PRODUTO AS nome',
                'DS_DETALHE_PRODUTO ',
                'QT_MINIMA_PEDIDO AS qtMinima',
                'VL_DESCONTO AS desconto',
                'VL_PRODUTO_UNITARIO AS preco'
            )
            //'TB_PRECO_PRODUTO.VL_PRODUTO'
            ->orderBy('VL_VISITA', 'DSC')
            ->skip($inicio)
            ->take(4)
            ->limit(4)
            ->get();

        foreach ($listAnuncio as $key => $item) {
            $item->desconto = number_format(($item->preco - $item->desconto), 2, ',', '');
            $item->preco = number_format(($item->preco), 2, ',', '');
            $item->FOTO_ANUNCIO = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->anuncioId)
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO')
                ->limit(1)
                ->get();

            if (count($item->FOTO_ANUNCIO) > 0) {

                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/anuncio/' . $item->anuncioId . '/' . $item->FOTO_ANUNCIO[0]->DS_FOTO_PRODUTO;
            } else {
                $item->foto = 'https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';
            }
        }

        return $listAnuncio;
    }

    public static function deleteById($id)
    {
        //delete Tamanho
        if (Tamanho::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Tamanho::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //delete cor
        if (Cor::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Cor::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //delete preco
        if (Preco::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Preco::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //delete fotos
        if (FotoAnuncio::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                FotoAnuncio::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //delete fotos Certificado
        if (Certificado::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Certificado::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //visita
        if (Visita::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Visita::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }
        //delete anuncio
        if (Anuncio::where('ID_ANUNCIO_PRODUTO', $id)->count() > 0) {
            try {
                Anuncio::where('ID_ANUNCIO_PRODUTO', $id)->delete();
            } catch (\Exception $e) {
            }
        }

        return 1;
    }
}
