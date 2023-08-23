<?php

namespace App\Http\Controllers\anuncio;

use App\Anuncio;
use App\Atacadista;
use App\Categoria;
use App\Certificado;
use App\Comprador;
use App\Cor;
use App\FotoAnuncio;
use App\Http\Controllers\usuario\UsuarioController;
use App\Preco;
use App\Produto;
use App\Tamanho;
use App\User;
use App\Visita;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Auth;
use Illuminate\Support\Facades\Crypt;

use App\Http\Services\SharedService;
use App\Http\Services\ProdutoService;
use App\Http\Services\AnuncioService;
use App\Http\Services\ResponseService;

class DocumentController extends Controller
{

    protected $sharedService;

    protected $produtoService;

    protected $anuncioService;

    protected $responseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProdutoService $produtoService, 
        SharedService $sharedService,
        AnuncioService $anuncioService,
        ResponseService $responseService
        )
    {       
        $this->sharedService = $sharedService;
        $this->produtoService = $produtoService;
        $this->anuncioService = $anuncioService;
        $this->responseService = $responseService;
    }

    public function create(Request $request)
    {       
        $dados =  $this->sharedService->converterRequestToJson($request);   
        dd($dados);  
      
        //Anuncio::novoAnuncio($dados);

        // $cor = Cor::cor($data->cores, $anuncio->ID_ANUNCIO_PRODUTO);
        // $tamanho = Tamanho::tamanho($data->tamanho, $anuncio->ID_ANUNCIO_PRODUTO);
        // $preco = Preco::precoWeb( $anuncio->ID_ANUNCIO_PRODUTO, $data);

        // if ($data->foto) {
        //     foreach ($data->foto as $item => $i) {

        //         $newPath = ("images\\anuncios\\" .  $anuncio->ID_ANUNCIO_PRODUTO);
        //         $oldPath = ("images\\resource\\tmp\\anuncio\\" . $i);

        //         if (!file_exists($newPath)) {
        //             mkdir($newPath, 0777, true);
        //             chmod($newPath, 0777);
        //         }

        //         //adicionar pasta usuario
        //         if (\File::moveDirectory($oldPath, "images\\anuncios\\" .  $anuncio->ID_ANUNCIO_PRODUTO . '\\' . $i)) {
        //             $foto = FotoAnuncio::updatefoto( $anuncio->ID_ANUNCIO_PRODUTO, $i);

        //             $success = [
        //                 'successId' => 200,
        //                 'successMessage' => 'Anuncio cadastrado com sucesso!'
        //             ];
        //             $response = [
        //                 'success' => $success
        //             ];

        //         } else {

        //             $errors = error_get_last();
        //             $error = $errors['type'];
        //             $response = [
        //                 'error' => $error
        //             ];
        //         }
        //     }
        // }


        return response()->json(compact('response'));
    }

    public function uploadfoto(Request $request)
    {

        $image_file[] = $request["clubatacado_foto"];

        //Adicionar id no nome da pasta
        if ($request->hasFile('clubatacado_foto')) {

            if (is_array($request["clubatacado_foto"])) {

                $image = $request->file('clubatacado_foto');
                $destinationPath = ("\clubeatacado\images\\resource\\tmp\\anuncio");

                foreach ($image as $item) {

                    $name = $item->getClientOriginalName();
//                    chmod($destinationPath."/".$name,0777);
                    $item->move($destinationPath, $name);
                }
            } else {

                $image = $request->file('clubatacado_foto');
                echo $image;
                // $destinationPath = ("C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\public\\images\\resource\\tmp\\anuncio");
                $destinationPath = ("\clubeatacado\images\\resource\\tmp\\anuncio");
                $name = $image->getClientOriginalName();
//                chmod($destinationPath."/".$name,0777);
                $image->move($destinationPath, $name);

            }

            $response = [
                'Sucess' => 'imagem enviada com secesso'
            ];

        } else {
            $response = [
                'Erro' => 'Não foi encontrado arquivo imagem'
            ];
        }

        return response()->json(compact('response'));
    }

    public function createAnuncio(Request $request){
       
        $usuario = $request->input();

        $id = Atacadista::findId(session()->all()['id']);

        $pieces = explode(" ", $usuario['input'][4]);

        if(count($pieces) > 1){
            $usuario['input'][4] = str_replace(',', '.', $pieces[1]);
        }

        $credentials = [
            'usuarioId' => $id,
            'produtoId' => $usuario['input'][2],
            'nome' => $usuario['input'][0],
            'descricao' => $usuario['input'][1],
            'codigo' => $usuario['input'][3],
            'produto' => $usuario['input'][3],
            'quatidade' => $usuario['input'][5],
            'quatidadeMinima' => $usuario['input'][6],
            'preco' => $usuario['input'][4],
            'tamanho' => $usuario['input'][7],
            'fotos' => [
                $usuario['input'][10],
                $usuario['input'][11],
                $usuario['input'][12],
                $usuario['input'][13],
                $usuario['input'][14]
            ],
            'certificados' =>[
                $usuario['input'][15],
                $usuario['input'][16],
                $usuario['input'][17],
                $usuario['input'][18],
                $usuario['input'][19]
            ],
            'precos' => $usuario['input'][20],
            'garantia' =>  $usuario['input'][21]
        ];


        $validator = \Validator::make($credentials, [

            'produtoId' => "required",
            'nome' => "required",
            'descricao' => "required",
//            'video' => $credentials['video'],
            'quatidade' => "required",
//            'peso' => $credentials['peso'],
            'quatidadeMinima' => "required",
//            'capacidade' => $credentials['capacidade'],
        ]);

        if ($validator->fails()) {
            $error = response()->json(['error' => 'invalid_credentials'], 428);
            $error = [
                'errorId' => 428,
                'errorMessage' => 'credenciais invalidas'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'), 428);
        } else {
            // IMPLEMNTAR O ANUNCIO MODAL

            $anuncio = Anuncio::novoAnuncioWeb($credentials);

            $preco = Preco::preco($anuncio, $credentials['precos'], $credentials['preco']);
            $tamanho = [];

        foreach ($usuario['input'][7] as $i) {

            if (!(($i['tamanho'] == 0) && ($i['metragem'] == ''))) {
                $tamanho[] = [
                    'tamanho' => $i['tamanho'],
                    'medida' => $i['metragem'],
                ];
            }
        }

        $tamanho = Tamanho::tamanho($tamanho, $anuncio);

        $cor = Cor::cor($usuario['input'][9], $anuncio);

            for ($i = 0; $i < 5; $i++) {
                $newPath = ("C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/anuncio/" . $anuncio);
                $extencao = explode(".",$credentials['fotos'][$i]);
                $extencao = end($extencao);
                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }
                $file = new Filesystem();
                //$file->moveDirectory('C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\\images\\resource\\tmp\\anuncio\\'.$usuario['input'][$i],  "C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\images\\anuncios\\".$anuncio."\\".$usuario['input'][$i]);
                //adicionar pasta usuario
                $foto = "photo".substr(md5(rand(600000 , 12000000)), 0,8).".".$extencao;
                if($file->moveDirectory('C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/resource/tmp/anuncio/'.$credentials['fotos'][$i],  "C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/anuncio/" . $anuncio."/".$foto)){
                    //$file->moveDirectory('images\\resource\\tmp\\empresa\\'.$data[$i],  "images\\empresas\\".$usuarioId."\\".$data[$i])

                    $foto = FotoAnuncio::updatefoto($anuncio, $foto);

//                \File::delete('images\\resource\\tmp\\empresa\\'.$data[$i]);

                }else {
                    $errors = error_get_last();
                    $error = $errors['type'];
                    $response = [
                        'error' => $error
                    ];
                }
            }

            //ALTERAR TABLE PARA SALVAR CERTIFICACAO
            for ($j = 0; $j < 5; $j++) {
                $newPath = ("C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/certificados/" . $anuncio);
                $extencao = explode(".",$credentials['certificados'][$j]);
                $extencao = end($extencao);
                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }
                $file = new Filesystem();
                $foto = "cetificado".substr(md5(rand(600000 , 12000000)), 0,8).".".$extencao;
                //adicionar pasta usuario
                if($file->moveDirectory('C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/resource/tmp/anuncio/'.$credentials['certificados'][$j],  "C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/certificados/". $anuncio."/".$foto)) {
                    //$file->moveDirectory('images\\resource\\tmp\\empresa\\'.$data[$j],  "images\\empresas\\".$usuarioId."\\".$data[$j])
                    $id = Atacadista::findId(session()->all()['id']);

                    $foto = Certificado::updatefoto($id, $foto, $anuncio);
//                \File::delete('images\\resource\\tmp\\empresa\\'.$data[$j]);

                }else {
                    $errors = error_get_last();
                    $error = $errors['type'];
                    $response = [
                        'error' => $error
                    ];
                }
            }
        }

        return $anuncio;
    }
    public function uploadfotoWeb(Request $request)
    {

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $destinationPath = ("C:\Inetpub\\vhosts\myappnow.com.br\atacado.club\clubeatacado\images\\resource\\tmp\\anuncio");

            $name = $image->getClientOriginalName();

            $image->move($destinationPath, $name);
            $sucess = "OK";
        }else{
            $sucess  = "erro";
        }

        return $sucess;
    }
    public function uploadfotoanucio(Request $request){

        if ($request->hasFile('myFile')) {
            $image = $request->file('myFile');

            $tamanho = getimagesize($image);

            if(($image != null) &&($tamanho[0] < 2*$tamanho[1])&&($tamanho[1] < 2*$tamanho[0])) {
                $destinationPath = ('images/resource/tmp/anuncio/');

                if(!file_exists($destinationPath)){
                    mkdir($destinationPath,0777,true);
                    chmod($destinationPath,0777);
                }
                $image->move($destinationPath, $image->getClientOriginalName());
                return $image->getClientOriginalName();
            }else{
                return "erro imagem!!";
            }
        }else{
            return "sem imagem!!";
        }

    }

    public function listarAnuncio(){

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $anuncios = Anuncio::listar();

            $response =[
                'anuncio' => $anuncios
            ];

        }else{
            $anuncios = Anuncio::listarWeb();


            return response()->json(compact('anuncios'));
        }


        return response()->json(compact('response'));
    }
    public function anuncioDetalhe($id, $id_user){

            $anuncios = Anuncio::anuncio($id, $id_user);

            $response =[
                'anuncio' => $anuncios[0]
            ];

        return response()->json(compact('response'));
    }

    public function meusAnuncios($id){
        $anuncio = Anuncio::meusAnuncios($id);

        $response =[
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }

    public function meusAnuncioWeb(){
        if(!key_exists('email',session()->all())){
            return view('auth.login');
        }else {
            $id = Atacadista::findId(session()->all()['id']);

            $anuncio = Anuncio::meusAnunciosWeb($id);

            return view('admin.user.meusanuncios', compact('anuncio'));
        }
    }

    public function todasPromocoesApp(){

        $anuncio = Anuncio::todasPromocoesApp();

        $response =[
            'promocoes' => $anuncio
        ];

        return response()->json(compact('response'));

    }

    public function todasPromocoes(){

//        $anuncio = Anuncio::todasPromocoes();

        return view('promocoes');
    }
    public function moretodasPromocoes($inicio){

        $anuncio = Anuncio::moreodasPromocoes($inicio);

        return $anuncio;
    }

    public function promocoesWeb(){
        if(!key_exists('email',session()->all())){
            return view('auth.login');
        }else {
            $id = Atacadista::findId(session()->all()['id']);

            $promocoes = Anuncio::promocoesWeb($id);

            return view('admin.user.promocoes', compact('promocoes'));
        }
    }
    public function promocoes($id){

        $promocoes = Anuncio::promocoes($id);
        $response =[
            'promocoes' => $promocoes
        ];

        return response()->json(compact('response'));
    }
    public function addpromocoesWeb(Request $request){

        //dd($request);

        $anuncio = Anuncio::addpromocoesWeb($request->input);

        $response =[
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }
    public function pararPromocoesWeb($id){
        //Auth::User()->id
        //$id = User::findIdUsuario(Auth::User()->id);

        $anuncio = Anuncio::pararPromocoesWeb($id);

        $response =[
            'anuncio' => $anuncio
        ];

        return response()->json(compact('response'));
    }

    public function historico(Request $id){

        $id_comprador = User::findIdUsuario($id);
        $id_comprador = intval($id_comprador['0']->ID_COMPRADOR);

        $favorito = Anuncio::historicoAdd($id_comprador,$id);

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {

            if($favorito == 1){
                $success = [
                    'successId' => 200,
                    'successMessage' => 'Anuncio adicionado com sucesso!'
                ];
                $response = [
                    'success' => $success
                ];
                return response()->json(compact('response'), 200);

            }
            else{
                $error = [
                    'Erro' => 500,
                    'ErroMessage' => 'Erro ao adicionar anuncio'
                ];
                $response = [
                    'Error' => $error
                ];
                return response()->json(compact('response'),500);

            }
        } else {

            if($favorito == 1){
                return response()->json(compact('Sucesso'), 200);
            }
            else{
                return response()->json(compact('Erro'),500);

            }
        }


    }

    public function infogeral($id){

        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::infoGeral($id);

            return $info;

        }else{
            $info = Anuncio::infoGeralWeb($id);

            return $info;
        }
    }

    public function infoProvedor($id){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        //retirar o colchete: ['0]
        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::infoProvedor($id);
           
            $response =[
                'info' => $info
            ];

           
            return response()->json(compact('response'));
           // return $info;

        }else{
            $info = Anuncio::infoProvedorWeb($id);

            return $info;
        }

    }

    public function EspTecnica($id){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $info = Anuncio::espTecnica($id);

            $tec = Anuncio::infoProvedor($id);
           
            $response =[
                'certificado' => $info,
                'provedor' => $tec
            ];

            return response()->json(compact('response'));

        }else{
            $info = Anuncio::espTecnicaWeb($id);

            return $info;
        }


    }
    public function EspTecnicaWeb($id){
        $info = Anuncio::espTecnicaWeb($id);

        return $info;
    }

    public function desconto($idAnuncio, $vlr){
        $desconto = Anuncio::desconto($idAnuncio, $vlr);

        return $desconto;
    }

    public function anuncie(){

        if(!key_exists('email',session()->all())) {

            return view('auth.login');
        }elseif(
            Atacadista::where('ID_COMPRADOR',session()->all()['id'])->first()->NR_CNPJ == NULL ||
            Atacadista::join('TB_CONTATO','TB_PRODUTOR.ID_PRODUTOR','TB_CONTATO.ID_PRODUTOR')->where('ID_COMPRADOR',session()->all()['id'])->first()->NR_TELEFONE == NULL ||
            Atacadista::join('TB_CONTATO','TB_PRODUTOR.ID_PRODUTOR','TB_CONTATO.ID_PRODUTOR')->where('ID_COMPRADOR',session()->all()['id'])->first()->DS_EMAIL == NULL
        ){
            $qtProduto = [];
            for ($i = 0; $i <= 1000; $i += 1) {
                $qtProduto[] = $i;
            }
            $end = 0;
            return view('admin.user.novoanuncio', compact('end','qtProduto'));
        }else{

            $qtProduto = [];
            for ($i = 0; $i <= 1000; $i += 1) {
                $qtProduto[] = $i;

            }
            return view('admin.user.novoanuncio')->with('qtProduto', $qtProduto);
        }
    }

    public function produto(){
        return view('produto');
    }
    public function produtoDetalhe($id){
        $infoAnuncio = Anuncio::infoAnuncio($id);

        return $infoAnuncio;
    }
    public function produtoinfo($id){
        $id = Crypt::decrypt($id);
        return view('produtosearch', compact('id'));
    }

    public function produtoDetalhePage(){

        return view('produtoDetalhe');
    }


    public function promocaoSemana(){
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            //ALTERAR
            $anuncios = Anuncio::listar();

            $response =[
                'anuncio' => $anuncios
            ];

        }else{
            $anuncios = Anuncio::listaPromocoesWeb();


            return response()->json(compact('anuncios'));
        }


        return response()->json(compact('response'));
    }

    public function cores(Request $request){
        $cores = Cor::corAnuncio($request['input']);

        return $cores;
    }

    public function promocaoPage(){

        return view('admin.user.promocoes');
    }

    public function promocaoNovaPage(){

        return view('admin.user.ativarPromocao');
    }
    public function promocaoNova($id){

       // $id = 47;
        $precos = Anuncio::precoProduto($id);


        return $precos;
    }


    public function buscar(Request $request){
        $cat = $request->cat;
        $anuncio = [];

         $categoria = DB::table('TB_TIPO_PRODUTO')->where('DS_TIPO_PRODUTO','like','%'.$cat.'%')->select('DS_TIPO_PRODUTO')->get();
         $produtos = DB::table('TB_PRODUTO')->where('DS_PRODUTO','like','%'.$cat.'%')->select('DS_PRODUTO')->get();

//         foreach ($categoria as $item){
//             array_push($anuncio, $item);
//         }
//        foreach ($produtos as $i){
//            array_push($anuncio, $i);
//        }

        return [$categoria,$produtos];

    }

    public function buscados(Request $request){

        $categoria = Categoria::categoriaBuscada($request->input);
        $anuncio = Anuncio::anuncioBuscado($request->input);

        if(count($categoria) > 0){
            return $categoria;
        }else{
            return $anuncio;
        }

    }
    public function buscadospage(){


        return view('promocoes');
    }
    public function certificacao($id){
        $fotosCerticados = Certificado::fotos($id);

        return $fotosCerticados;
    }
    public function empresaFoto($id){
        $fotosCerticados = Certificado::fotos($id);

        return $fotosCerticados;
    }

    public function visita($id){

        if(key_exists('email',session()->all())){

            if( !(Visita::where('ID_COMPRADOR', session()->all()['id'])->where('ID_ANUNCIO_PRODUTO',$id)->count()>0)){
                Visita::inserir($id, session()->all()['id']);
            }
        }

            $infoAnuncio = Anuncio::addvisita($id);
            return $infoAnuncio;
    }

    public function AnunuciosMiasVisto(){
        if(key_exists('email', session()->all())){

            $anuncios = Anuncio::listarVistados(session()->all()['id']);


            return ([$anuncios, 1]);
        }else{

            $anuncios = Anuncio::listarMaisVistos();
            return ([$anuncios, 0]);
        }

    }
    public function AnunuciosMiasVistoApp(){
            $anuncios = Anuncio::listarMaisVistosApp();
            $response =[
                'anuncio' => $anuncios
            ];
            return response()->json(compact('response'));

    }


    public function morelist($inicio){
        $moreListAnuncio = Anuncio::listMoreAnuncio($inicio);

        return $moreListAnuncio;
    }
    public function moreListMiasvistos($inicio){
        if(key_exists('email',session()->all())){
            //$id = Comprador::findId(Auth::User()->id);
            $moreListAnuncio = Anuncio::listMoreMiasVisitados($inicio,session()->all()['id']);



            return ([$moreListAnuncio, 1]);
        }else{

            $anuncios = Anuncio::listarMoreMaisVistos($inicio);
            return ([$anuncios, 0]);
        }
    }
    public function moreListMiasvistosApp($inicio){
        if(!key_exists('email',session()->all())){
            //$id = Comprador::findId(Auth::User()->id);
            $moreListAnuncio = Anuncio::listMoreMiasVisitados($inicio,session()->all()['id']);

            $response =[
                'anuncio' => $moreListAnuncio[0]
            ];
            return response()->json(compact('response'));
        }else{

            $anuncios = Anuncio::listarMoreMaisVistosApp($inicio);
            $response =[
                'anuncio' => $anuncios[0]
            ];
            return response()->json(compact('response'));
        }
    }

    public function PedidosApp($id){
        $pedidos = Anuncio::Pedidos($id);
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            $response =[
                'pedidos' => $pedidos
            ];

            return response()->json(compact('response'));
        }else{
            return $pedidos;
        }
    }

    public function Pedidos(){


        if(!key_exists('email',session()->all())){
            return view('auth.login');
        }else{
            $pedidos = Anuncio::Pedidos(session()->all()['id']);

            return view('admin.user.historico',compact('pedidos'));
        }
    }


    public function PedidosDetalheApp($id,$comprador){
        $pedidos = Anuncio::PedidosDetalhe($id,$comprador);

        $response =[
            'pedidos' => $pedidos
        ];

        return response()->json(compact('response'));
    }


    public function destaques(){

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        

        if (preg_match($pattern, $currentPath)) {
            $promocoes = Anuncio:: DestaquesApp();
           

            $response =[
                'destaques' => $promocoes
            ];

            return response()->json(compact('response'));
        }else{
            $promocoes = Anuncio::Destaques();
            return view('destaques', compact('promocoes'));
        }
    }

    public function destaquesMore($inicio){

        $promocoes = Anuncio::destaquesMore($inicio);

        return $promocoes;
    }

    public function remove($id){

        $response = Anuncio::deleteById($id);


        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response',404));
        }else{

            if(isset($response['success']['successId'])){
                return 1;
            }else{
                return 0;
            }

        }
    }
    public function editar($id){

        $infoAnuncio = Anuncio::infoAnuncio($id);
        $id_atacado = Atacadista::findId( session()->all()['id']);

        $fotosCerticados = Certificado::fotos($id);
        $fotoEmpresa = Atacadista::empresaFoto($id_atacado);
       
        return [$infoAnuncio,$fotosCerticados ,$fotoEmpresa];
    }
    public function editarPage(){

        return view('admin.user.anuncioeditar');
    }

    public function editarUpload(Request $request){
        $usuario = $request->input();
       
        $pieces = explode(" ", $usuario['input'][4]);

        if(count($pieces) > 1){
            $usuario['input'][4] = str_replace(',', '.', $pieces[1]);
        }

        $credentials = [
            'anuncioId' => $usuario['input'][13],
            'produtoId' => $usuario['input'][3],
            'nome' => $usuario['input'][0],
            'descricao' => $usuario['input'][1],
            'codigo' => $usuario['input'][2],
            'produto' => $usuario['input'][3],
            'quatidade' => $usuario['input'][5],
            'quatidadeMinima' => $usuario['input'][6],
            'cor' => $usuario['input'][9],
            'preco' => $usuario['input'][4],
            'tamanho' => $usuario['input'][7],
            'fotos' => $usuario['input'][10],
            'certificados' => $usuario['input'][11],
            'precos' => $usuario['input'][12],
            'garantia' => $usuario['input'][14]
        ];

        $validator = \Validator::make($credentials, [

            'produtoId' => "required",
            'nome' => "required",
            'descricao' => "required",
//            'video' => $credentials['video'],
            'quatidade' => "required",
//            'peso' => $credentials['peso'],
            'quatidadeMinima' => "required",
//            'capacidade' => $credentials['capacidade'],
        ]);
      
        $credentials['codigo'] = Categoria::getId($credentials['produtoId']);
        $id = Anuncio::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->select('ID_PRODUTO')->first();
        
        try{
            DB::table('TB_PRODUTO')->where('ID_PRODUTO', intval($id->ID_PRODUTO))
            ->update([
                'ID_CATEGORIA_PRODUTO' => intval($credentials['codigo']),
                'DS_PRODUTO' => $credentials['nome'],
                'DS_FOTO_PRODUTO' =>$credentials['nome']
            ]);
        }catch(\Exception $e){
            return 0;
        }
        
      
        if ($validator->fails()) {
            $error = response()->json(['error' => 'invalid_credentials'], 428);
            $error = [
                'errorId' => 428,
                'errorMessage' => 'credenciais invalidas'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'), 428);
        }else{
            //ANUNCIO
            try{
               
                $userInfo = Anuncio::where('ID_ANUNCIO_PRODUTO', $credentials['anuncioId'])->update([
                    'DS_ANUNCIO_PRODUTO' => $credentials['nome'],
                    'DS_DETALHE_PRODUTO' => $credentials['descricao'],
                    'QT_DISPONIVEL' => $credentials['quatidade'],
                    'QT_MINIMA_PEDIDO' => $credentials['quatidadeMinima'],
                    'DS_CAPACIDADE_FORNECIMENTO' => $credentials['quatidade'],
                    'VL_PRODUTO_UNITARIO' => floatval($credentials['preco']),
                    'DS_GARANTIA' => $credentials['garantia'],
                ]);
            }catch(\Exception $e){
                return 0;

            }
            

          // TAMANHO
         
            try{
                if(Tamanho::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->count() > 0){
                    Tamanho::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->delete();
                }
                foreach ($credentials['tamanho'] as $i) {

                    if (!(($i['tamanho'] == "0") && ($i['metragem'] == ''))) {

                        $idTamanho = DB::table('TB_TAMANHO')->where('DS_TAMANHO', $i['tamanho'])->select('ID_TAMANHO')->first();

                        $corinfo = Tamanho::insert([
                            'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                            'ID_TAMANHO' =>$idTamanho->ID_TAMANHO,
                            'DS_TAMANHO' =>$i['tamanho'] ,
                            'DS_METRAGEM' =>$i['metragem'] ,
                        ]);
                    }
                }
            }catch(\Exception $e){

                return 0;

            }
           
           // PRECO
            try{

                if(Preco::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->count() > 0){
                    Preco::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->delete();
                }

                foreach ($credentials['precos'] as $key => $item){
                    $pieces = explode(" ", $item['preco']);
                    if(count($pieces) > 1){
                        $item['preco'] = str_replace(',', '.', $pieces[1]);
                    }

                    $precoinfo = Preco::insert([
                        'ID_ANUNCIO_PRODUTO' =>  $credentials['anuncioId'],
                        'VL_PRODUTO' => floatval($item['preco']),
                        'QT_INICIAL' => floatval($item['inicio']),
                        'QT_FINAL' => floatval($item['fim']),
                    ]);
                }
            }catch(\Exception $e){

                return 0;

            }
            
//           // COR
            try{

                if(Cor::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->count() > 0){
                    Cor::where( 'ID_ANUNCIO_PRODUTO',$credentials['anuncioId'])->delete();
                }

                foreach ($credentials['cor'] as $item) {
                    $corinfo = Cor::insert([
                        'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                        'DS_COR' => $item,
                        'ID_COR' => 1,
                    ]);
                }
            }catch(\Exception $e){

                return 0;

            }
           
//            //FOTOS

            try{
               $fotos = [];
                $files = glob("images/anuncio/" .  $credentials['anuncioId'] . "/*"); // get all file names

                foreach ($files as $file) { // iterate files

                    $pieces = explode("images/anuncio/" .  $credentials['anuncioId'] ."/", $file);
                    
                    if (!in_array($pieces[1], $credentials['fotos'])) {
                        
                        array_push($fotos, $pieces[1]);
                        if(unlink($file)){
                            $cert = DB::table('TB_FOTO_PRODUTO')
                            ->where('DS_FOTO_PRODUTO',$pieces[1])->delete();
                        }
                    }

                }

                foreach ($credentials['fotos'] as $item) {

                    $newPath = ("C:/Inetpub/vhosts/myappnow.com.br/atacado.club/clubeatacado/images/anuncio/" . $credentials['anuncioId']);
                    $extencao = explode(".",$item);
                    $extencao = end($extencao);
                    if (!file_exists($newPath)) {
                        mkdir($newPath, 0777, true);
                        chmod($newPath, 0777);
                    }
                    $file = new Filesystem();
                    //$file->moveDirectory('C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\\images\\resource\\tmp\\anuncio\\'.$usuario['input'][$i],  "C:\Inetpub\\vhosts\\myappnow.com.br\\recicla.myappnow.com.br\\recicla\\images\\anuncios\\".$anuncio."\\".$usuario['input'][$i]);
                    //adicionar pasta usuario
                    $foto = "photo".substr(md5(rand(600000 , 12000000)), 0,8).".".$extencao;
                   
                    if($file->moveDirectory('images/resource/tmp/anuncio/'.$item,  "images/anuncio/".$credentials['anuncioId']."/".$foto)){

                        $foto = FotoAnuncio::insert([
                            'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId'],
                            'DS_FOTO_PRODUTO' =>$foto,
                        ]);
                        

                    }else {
                        $errors = error_get_last();
                        $error = $errors['type'];
                        $response = [
                            'error' => $error
                        ];
                    }
                }
            }catch(\Exception $e){
                  return 0;
            }
//            //CERTIFICADOS
            try{
               
                $fotosC = [];
                $files = glob("images/certificados/" .  $credentials['anuncioId'] . "/*"); // get all file names
                
                foreach ($files as $file) { // iterate files

                    $pieces = explode("images/certificados/" . $credentials['anuncioId'] ."/", $file);
                    
                    if (!in_array($pieces[1], $credentials['certificados'])) {
                        
                        if(unlink($file)){
                            array_push($fotosC, $pieces[1]);
                            
                            $cert = DB::table('TB_CERTIFICACAO')
                            ->where('DS_FOTO_CERTIFICACAO',$pieces[1])->delete();

                        }
                    }
                }
            foreach ($credentials['certificados'] as $key => $item) {
                $newPath = ("images/certificados/" . $credentials['anuncioId']);
                $extencao = explode(".",$item);
                $extencao = end($extencao);
                if (!file_exists($newPath)) {
                    mkdir($newPath, 0777, true);
                    chmod($newPath, 0777);
                }
                $file = new Filesystem();
                $foto = "cetificado".substr(md5(rand(600000 , 12000000)), 0,8).".".$extencao;
                
                //adicionar pasta usuario
                if($file->moveDirectory('images/resource/tmp/anuncio/'.$item,  "images/certificados/". $credentials['anuncioId']."/".$foto)) {
                    //$file->moveDirectory('images\\resource\\tmp\\empresa\\'.$data[$j],  "images\\empresas\\".$usuarioId."\\".$data[$j])
                    $id = Atacadista::findId(session()->all()['id']);

                    $foto = Certificado::updateOrCreate([
                        'ID_PRODUTOR' => $id,
                        'DS_FOTO_CERTIFICACAO' => $foto,
                        'ID_ANUNCIO_PRODUTO' => $credentials['anuncioId']
                    ]);
//                \File::delete('images\\resource\\tmp\\empresa\\'.$data[$j]);

                }else {
                    $errors = error_get_last();
                    $error = $errors['type'];
                    $response = [
                        'error' => $error
                    ];
                }
            }
            }catch(\Exception $e){
                return 0;

            }

            return 1;
        }
    }
    public function removerFoto($id, $foto){
       
        //FOTOS
        try{
            $fotos = [];
             $files = glob("images/anuncio/" .  $id . "/*"); // get all file names

             foreach ($files as $file) { // iterate files

                 $pieces = explode("images/anuncio/" .  $id ."/", $file);

                 if ($pieces[1] == $foto) {
                
                     array_push($fotos, $pieces[1]);
                     if(unlink($file)){
                         FotoAnuncio::where('DS_FOTO_PRODUTO',$foto)->delete();
                    }
                }
            }
        }catch(\Exception $e){
           
        }
        
          //CERTIFICADOS
          try{
            $fotosC = [];
            $files = glob("images/certficados/" . $id . "/*"); // get all file names
            
            foreach ($files as $file) { // iterate files
                
                $pieces = explode("images/certficados/" . $id ."/", $file);
               
                if ($pieces[1] == $foto) {
                    
                    array_push($fotosC, $pieces[1]);
                    if(unlink($file)){
                        Certificado::where('DS_FOTO_CERTIFICACAO',$pieces[1])->delete();
                    }
                }

            }
        }catch(\Exception $e){
           
        }
    }

    public function addComentario(Request $request){
        $credenciais = $request->input;
    
        try{
            $comentario = DB::table('TB_AVALIACAO_PRODUTO')
            ->insert([
                'ID_ANUNCIO_PRODUTO' =>$credenciais[2],
                'ID_COMPRADOR' => session()->all()['id'],
                'DS_AVALIACAO' =>$credenciais[0],
                'VL_AVALIACAO' =>$credenciais[1],
                'DT_AVALIACAO' => date("Y-m-d H:i:s")
            ]);
            
        }catch(\Exception $e){
            return 0;
        }
        return  1;
    }  
    public function ComentarioShowMore($skip, $id){
       $comentarios = Anuncio::MoreComents($skip, $id);

       return $comentarios;
    }    
}
