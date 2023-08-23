<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UserController extends Controller
{

    //        public function getUsuario() {
//        if (Request::is('api*')) {
//           listaUsers = Usuario::listaUsuario();
//
//            $listaUsers  = json_encode($listaUsers);
//            echo "request from api route";
//            exit();
//        }else{
//            echo "request from web";
//            exit();
//        }
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listaUsers = Usuario::listaUsuario();

        $listaUsers  = json_encode($listaUsers);
        return view('admin.user.usuario', compact('listaUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       //dd($request->all());
        $data = $request->all();
        /*
        foreach ($data as $key => $value)
        {
            dd ($key. ' - '.$value.'</br>');
        }
        */
        //$data['ID_PERFIL_USUARIO'] = 15;
        //dd($data);
        Usuario::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_USUARIO)
    {
        dd($ID_USUARIO);
        return Usuario::find($ID_USUARIO);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //dd($request);
        //$data_user = json_encode($id);
        $data = $request->all();
//
//
//         Usuario::find($id)->update($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ID_USUARIO
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $data_user = json_encode(Usuario::where('ID_USUARIO',$id)->get());
        //Usuario::delete()->where('ID_USUARIO',$id);
        dd($data_user);

        return redirect()->back();
    }
}
