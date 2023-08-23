<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LeilaoService;
use App\Http\Services\UsuarioService;

class LeilaoController extends Controller
{

    protected $usuarioService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __constrct(
        UsuarioService $usuarioService
        )
    {       
        $this->usuarioService = $usuarioService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        if(!key_exists('email',session()->all())){
            return view('auth.login');        
        }        
        //Transformar esse 3 em constante                  
        $leiloes = $this->usuarioService->teste();
        return view('leilao', compact('leiloes'));
    }   
}
