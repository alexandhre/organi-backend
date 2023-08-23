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
use App\Http\Services\ResponseService;

class CompradorController extends Controller
{

    protected $compradorService;

    protected $sharedService;

    protected $usuarioService;

    protected $cidadeService;

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
        ResponseService $responseService
        )
    {       
        $this->compradorService = $compradorService;
        $this->sharedService = $sharedService;
        $this->usuarioService = $usuarioService;
        $this->cidadeService = $cidadeService;
        $this->responseService = $responseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function atualizarComprador(Request $request)
    {       
        $validator = $this->compradorService->validarDadosUsuario($request);        
        if ($validator->fails()) {
            return redirect('perfil')
            ->withErrors($validator)
            ->withInput();
        }
        $dados =  $this->sharedService->converterRequestToJson($request); 
        $this->compradorService->atualizarDadosComprador($dados); 
        return $this->responseService->responseSucessoJson(200, 'Usuário atualizado com sucesso!');
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
