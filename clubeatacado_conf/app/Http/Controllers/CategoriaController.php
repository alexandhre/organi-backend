<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use App\Produto;
use App\Http\Services\CategoriaProdutoService;
use App\Http\Services\SharedService;
use App\Http\Services\ResponseService;

class CategoriaController extends Controller
{

    protected $categoriaProdutoService;

    protected $sharedService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoriaProdutoService $categoriaProdutoService,
        SharedService $sharedService,
        ResponseService $responseService
        )
    {       
        $this->categoriaProdutoService = $categoriaProdutoService;
        $this->sharedService = $sharedService;
        $this->responseService = $responseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categorias = Categoria::listAll();
        $show = 0;
        return view ('index', compact(['categorias','show']));
    }


        //listar todas as categorias para a página categoria
    public function showAll(){
        $AllCategorias = Categoria::listAll();
        $show = 0;
        return view ('categoria.categorias', compact(['AllCategorias','show']));
    }

        //listar 4 categorias para a página como funciona
    public function showComoFunciona(){
        $showComoFunciona = Categoria::list4Categorias();
        $show = 0;
        return view('comofunciona', compact(['showComoFunciona','show']));
    }

        //listar categoria menu
    public function menucategoria(){
        $categoria = Categoria::listAll();
        return $categoria;
    }

        //listar tipo categoria
    public function tipoCategoria($id){
        $categoria = Produto::listByCategoria($id);
        $show = 0;
        return view('categoria.tipocategoria',compact(['categoria','show']));
    }

    //categoria Page
    public function CategoriaPage(){

        $show = 0;
        return view('categoria.categorias',compact(['show']));
    }

    public function pesquisar(Request $request)
    {  
        //generalizar o serviço de buscar categorias                
        $dados =  $this->sharedService->converterRequestToJson($request);  
        $categorias = $this->categoriaProdutoService->recuperarCategoriasByNome($dados->DS_INPUT_PESQUISA);                              
        $response = [
            'categorias' => $categorias
        ];    
        return $this->responseService->responseSucessoJson(200, $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
