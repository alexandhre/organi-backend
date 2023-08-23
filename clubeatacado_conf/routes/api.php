<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//////////////////////////////////////////////////////////////////////////////////////
//Auth
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@cadastro')->name('register');
Route::post('/enviarEmailRecuperarSenha', 'Auth\ResetPasswordController@enviarEmailRecuperarSenha')->name('enviarEmailRecuperarSenha');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/usuario/validacao/email/{id?}', 'usuario\UsuarioController@verificacao');
//////////////////////////////////////////////////////////////////////////////////////

Route::post('/categoria', 'IndexController@categoria')->name('categoria');
Route::post('/promocao', 'IndexController@promocao')->name('promocao');
Route::post('/produtosIndex', 'IndexController@produtos')->name('produtos');

//////////////////////////////////////////////////////////////////////////////////////
//Contato
Route::post('/enviarMensagem', 'ContatoController@enviarMensagem')->name('enviarMensagem');
//////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => 'auth.session'], function () {
    //////////////////////////////////////////////////////////////////////////////////////
    //landingPage        
    Route::post('/favoritarAnuncio', 'anuncio\AnuncioController@favoritarAnuncio')->name('favoritarAnuncio');
    Route::post('/addCarrinho', 'anuncio\AnuncioController@addCarrinho')->name('addCarrinho');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Perfil
    Route::post('/atualizarComprador', 'CompradorController@atualizarComprador')->name('atualizarComprador');
    Route::post('/perfil', 'PerfilApiController@index')->name('perfil');
    Route::post('/compras', 'PerfilController@compras')->name('compras');
    Route::post('/leiloes', 'PerfilController@leiloes')->name('leiloes');
    Route::post('/favoritos', 'PerfilController@favoritos')->name('favoritos');
    Route::post('/favoritosLeilao', 'PerfilController@favoritosLeilao')->name('favoritosLeilao');
    Route::post('/produtos', 'PerfilController@produtos')->name('produtos');
    Route::post('/produtosLeilao', 'PerfilController@produtosLeilao')->name('produtosLeilao');
    Route::post('/deletarProduto', 'anuncio\AnuncioController@destroy')->name('destroy');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Novo Produto
    Route::post('/produtos', 'ProdutoController@produtos')->name('produtos');
    Route::post('/listaTipoAnuncio', 'anuncio\AnuncioController@recuperarListaAnuncio')->name('recuperarListaAnuncio');
    Route::post('/cadastrarAnuncio', 'anuncio\AnuncioController@create')->name('cadastrarAnuncio');
    Route::post('/cadastrarDadosAdicionais', 'anuncio\AnuncioController@cadastrarDadosAdicionais')->name('cadastrarDadosAdicionais');
    Route::post('/cadastrarFotosAnuncio', 'anuncio\AnuncioController@cadastrarFotosAnuncio')->name('cadastrarFotosAnuncio');
    Route::post('/cadastrarDadosLeilao', 'anuncio\AnuncioController@cadastrarDadosLeilao')->name('cadastrarDadosLeilao');
    Route::post('/uploadImage', 'DocumentController@create')->name('uploadImage');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Prateleira de Produtos
    Route::post('/listaProdutos', 'ProdutoController@prateleiraProdutos')->name('prateleiraProdutos');
    Route::post('/pesquisar', 'IndexController@pesquisarProduto')->name('pesquisar');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Detalhe Produto
    Route::post('/recuperarDetalheAnuncio', 'anuncio\AnuncioController@recuperarDetalheAnuncio')->name('recuperarDetalheAnuncio');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Carrinho
    Route::post('/carrinho', 'anuncio\AnuncioController@recuperarCarrinho')->name('recuperarCarrinho');
    Route::post('/salvarCheckout', 'anuncio\AnuncioController@salvarCheckout')->name('salvarCheckout');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Checkout
    Route::post('/checkout', 'anuncio\AnuncioController@checkout')->name('checkout');
    Route::post('/validarCupom', 'anuncio\AnuncioController@validarCupom')->name('validarCupom');
    //////////////////////////////////////////////////////////////////////////////////////
    
    //////////////////////////////////////////////////////////////////////////////////////
    //Registrar/Atualizar Produtor
    Route::post('/fornecedor', 'ProdutorController@produtorPage')->name('produtorPage');
    Route::post('/atualizarProdutor', 'ProdutorController@atualizarProdutor')->name('atualizarProdutor');
    Route::post('/cadastrarProdutor', 'ProdutorController@cadastrarProdutor')->name('cadastrarProdutor');
    //////////////////////////////////////////////////////////////////////////////////////  
    
    //////////////////////////////////////////////////////////////////////////////////////
    //Contato
    Route::post('/contatoIndex', 'ContatoController@index')->name('index');
    //////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////
    //Pagamento
    Route::get('payment', 'PaymentController@index');
    Route::post('charge', 'PaymentController@charge');
    Route::get('paymentsuccess', 'PaymentController@payment_success');
    Route::get('paymenterror', 'PaymentController@payment_error');
    //////////////////////////////////////////////////////////////////////////////////////
});



Route::middleware('auth:api')->get('/user', 'usuario\UsuarioController@AuthRouteAPI');

Route::get('/clearApi', 'ClearController@index')->name('indexClear');


//Route::get('auth/config', function() {
//    Artisan::call('config:clear');
//    Artisan::call('cache:clear');
//    return "Config is cleared";
//});
$this->get('/auth/info', 'usuario\UsuarioController@info');
//Rotas de usuario
$this->group(['prefix' => 'auth/usuario'], function () {
    $this->post('/registrar', 'usuario\UsuarioController@register');
    $this->get('/listar', 'usuario\UsuarioController@listar');
    $this->post('/login', 'usuario\UsuarioController@login');
    $this->post('/logout', 'usuario\UsuarioController@logout');
    $this->post('/update', 'usuario\UsuarioController@updateApi');
    $this->post('/foto', 'usuario\UsuarioController@uploadFotoUsuario');
    $this->post('/upload/imagem/empresa', 'usuario\UsuarioController@uploadfotoempresaweb');
    $this->get('/list/{id?}', 'usuario\UsuarioController@listarUsuario');
    $this->get('/delete/{id?}', 'usuario\UsuarioController@destroy');
    $this->get('/chat/{id?}', 'chat\ChatController@listarchatApp');
    $this->post('/chat/novo', 'chat\ChatController@chatAdd');
    $this->post('/chat/delete', 'chat\ChatController@chatDelete');
    $this->get('/chat/detalhe/{id?}', 'usuario\UsuarioController@UsuarioChatInfo');
    $this->post('/chat/notification', 'chat\ChatController@chatnotication');
    $this->post('/recuperasenha', 'senha\PasswordResetController@create');
    $this->get('/estados', 'usuario\UsuarioController@getEstados');
    $this->get('/cidades/{id?}', 'usuario\UsuarioController@getCidades');
    $this->group(['prefix' => '/favoritos'], function () {
        $this->get('/add/{id?}/{anuncio?}', 'usuario\UsuarioController@addFavoritoApp');
        $this->get('/listar/{id?}', 'usuario\UsuarioController@listarFavoritos');
        $this->get('/deletar/{id?}/{anuncio?}', 'usuario\UsuarioController@removeFavoritos');
    });
});

//Rotas de categoria
$this->group(['prefix' => 'auth/categoria', 'middleware' => ['cors']], function () {
    $this->get('/listar/tipo', 'categoria\CategoriaController@listarTipocategorias');
    $this->get('/listar/{id?}', 'categoria\CategoriaController@listarcategorias');
    $this->get('/produtos/{anuncioId?}', 'categoria\CategoriaController@produtoByCategoria');
});

//Rotas de anuncio
$this->group(['prefix' => 'auth/anuncio', 'middleware' => ['cors']], function () {
    $this->post('/novo', 'anuncio\AnuncioController@create'); //add a documentação
    $this->get('/listar', 'anuncio\AnuncioController@listarAnuncio');
    $this->get('/listar/{id?}/{id_user}', 'anuncio\AnuncioController@anuncioDetalhe');
    $this->get('/{id?}', 'anuncio\AnuncioController@meusAnuncios');
    $this->post('/foto', 'anuncio\AnuncioController@uploadfoto');
    $this->get('/informacao/{id?}', 'anuncio\AnuncioController@EspTecnica');
    $this->get('/pedidos/{id?}', 'anuncio\AnuncioController@PedidosApp');
    $this->get('/pedidos/detalhe/{id?}/{id_comprador?}', 'anuncio\AnuncioController@PedidosDetalheApp');
    $this->get('/info/{id?}', 'anuncio\AnuncioController@infoProvedor');
    $this->get('/infogeral/{id?}', 'anuncio\AnuncioController@infogeral');
    $this->get('/add/{id?}/{anuncio?}', 'anuncio\AnuncioController@historico');
    $this->get('/lista/maisvistos', 'anuncio\AnuncioController@AnunuciosMiasVistoApp');
    $this->get('/maisvisitado/MoreAnuncio/{inicio?}', 'anuncio\AnuncioController@moreListMiasvistosApp');
});


$this->group(['prefix' => 'auth/produto', 'middleware' => ['cors']], function () {
    $this->get('/destaques', 'anuncio\AnuncioController@destaques');
    $this->get('/promocoes', 'anuncio\AnuncioController@todasPromocoesApp');
    $this->get('/promocoes/{id?}', 'anuncio\AnuncioController@promocoes');
    $this->get('/descontos/parar/{id?}', 'anuncio\AnuncioController@pararPromocoes');
    $this->post('/promocoes/add', 'anuncio\AnuncioController@addpromocoes');
});
