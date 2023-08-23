<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Auth;
use App\Anunciante;
use App\Categoria;
use App\Favorito;
use App\Http\Services\CompradorService;
use App\Http\Services\SharedService;
use App\Http\Services\CidadeService;
use App\Http\Services\UsuarioService;
use App\Http\Services\DocumentService;
use App\Http\Services\ResponseService;

class ProdutorController extends Controller
{

    protected $compradorService;

    protected $sharedService;

    protected $usuarioService;

    protected $cidadeService;

    protected $documentService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CompradorService $compradorService,
        SharedService $sharedService,
        UsuarioService $usuarioService,
        CidadeService $cidadeService,
        DocumentService $documentService,
        ResponseService $responseService
        )
    {       
        $this->compradorService = $compradorService;
        $this->sharedService = $sharedService;
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->documentService = $documentService;
        $this->responseService = $responseService;
    }

    public function produtorPage(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);       

        $cidades = $this->cidadeService->recuperarCidades(); 
        $tipoNegocioLista = $this->usuarioService->recuperarTipoNegocioEmpresa(); 
        $categorias = $this->usuarioService->recuperarCategoriaEmpresa(); 
        $dadosUsuario = $this->usuarioService->recuperarDadosProdutor($dados->idComprador); 
        $numberCarrinho = $this->sharedService->getNumberCarrinho($dados->idComprador);
        $numberFavorito = $this->sharedService->getNumberFavorito($dados->idComprador); 
        $response = [
            'cidades' => $cidades,
            'tipoNegocioLista' => $tipoNegocioLista,
            'categoriaEmpresa' => $categorias,
            'dadosUsuario' => $dadosUsuario,
            'error' => false,
            'numberCarrinho' => $numberCarrinho,
            'numberFavorito' =>  $numberFavorito         
        ];   
        return $this->responseService->responseSucessoJson(200, $response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function atualizarProdutor(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);                                    
        $idRepresentanteLegal = $this->usuarioService->recuperarRepresentanteLegal($dados);  
        $this->usuarioService->atualizarRepresentanteLegal($dados, $idRepresentanteLegal);               
        $idProdutor = $this->usuarioService->atualizarDadosProdutor($dados);     

        $responseUploadLogotipo = $this->documentService->cadastrarLogotipo($dados->logotipo, $dados->idProdutor);  
                        
        if($responseUploadLogotipo["erro"]){
            $response = [
                'message' => 'Erro ao fazer upload do logotipo!',
                'error' => true,
            ];
            return $this->responseService->responseSucessoJson(200, $response);                
        }         
        
        $response = [
            'message' => 'Produtor Atualizado com Sucesso!',
            'error' => false,
        ];   
        return $this->responseService->responseSucessoJson(200, $response); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastrarProdutor(Request $request)
    {
        $dados =  $this->sharedService->converterRequestToJson($request);                                    
        $idRepresentanteLegal = $this->usuarioService->cadastrarRepresentanteLegal($dados);                
        $idProdutor = $this->usuarioService->cadastrarDadosProdutor($dados, $idRepresentanteLegal);     

        $responseUploadLogotipo = $this->documentService->cadastrarLogotipo($dados->logotipo, $idProdutor);  
                        
        if($responseUploadLogotipo["erro"]){
            $response = [
                'message' => 'Erro ao fazer upload do logotipo!',
                'error' => true,
            ];
            return $this->responseService->responseSucessoJson(200, $response);                
        }         
        
        $response = [
            'message' => 'Produtor Cadastrado com Sucesso!',
            'error' => false,
        ];   
        return $this->responseService->responseSucessoJson(200, $response); 
    }

    public function favoritoPage()
    {
        if(Auth::User() === null){
            $categorias = Categoria::listAll();
            $show = 1;
            return view('usuario.favoritos', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.favoritos',compact(['show']));
        }
    }

    public function favoritoList()
    {

        $listaUsers = Favorito::favoritoList(Auth::User()->id);
        return $listaUsers;
    }

    public function perfilPage()
    {
        if(Auth::User() === null){
            $categorias = Categoria::listAll();
            $show = 1;

            return view('usuario.perfil', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.perfil',compact(['show']));
        }
    }

    public function meuAnunciosPage()
    {
        if(Auth::User() === null){
            $categorias = Categoria::listAll();
            $show = 1;

            return view('usuario.meusAnuncios', compact(['categorias','show']));
        }else{

            $show = 0;
            return view('usuario.meusAnuncios',compact(['show']));
        }
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $user = $request->input;
        $id = Auth::User()->id;

        $response = Anunciante::updateByIdWeb($user, $id);
        return $response;
    }
        //update foto Usuario Temporaria
    public function uploadFotoUsuario(Request $request){

        if($request->hasFile('myFile')){

            $image = $request->file('myFile');

            $name = $image->getClientOriginalName();
            $destinationPath = ("images\\resource\\tmp\\usuario");


            $image->move($destinationPath, $name);

            $success = [
                'successId' => 200,
                'successMessage' => 'Imagem salva com sucesso!'
            ];
            $response = [
                'success' => $success
            ];

        }else{
            $response = [
                'Erro' => 'Não foi encontrado arquivo image'
            ];
        }

        return response()->json(compact('response'));
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

    public function verificacao($id){

        try {
            User::verificacao($id);
            return view('auth.login');
        } catch (Exception $e) {
            return "falha na verificação";
        }
    }
    public function novasenha(){

        $categorias = Categoria::listAll();
        $show = 0;
        return view('auth.passwords.novasenha', compact(['categorias','show']));
    }
}
