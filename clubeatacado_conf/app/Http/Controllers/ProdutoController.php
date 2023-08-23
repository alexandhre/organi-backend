<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\FotoAnuncio;
use App\Preco;
use App\Produto;
use App\User;
use App\Visita;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\ProdutoService;
use App\Http\Services\ResponseService;
use App\Http\Services\SharedService;
use App\Http\Services\PaginationService;

class ProdutoController extends Controller
{

    protected $produtoService;

    protected $responseService;

    protected $sharedService;

    protected $paginationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProdutoService $produtoService,
        ResponseService $responseService,
        SharedService $sharedService,
        PaginationService $paginationService
    ) {
        $this->produtoService = $produtoService;
        $this->responseService = $responseService;
        $this->sharedService = $sharedService;
        $this->paginationService = $paginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produtos(Request $request)
    {
        //Transformar esse 3
        $dados =  $this->sharedService->converterRequestToJson($request);
        $produtos = $this->produtoService->recuperarProdutos();
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        //colocar num metodo separado                
        $response = [
            'produtos' => $produtos,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function prateleiraProdutos(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);
        $produtos =  $this->produtoService->listarProdutos(false, $dados->idComprador);       
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador);
        $pagination = [
            'per_page' => $produtos['produtosPage']->perPage(),
            'on_first_page' => $produtos['produtosPage']->onFirstPage(),
            'last_page' => $produtos['produtosPage']->lastPage(),
            'first_page_url' => $produtos['produtosPage']->url(1),
            'next_page_url' => $produtos['produtosPage']->nextPageUrl(),
            'prev_page_url' => $produtos['produtosPage']->previousPageUrl(),
            'last_page_url' => $produtos['produtosPage']->url($produtos['produtosPage']->lastPage()),
            'total' => $produtos['produtosPage']->total()
        ];        
        $response = [
            'produtos' => $produtos['produtos'],
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' => $numberFavorito,
            'pagination' => $pagination,
            'errors' => false
        ];
        return $this->responseService->responseSucessoJson(200, $response);
    }

    public function showProdutos()
    {
        if (Auth::User()) {
            $showProdutos = Produto::AnunciosVisited();
            return $showProdutos;
        } else {
            $showProdutos = Produto::allAnuncios();
            return $showProdutos;
        }
    }

    public function showMyProdutos()
    {

        $showProdutos = Produto::listMy();

        return $showProdutos;
    }
    public function showMyOtherProdutos($id)
    {

        $showProdutos = Produto::otherAnuncios($id);

        return $showProdutos;
    }
    public function showMyProdutospage()
    {


        if (Auth::User() === null) {
            $categorias = Categoria::listAll();
            $show = 1;
            return view('usuario.favoritos', compact(['categorias', 'show']));
        } else {

            $show = 0;
            return view('usuario.meusanuncios', compact(['show']));
        }
    }
    public function subirPage()
    {


        if (Auth::User() === null) {
            $categorias = Categoria::listAll();
            $show = 1;
            return view('produto.subirProduto', compact(['categorias', 'show']));
        } else {

            $show = 0;
            return view('produto.subirProduto', compact(['show']));
        }
    }

    public function addFavorito($idAnuncio)
    {

        $id = User::getId(Auth::User()->id);

        $favorito = Produto::favoritosAdd(intval($idAnuncio), intval($id));
        return $favorito;
    }

    public function detalhePage()
    {
        if (Auth::User() === null) {
            $categorias = Categoria::listAll();
            $show = 1;
            return view('index', compact(['categorias', 'show']));
        } else {

            $show = 0;
            return view('produto.detalhe', compact(['usuario', 'show']));
        }
    }
    public function detalhe($id)
    {
        $showProdutos = Produto::GetAnuncio($id);

        return $showProdutos;
    }

    public function uploadfotoWeb(Request $request)
    {

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $destinationPath = ("images\\resource\\tmp\\anuncios");

            $name = $image->getClientOriginalName();

            $image->move($destinationPath, $name);
            $sucess = "OK";
        } else {
            $sucess  = "erro";
        }

        return $sucess;
    }

    //listar categoria menu
    public function tipoProd(Request $cat)
    {

        $categoria = Categoria::listaProduto($cat->cat);
        return $categoria;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = json_decode(json_encode($request->input, true));

        $produto = Produto::novoProduto($data);

        $preco = Preco::novo($data);

        $anuncio = Produto::novoAnuncio($data, $produto, $preco);

        if ($data[5]) {
            foreach ($data[5] as $item => $i) {

                $newPath = ("images\\anuncios\\" .  $anuncio->id);
                $oldPath = ("images\\resource\\tmp\\anuncios\\" . $i);

                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }

                //adicionar pasta usuario

                if (\File::moveDirectory($oldPath, "images\\anuncios\\" .  $anuncio->id . '\\' . $i)) {
                    $foto = FotoAnuncio::updatefoto($anuncio->id, $i);

                    $success = [
                        'successId' => 200,
                        'successMessage' => 'Anuncio cadastrado com sucesso!'
                    ];
                    $response = [
                        'success' => $success
                    ];
                }
            }
        }
        return $anuncio->id;
    }
    public function ComoFunciona()
    {
        $show = 0;
        return view('categoria.funcionamento', compact('show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function buscar(Request $request)
    {
        $cat = $request->cat;
        $anuncio = [];
        $categoria = DB::table('TB_CATEGORIA_PRODUTO')->where('DS_CATEGORIA_PRODUTO', 'like', '%' . $cat . '%')->select('DS_CATEGORIA_PRODUTO')->get();
        $produtos = DB::table('TB_ANUNCIO_PRODUTO')->where('DS_ANUNCIO_PRODUTO', 'like', '%' . $cat . '%')->select('DS_ANUNCIO_PRODUTO')->get();

        return [$categoria, $produtos];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function searchAnuncio($type)
    {

        $categoria = Produto::listByCategoria($type);
        $produtos = Produto::searchProduto($type);

        return [$categoria, $produtos];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function visita($id)
    {

        if (Auth::User()) {

            Visita::novo($id, User::getId(Auth::User()->id));
        }

        $infoAnuncio = Produto::addvisita($id);
        return $infoAnuncio;
    }
}
