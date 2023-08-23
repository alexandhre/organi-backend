<?php

namespace App\Http\Controllers\anuncio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Anuncio;
use Illuminate\Support\Facades\DB;

class ApiAnuncioController extends Controller
{

    public function listar(){
        $anuncio = Anuncio::listaAnuncio();

        $response = [
            'anuncios' => $anuncio,
        ];


        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));

        }else{
            $currentPath= Route::getFacadeRoot()->current()->uri();

            if($currentPath == 'site'){
                return view('site',compact('anuncio'));

            }else if ($currentPath == 'oferta'){
                return view('admin/oferta',compact('anuncio'));
            }


        }

    }

    public function ultimosanuncios()
    {
        $anuncio = Anuncio::lastanuncio();

        //$anuncio = Anuncio::returnjson($anuncio);

        $currentPath = Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {

            $response = [
                'anuncios' => $anuncio

            ];
            return response()->json(compact('response'));
        } else {

            //$anuncio = json_encode($anuncio);
            return view('site',compact('anuncio'));
        }
    }

    public function novoanuncio(Request $request){
        //dd($request);
        $json = $request->all();

        //converte json em tipo data
        $data = json_decode(json_encode($json['request'],true));

        $credentials = [
            'anuncianteId' => $data->anuncianteId,
            'coletorId' => $data->coletorId,
            'residuoId' => $data->residuoId,
            'titulo' => $data->titulo,
            'descricao' => $data->descricao,
            'latitude' => $data->latitude,
            'longetude' => $data->longetude,
            'peso' => $data->peso,
            'vlrAnuncio' => $data->vlrAnuncio,
            'hrColeta' => $data->hrColeta,
            'avAnuncio' => $data->avAnuncio,
            'avColeta' => $data->avColeta,
        ];

        $validator = \Validator::make($credentials, [
            "anuncianteId" => "required",
            "coletorId" => "required",
            "residuoId" => "required",
            "titulo" => "required",
            "descricao" => "required",
            "latitude" => "required",
            "longetude" => "required",
            "peso" => "required",
            "vlrAnuncio" => "required",
            "hrColeta" => "required",
            "avAnuncio" => "required",
            "avColeta" => "required",
        ]);

        if($validator->fails()){
            $error = response()->json(['error' => 'invalid_credentials'], 428);
            $error = [
                'errorId' => 428,
                'errorMessage' => 'Usuário já autenticado no sistema!'
            ];

            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'),428);
        }else{
            $userInfo = Anuncio::create([
                'ID_USUARIO_ANUNCIANTE' =>$credentials['anuncianteId'],
                'ID_USUARIO_COLETOR'=>$credentials['coletorId'],
                'ID_RESIDUO'=>$credentials['residuoId'],
                'DS_TITULO_ANUNCIO'=>$credentials['titulo'],
                'DS_ANUNCIO'=>$credentials['descricao'],
                'VL_LAT'=>$credentials['latitude'],
                'VL_LNG'=>$credentials['longetude'],
                'VL_PESO'=>$credentials['peso'],
                'VL_ANUNCIO'=>$credentials['vlrAnuncio'],
                'HR_COLETA'=>$credentials['hrColeta'],
                'VL_AVALIACAO_USUARIO_ANUNCIO'=>$credentials['avAnuncio'],
                'VL_AVALIACAO_USUARIO_COLETA'=>$credentials['avColeta']
            ]);
            $success = [
                'successId' => 200,
                'successMessage' => 'Usuário cadastrado com sucesso!'
            ];
            $response = [
                'success' => $success
            ];
        }


        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';

        if (preg_match($pattern, $currentPath)) {
            return response()->json(compact('response'));

        }else{
            echo "controller usuario";
            exit();
        }
    }

    public function morelist($inicio){
        $moreListAnuncio = json_encode(Anuncio::listMoreAnuncio($inicio));

        return $moreListAnuncio;
    }
}
