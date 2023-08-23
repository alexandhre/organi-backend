<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leilao extends Model
{
    protected $table = 'TB_LEILAO';

    protected $fillable=[
        'ID_LEILAO',
        'ID_LEILAO_PRODUTO',
        'ID_USUARIO',
        'DS_LOJA',
        'DS_VENDEDOR',
        'DS_IDENTIFICACAO',
        'DS_INFORMACOES',
        'DS_CONDICOES_GERAIS',
        'DS_ACESSORIOS',
        'DT_INICIO',
        'DT_FIM'
    ];

    public static function Leilao(){}

    public static function recuperarLeiloes()
    {
        $leiloes = DB::table('TB_LEILAO')          
        ->leftJoin('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->leftJoin('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->select(
            'TB_PRODUTO_LEILAO.*',
            'TB_LEILAO.*',
            'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO')
        ->get();               
        return $leiloes;
    }

    public static function recuperarLeiloesSemIdLeilao($idLeilao)
    {
        $leiloes = DB::table('TB_LEILAO')          
        ->leftJoin('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->leftJoin('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->where('TB_LEILAO.ID_LEILAO', '<>', $idLeilao)
        ->select(
            'TB_PRODUTO_LEILAO.*',
            'TB_LEILAO.*',
            'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO',
            'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
        ->get();  

        foreach ($leiloes as $key => $item){
            $item->foto = DB::table('TB_FOTO_PRODUTO')
                ->where('ID_ANUNCIO_PRODUTO', $item->ID_ANUNCIO_PRODUTO)
                ->select('TB_FOTO_PRODUTO.DS_FOTO_PRODUTO',
                    'TB_FOTO_PRODUTO.ID_FOTO_PRODUTO')
                ->limit(1)
                ->get();
            
            if(count($item->foto) > 0){
                $item->DS_FOTO_PRODUTO = "http://testetendering.myappnow.com.br/clubeatacado/images/anuncios/". $item->ID_ANUNCIO_PRODUTO . "/" . $item->foto[0]->DS_FOTO_PRODUTO;
            } 
            
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
        return $leiloes;
    }    

    public static function recuperarLeiloesUsuarioFavoritos($idUsuario)
    {       
        $leiloes = DB::table('TB_LEILAO')   
        ->select('TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_LEILAO.DT_INICIO', 'TB_LEILAO.DT_FIM', 'TB_LEILAO.ID_LEILAO')     
        ->join('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->join('TB_LEILAO_COMPRADOR','TB_LEILAO_COMPRADOR.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->join('TB_FAVORITO_LEILAO','TB_FAVORITO_LEILAO.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->join('TB_LANCE','TB_LANCE.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->where('TB_LANCE.ID_COMPRADOR', $idUsuario);      
        $leiloesPage = $leiloes->paginate(9);
        $leiloes = $leiloes->get();   
        
        foreach ($leiloes as $key => $item){
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
            'leiloes' => $leiloes,
            'leiloesPage' => $leiloesPage
        ];

        return $response;
    }

    public static function recuperarLeiloesUsuario($idUsuario)
    {       
        $leiloes = DB::table('TB_LEILAO') 
        ->select('TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_LEILAO.DT_INICIO', 'TB_LEILAO.DT_FIM', 'TB_LEILAO.ID_LEILAO')         
        ->join('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->join('TB_LEILAO_COMPRADOR','TB_LEILAO_COMPRADOR.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->where('TB_LEILAO_COMPRADOR.ID_COMPRADOR', $idUsuario);
        $leiloesPage = $leiloes->paginate(9);
        $leiloes = $leiloes->get();         
        
        foreach ($leiloes as $key => $item){
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
            'leiloes' => $leiloes,
            'leiloesPage' => $leiloesPage
        ];

        return $response;
    }

    public static function recuperarLeiloesFavoritosUsuario($idUsuario)
    {       
        $leiloes = DB::table('TB_LEILAO')          
        ->join('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->join('TB_LEILAO_COMPRADOR','TB_LEILAO_COMPRADOR.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->join('TB_FAVORITO','TB_FAVORITO.ID_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO')
        ->where('TB_FAVORITO.ID_COMPRADOR', $idUsuario)       
        ->get();   
        
        foreach ($leiloes as $key => $item){
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
                 
        return $leiloes;
    }

    public static function recuperarLeiloesByUsuario($idUsuario)
    {       
        $leiloes = DB::table('TB_LEILAO')   
        ->select('TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO', 'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', 'TB_LEILAO.DT_INICIO', 'TB_LEILAO.DT_FIM', 'TB_LEILAO.ID_LEILAO')       
        ->join('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
        ->join('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->join('TB_LEILAO_COMPRADOR','TB_LEILAO_COMPRADOR.ID_LEILAO','TB_LEILAO.ID_LEILAO')
        ->where('TB_LEILAO.ID_USUARIO', $idUsuario);      
        $leiloesPage = $leiloes->paginate(9);
        $leiloes = $leiloes->get();  
        
        foreach ($leiloes as $key => $item){
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
            'leiloes' => $leiloes,
            'leiloesPage' => $leiloesPage
        ];

        return $response;
    }

    public static function recuperarDetalheLeilao($idLeilao)
    {
        $leilao = DB::table('TB_LEILAO')  
        ->where('TB_LEILAO.ID_LEILAO', $idLeilao)  
        ->leftJoin('TB_PRODUTO_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO')
     ->leftJoin('TB_ANUNCIO_PRODUTO','TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO','TB_PRODUTO_LEILAO.ID_PRODUTO')
        ->select(
            'TB_PRODUTO_LEILAO.*',
            'TB_LEILAO.*',
            'TB_ANUNCIO_PRODUTO.DS_ANUNCIO_PRODUTO',
            'TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO',
            'TB_ANUNCIO_PRODUTO.DS_DETALHE_PRODUTO')
        ->get();                     
        return $leilao;
    }

    public static function recuperarQuantidadeLances($idLeilao)
    {
        $qtdLances = DB::table('TB_LANCE')  
        ->where('TB_LANCE.ID_LEILAO', $idLeilao)       
        ->select(
            'TB_LANCE.ID_LANCE')
        ->count();                           
        return $qtdLances;
    }

    public static function recuperarMaiorValorLance($idLeilao)
    {
        $valorMaiorLance = DB::table('TB_LANCE')  
        ->where('TB_LANCE.ID_LEILAO', $idLeilao)               
        ->max('TB_LANCE.VL_LANCE');                               
        return $valorMaiorLance;
    }

    public static function recuperarLeilaoAnuncio($idAnuncio)
    {
        $leilaoAnuncio = DB::table('TB_PRODUTO_LEILAO')  
        ->where('TB_PRODUTO_LEILAO.ID_PRODUTO', $idAnuncio)               
        ->join('TB_LEILAO','TB_LEILAO.ID_LEILAO_PRODUTO','TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO') 
        ->get();                        
        return $leilaoAnuncio;
    }

    public static function cadastrarLanceLeilao($dados){   
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');          
        $idLance = DB::table('TB_LANCE')
        ->insertGetId([
            'ID_LEILAO' => $dados->idLeilao, 
            'VL_LANCE' => $dados->lance,
            'DT_LANCE' => $date, 
            'ID_COMPRADOR' => session()->all()['id']
        ]);      
        return $idLance;
    }

    public static function cadastrarProdutoLeilao($dados, $idAnuncioProduto){    
        
        $anuncio = DB::table('TB_ANUNCIO_PRODUTO')
        ->where('TB_ANUNCIO_PRODUTO.ID_ANUNCIO_PRODUTO', $idAnuncioProduto)
        ->get();        

        $idProdutoLeilao = DB::table('TB_PRODUTO_LEILAO')
        ->insertGetId([
            'ID_PRODUTO' => $idAnuncioProduto, 
            'DS_DESCRICAO_DETALHADA' => $anuncio[0]->DS_DETALHE_PRODUTO,
            'VL_PRECO_INICIAL' => floatval($anuncio[0]->VL_PRODUTO_UNITARIO)
        ]);      
        return $idProdutoLeilao;
    }

    public static function cadastrarLeilao($dados, $idLeilaoProduto){
        try {
            $arrayDtInicio = explode ("/", $dados->dt_inicio);     
            $dtInicio =  $arrayDtInicio[2] . "-" . $arrayDtInicio[1] . "-" . $arrayDtInicio[0];  
    
            $arrayDtFim = explode ("/", $dados->dt_fim);     
            $dtFim =  $arrayDtFim[2] . "-" . $arrayDtFim[1] . "-" . $arrayDtFim[0];  
    
            $dtInicio = strtotime($dtInicio);    
            $dtFim = strtotime($dtFim);     
                   
            $idLeilao = DB::table('TB_LEILAO')
            ->insertGetId([
                'ID_LEILAO_PRODUTO' => $idLeilaoProduto, 
                'ID_USUARIO' => $dados->id_comprador,
                'DS_LOJA' => $dados->loja,
                'DS_VENDEDOR' => $dados->vendedor,
                'DS_IDENTIFICACAO' => $dados->identificacao,
                'DS_INFORMACOES' => $dados->informacoes,
                'DS_CONDICOES_GERAIS' => $dados->condicoesGerais,
                'DS_ACESSORIOS' => $dados->acessorios,
                'DT_FIM' => date('Y-m-d H:i:s', $dtInicio),
                'DT_INICIO' => date("Y-m-d H:i:s", $dtFim),
            ]);      
            return $idLeilao;
        } catch (\Exception $e) {
            dd($e);
        }
       
    }

    public static function cadastrarLeilaoComprador($idLeilao, $idComprador){              
        $idLeilaoComprador = DB::table('TB_LEILAO_COMPRADOR')
        ->insertGetId([
            'ID_LEILAO' => $idLeilao, 
            'ID_COMPRADOR' => $idComprador
        ]);      
        return $idLeilaoComprador;
    }

    public static function editarProdutoLeilao($dados){  
        $idProdutoLeilao = 0;  
        if($dados->idLeilaoProduto != "0"){
            $leilaoProduto['DS_DESCRICAO_DETALHADA'] = $dados->nomeProduto;
            $leilaoProduto['VL_PRECO_INICIAL'] = floatval($dados->vl_unitario);  
            
            $idProdutoLeilao = DB::table('TB_PRODUTO_LEILAO')
                ->where('TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO', $dados->idLeilaoProduto)
                ->update($leilaoProduto); 
        }               
        return $idProdutoLeilao;
    }

    public static function editarLeilao($dados){ 
        $idLeilao = 0;   
        if($dados->idLeilao != "0"){
            $arrayDtInicio = explode ("/", $dados->dt_inicio);     
            $dtInicio =  $arrayDtInicio[2] . "-" . $arrayDtInicio[1] . "-" . $arrayDtInicio[0];  
    
            $arrayDtFim = explode ("/", $dados->dt_fim);     
            $dtFim =  $arrayDtFim[2] . "-" . $arrayDtFim[1] . "-" . $arrayDtFim[0];  
    
            $dtInicio = strtotime($dtInicio);    
            $dtFim = strtotime($dtFim);      
                            
            $leilao['DS_LOJA'] = $dados->loja;
            $leilao['DS_VENDEDOR'] = $dados->vendedor;
            $leilao['DS_IDENTIFICACAO'] = $dados->identificacao;
            $leilao['DS_INFORMACOES'] = $dados->informacoes;
            $leilao['DS_CONDICOES_GERAIS'] = $dados->condicoesGerais;
            $leilao['DS_ACESSORIOS'] = $dados->acessorios;
            $leilao['DT_FIM'] = date('Y-m-d H:i:s', $dtFim);
            $leilao['DT_INICIO'] = date("Y-m-d H:i:s", $dtInicio); 
            
            $idLeilao = DB::table('TB_LEILAO')
                ->where('TB_LEILAO.ID_LEILAO', $dados->idLeilao)
                ->update($leilao);
        }     
         
        return $idLeilao;
    }
    
    public static function deletarFavoritoLeilao($idLeilao){  

        DB::table('TB_FAVORITO_LEILAO')->where('TB_FAVORITO_LEILAO.ID_LEILAO', $idLeilao)->delete();     
        return $idLeilao;
    }    

    public static function deletarLeilaoProduto($idAnuncioProduto){  
                    
        $idProdutoLeilao = DB::table('TB_PRODUTO_LEILAO')  
        ->where('TB_PRODUTO_LEILAO.ID_PRODUTO', $idAnuncioProduto)
        ->select('TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO') 
        ->get();  

        DB::table('TB_PRODUTO_LEILAO')->where('TB_PRODUTO_LEILAO.ID_PRODUTO', $idAnuncioProduto)->delete();     
        return $idProdutoLeilao;
    }

    public static function deletarLeilaoComprador($idAnuncioProduto)
    {              
        $idAnuncioProduto = intval($idAnuncioProduto);
        $idProdutoLeilao = DB::table('TB_PRODUTO_LEILAO')  
        ->where('TB_PRODUTO_LEILAO.ID_PRODUTO', $idAnuncioProduto)
        ->select('TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO') 
        ->get();   

        $idLeilao = DB::table('TB_LEILAO')  
        ->where('TB_LEILAO.ID_LEILAO_PRODUTO', $idProdutoLeilao[0]->ID_LEILAO_PRODUTO)
        ->select('TB_LEILAO.ID_LEILAO') 
        ->get();  

        DB::table('TB_LEILAO_COMPRADOR')->where('TB_LEILAO_COMPRADOR.ID_LEILAO', $idLeilao[0]->ID_LEILAO)->delete();     
        return $idLeilao[0]->ID_LEILAO;
    }

    public static function deletarLances($idLeilao)
    {                            
        return DB::table('TB_LANCE')->where('TB_LANCE.ID_LEILAO', $idLeilao)->delete();              
    }

    public static function deletarLeilao($idAnuncioProduto)
    {  
        $idProdutoLeilao = DB::table('TB_PRODUTO_LEILAO')  
        ->where('TB_PRODUTO_LEILAO.ID_PRODUTO', $idAnuncioProduto)
        ->select('TB_PRODUTO_LEILAO.ID_LEILAO_PRODUTO') 
        ->get();                           
        return DB::table('TB_LEILAO')->where('TB_LEILAO.ID_LEILAO_PRODUTO', $idProdutoLeilao[0]->ID_LEILAO_PRODUTO)->delete();              
    }
}
