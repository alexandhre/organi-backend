<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoriaProdutoService;
use Illuminate\Http\Request;
use App\Http\Services\CidadeService;
use App\Http\Services\CompradorService;
use App\Http\Services\LeilaoService;
use App\Http\Services\ResponseService;
use App\Http\Services\SharedService;
use App\Http\Services\UsuarioService;


class ClearController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
    }
    
    public function index()
    {
        \Artisan::call('route:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('route:cache');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
    } 
}
