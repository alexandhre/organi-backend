<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$this->get('/', function () {
     return redirect('/home');
});

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('registro', 'Auth\RegisterController@showRegisterForm')->name('registro');
Route::get('/validarUsuario', 'Auth\RegisterController@abrirTelaValidarUsuario')->name('validarUsuario');

Route::get('recuperarSenha', 'Auth\ResetPasswordController@showRecuperarSenhaForm')->name('recuperarSenha');
Route::post('/enviarEmailRecuperarSenha', 'Auth\ResetPasswordController@enviarEmailRecuperarSenha')->name('enviarEmailRecuperarSenha');
//Route::get('/home', 'Auth\LoginController@showLoginForm')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@cadastro')->name('register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//index
Route::get('/home', 'IndexController@index')->name('home');
Route::get('/pesquisa', 'IndexController@abrirPaginaPesquisa')->name('pesquisa');
Route::get('/carrinho', 'IndexController@carrinho')->name('carrinho');
Route::post('/categoria', 'IndexController@categoria')->name('categoria');
Route::post('/promocao', 'IndexController@promocao')->name('promocao');
Route::post('/produto', 'IndexController@produto')->name('produto');
Route::post('/pesquisar', 'IndexController@pesquisarProduto')->name('pesquisar');
Route::post('/pesquisarProdutoInput', 'IndexController@pesquisarProdutoInput')->name('pesquisar');
Route::post('/pesquisarCategoria', 'CategoriaController@pesquisar')->name('pesquisar');

Route::get('/perfil', 'PerfilController@index')->name('perfil');

Route::post('/atualizarComprador', 'CompradorController@atualizarComprador')->name('atualizarComprador');

Route::get('/anuncio', 'anuncio\AnuncioController@index')->name('anuncio');

Route::get('/editarAnuncio/{id?}', 'anuncio\AnuncioController@getAnuncioById')->name('getAnuncioById');

Route::get('/recuperarAnuncio/{id?}', 'anuncio\AnuncioController@getAnuncio')->name('getAnuncio');

Route::post('/cadastrarAnuncio', 'anuncio\AnuncioController@create')->name('cadastrarAnuncio');
Route::post('/atualizarAnuncio', 'anuncio\AnuncioController@update')->name('atualizarAnuncio');
Route::post('/uploadImage', 'DocumentController@create')->name('uploadImage');

Route::get('/fornecedor', 'ProdutorController@produtorPage')->name('produtorPage');
Route::post('/atualizarProdutor', 'ProdutorController@atualizarProdutor')->name('atualizarProdutor');

Route::get('/leilao', 'LeilaoController_@index')->name('leilao');

Route::get('/detalheLeilao/{id?}', 'LeilaoController_@telaDetalheLeilao')->name('telaDetalheLeilao');

Route::post('/recuperarDetalheLeilao', 'LeilaoController_@recuperarDetalheLeilao')->name('recuperarDetalheLeilao');

Route::post('/recuperarDetalheAnuncio', 'anuncio\AnuncioController@recuperarDetalheAnuncio')->name('recuperarDetalheAnuncio');

Route::post('/enviarLanceLeilao', 'LeilaoController_@enviarLanceLeilao')->name('enviarLanceLeilao');
Route::post('/deletarProduto', 'anuncio\AnuncioController@destroy')->name('destroy');

Route::post('/favoritarAnuncio', 'anuncio\AnuncioController@favoritarAnuncio')->name('favoritarAnuncio');

//Rotas de usuario
$this->group(['prefix' => '/usuario'], function() {
    
    $this->get('/listar/{id?}', 'usuario\UsuarioController@listarUsuarioWeb');
    $this->get('/userdetail', 'usuario\UsuarioController@editar')->name('userdetail');
    $this->get('/logado', 'usuario\UsuarioController@logado');
    $this->get('/meusanuncios', 'anuncio\AnuncioController@meusAnuncioWeb');
    $this->get('/promocionar', 'anuncio\AnuncioController@promocaoNovaPage');
    $this->get('/promo/{id?}', 'anuncio\AnuncioController@promocaoNova');
    $this->get('/promocoes', 'anuncio\AnuncioController@promocaoPage');
    $this->get('/promocoes/add', 'anuncio\AnuncioController@promocaoNova');
    $this->post('/update', 'usuario\UsuarioController@updateweb');
    $this->get('/delete/{id?}', 'usuario\UsuarioController@destroy');
    $this->get('/validacao/email/{id?}', 'usuario\UsuarioController@verificacao');
    $this->get('chat', 'chat\ChatController@listarchatweb');
    $this->post('chat/novo', 'chat\ChatController@chatAdd');
    $this->post('chat/delete', 'chat\ChatController@chatDelete');
    $this->get('chat/{id}', 'usuario\UsuarioController@UsuarioChatInfo');
    $this->get('chat/colation/{colation?}/{id?}', 'chat\ChatController@UsuarioConversa');
    $this->post('chat/notification', 'chat\ChatController@chatnotication');
    $this->post('/recuperasenha', 'senha\PasswordResetController@create')->name('recuperasenha');
    $this->get('/esquecisenha', 'usuario\UsuarioController@novasenha');
    $this->post('/upload/imagem', 'usuario\UsuarioController@uploadfotousuarioweb');
    $this->post('/upload/imagem/empresa', 'usuario\UsuarioController@uploadfotoempresaweb');
    $this->get('/carrinho2', 'usuario\UsuarioController@carrinho');
    $this->get('/cidades/{id?}', 'usuario\UsuarioController@getCidades');
    $this->group(['prefix' => '/favoritos'],function(){
        $this->get('/add/{anuncio?}', 'usuario\UsuarioController@addFavoritosWeb');
        $this->get('/listar', 'usuario\UsuarioController@listarFavoritosweb');
        $this->get('/deletar/{id?}/{anuncio?}', 'usuario\UsuarioController@removeFavoritos');
    });
//    $this->group(['prefix' => '/chat'],function(){
//        $this->get('/listar', 'chat\ChatController@listarchatweb');
//    });
    $this->get('/produto/empresa/{id?}', 'usuario\UsuarioController@empresaFoto');

});
$this->group(['prefix' => '/enderecos'], function() {
    $this->post('cidade','usuario\UsuarioController@listCidade');
});


//Rotas de categoria
$this->group(['prefix' => '/categoria'], function() {
    $this->get('/listar/tipo', 'categoria\CategoriaController@listarTipocategorias');
    $this->get('/listar/{id?}', 'categoria\CategoriaController@listarcategorias');
    $this->get('/listar/tipo/{skip?}', 'categoria\CategoriaController@morelist');
    $this->get('/tipo/{type?}/{skip?}', 'categoria\CategoriaController@morelistType');
    $this->get('/listas', 'categoria\CategoriaController@listar');
    $this->post('/listar/produto', 'categoria\CategoriaController@listarProduto');
    $this->get('/todas', 'categoria\CategoriaController@todosProdutos');
    $this->get('/menu', 'categoria\CategoriaController@listmenu');
    $this->get('/principal/{id?}', 'categoria\CategoriaController@principaisCat');
});

// $this->group(['prefix' => '/carrinho'], function() {
//     $this->get('/', 'carrinho\CarrinhoController@page');
//     $this->post('/listar', 'carrinho\CarrinhoController@listar');
// });

//Rotas de anuncio
$this->group(['prefix' => '/anuncio'], function() {
    $this->post('/novo', 'anuncio\AnuncioController@createAnuncio');
    $this->get('/produto', 'anuncio\AnuncioController@produto');
    $this->get('/detalhe/{id?}', 'anuncio\AnuncioController@produtoDetalhe');
    $this->get('/meusanuncios/{id?}', 'anuncio\AnuncioController@meusAnuncios');
    $this->get('/produtodetalhe', 'anuncio\AnuncioController@produtoDetalhePage');
    $this->post('/upload/imagem/anuncio', 'anuncio\AnuncioController@uploadfotoanucio');
    $this->get('/anuncie', 'anuncio\AnuncioController@anuncie');
    $this->post('/novafoto', 'anuncio\AnuncioController@uploadfotoWeb');
    $this->get('/listar', 'anuncio\AnuncioController@listarAnuncio');
    $this->get('/descontos/listar', 'anuncio\AnuncioController@promocaoSemana');
    $this->get('/descontos', 'anuncio\AnuncioController@promocoesWeb');
    $this->get('/descontos/parar/{id?}', 'anuncio\AnuncioController@pararPromocoesWeb');
    $this->post('/promocoes/add', 'anuncio\AnuncioController@addpromocoesWeb');
    $this->get('/certificado/{id?}', 'anuncio\AnuncioController@EspTecnica');
    $this->get('/info/{id?}', 'anuncio\AnuncioController@infoProvedor');
    $this->get('/infogeral/{id?}', 'anuncio\AnuncioController@infogeral');
    $this->get('/add/{id?}/{anuncio?}', 'anuncio\AnuncioController@historico');
    $this->get('/add/{idanuncio?}/{vlr?}', 'anuncio\AnuncioController@desconto');
    $this->get('/promocoes', 'anuncio\AnuncioController@todasPromocoes');
    $this->get('/promocoes/more/{inicio?}', 'anuncio\AnuncioController@moretodasPromocoes');
    $this->post('/buscar', 'anuncio\AnuncioController@buscar');
    $this->post('/cores', 'anuncio\AnuncioController@cores');
    $this->post('/produto/select', 'anuncio\AnuncioController@buscados');
    $this->get('/produto/page', 'anuncio\AnuncioController@buscadospage');
    $this->get('/produto/certificacao/{id?}', 'anuncio\AnuncioController@certificacao');
    $this->get('/visita/{id?}', 'anuncio\AnuncioController@visita');
    $this->get('/lista/maisvistos', 'anuncio\AnuncioController@AnunuciosMiasVisto');
    $this->get('/MoreAnuncio/{inicio?}','anuncio\AnuncioController@morelist');
    $this->get('/maisvisitado/MoreAnuncio/{inicio?}','anuncio\AnuncioController@moreListMiasvistos');
    $this->get('/pedidos', 'anuncio\AnuncioController@Pedidos');
    $this->get('/destaques', 'anuncio\AnuncioController@destaques');
    $this->get('/destaques/more/{inicio?}', 'anuncio\AnuncioController@destaquesMore');
    $this->get('/remove/{id?}', 'anuncio\AnuncioController@remove');
    $this->get('/editar/page', 'anuncio\AnuncioController@editarPage');
    $this->get('/editar/{id?}', 'anuncio\AnuncioController@editar');
    $this->get('/remove/foto/{id?}/{foto?}', 'anuncio\AnuncioController@removerFoto');
    $this->post('/editar', 'anuncio\AnuncioController@editarUpload');
    $this->get('searchproduto/{id?}', 'anuncio\AnuncioController@produtoinfo');
    $this->post('add/comentario', 'anuncio\AnuncioController@addComentario');
});


//Route::get('/validar/email/{id?}', 'user@validar');carrinho/listar
//Route::post('recuperasenha', 'PasswordController@create');

Route::get('/mail', function () {
    $to_name = 'TESTE';
    $to_email = 'alexandhre10@gmail.com';
    $data = array('idUsuario'=>481);
    
    Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
        $message->from('rs.gestor.contato@gmail.com','Artisans Web');
    });
});

Route::get('/clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('route:cache');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
});