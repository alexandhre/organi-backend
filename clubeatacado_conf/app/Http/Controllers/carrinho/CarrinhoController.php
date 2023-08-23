<?php

namespace App\Http\Controllers\carrinho;

use App\Anuncio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarrinhoController extends Controller
{

    public function page(){
        if (Auth::User() === null) {
            return view('auth.login');
        } else {
        return view('admin.user.carrinho');
        }
    }
    public function listar(Request $request)
    {
            $anuncios = [];
            foreach ($request['input'] as $item) {

                array_push($anuncios, Anuncio::anuncioById($item));
            }
            $anuncios = array_unique($anuncios);
            return $anuncios;
    }

}
