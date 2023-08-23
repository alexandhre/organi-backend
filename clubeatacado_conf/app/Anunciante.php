<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Endereco;
use Illuminate\Filesystem\Filesystem;

use Illuminate\Support\Facades\DB;

class Anunciante extends Model
{
    protected $table = 'TB_ANUNCIANTE';

    protected $fillable = [
        'ID_BAIRRO'
        ,'DS_NOME'
        ,'DS_SOBRENOME'
        ,'DS_SENHA'
        ,'DS_EMAIL'
        ,'NR_DDD_TELEFONE'
        ,'NR_TELEFONE'
        ,'IN_PROFISSIONAL'
        ,'IN_SEXO'
        ,'DS_FOTO_COMPRADOR'
        ,'ID_ANUNCIANTE_LARAVEL'
    ];

    protected $tableBairro = 'TB_BAIRRO';

    protected $fillableBairro = [
        'ID_CIDADE'
        ,'DS_BAIRRO'
        ,'DS_COMPLEMENTO'
        ,'NR_ENDERECO'
        ,'DS_CEP'
    ];

    public static function updateByIdWeb($data, $id)
    {
        $bairro = Endereco::updateOrCreat($data, $id);


        if($data[12]!= null){

            $newPath =  ("images\\usuarios\\".$id);
            $extecao = explode(".",$data[12]);
            $extecao = end($extecao);
            if(!file_exists($newPath)){
                mkdir($newPath,0777,true);
                chmod($newPath,0777);
            }

            $file = new Filesystem();
            //adicionar na pasta usuario
            if ($file->moveDirectory('images\\resource\\tmp\\usuario\\'.$data[12],  "images\\usuarios\\".$id."\\photoUsuario.".$extecao)) {

                $update = DB::table('TB_ANUNCIANTE')
                    ->where('ID_ANUNCIANTE_LARAVEL',$id)
                    ->update([
                        'DS_NOME'=>$data[0],
                        'NR_TELEFONE'=>$data[1],
                        'NR_DDD_TELEFONE'=>$data[2],
                        'DS_EMAIL'=>$data[3],
                        'DS_SOBRENOME'=>$data[4],
                        'DS_SENHA'=>md5($data[11]),
                        'DS_FOTO_COMPRADOR' => "photoUsuario.".$extecao,
                        'ID_BAIRRO' => $bairro

      //                'IN_PROFISSIONAL'=>$data[3],
      //                'IN_SEXO'=>$data[5],
                    ]);
                $update = DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'photo' => "photoUsuario.".$extecao
                    ]);

            } else {

                $errors = error_get_last();
                $error = $errors['type'];
                return $error;
            }
        }else{
            $update = DB::table('TB_ANUNCIANTE')
                ->where('ID_ANUNCIANTE_LARAVEL',$id)
                ->update([
                    'DS_NOME'=>$data[0],
                    'NR_TELEFONE'=>$data[1],
                    'NR_DDD_TELEFONE'=>$data[2],
                    'DS_EMAIL'=>$data[3],
                    'DS_SOBRENOME'=>$data[4],
                    'DS_SENHA'=>md5($data[11]),
                    'ID_BAIRRO' => $bairro

//                'IN_PROFISSIONAL'=>$data[3],
//                'IN_SEXO'=>$data[5],
                ]);

        }

        $update = DB::table('users')
            ->where('id',$id)
            ->update([
                'email' =>$data[3]
            ]);
        if($data[11] != ""){
            $update = DB::table('users')
                ->where('id',$id)
                ->update(['password' => bcrypt($data[11])]);
        }

        return $update;

    }
}
