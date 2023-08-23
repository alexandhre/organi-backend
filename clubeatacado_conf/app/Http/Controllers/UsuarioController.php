<?php

namespace App\Http\Controllers;

use App\Anunciante;
use App\Categoria;
use App\Favorito;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Auth;
use App\Notifications\EmailValidade;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if((Auth::User())){

                $listaUsers = User::userdetail(Auth::User()->id);

                return $listaUsers;

            }else{

                return view('auth.login');

            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
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
