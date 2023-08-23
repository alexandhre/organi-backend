<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'TB_COMPRADOR';

    protected $fillable = [
        'ID_QUALIFICACAO',
        'ID_CIDADE',
        'DS_NOME',
        'DS_SOBRENOME',
        'ND_CPF',
        'DS_ENDERECO',
        'DS_COMPLETO',
        'NR_ENDERECO',
        'NR_CEP',
        'DS_EMAIL',
        'NR_DDD_TELEFONE',
        'NR_TELEFONE',
        'DS_GMAIL',
        'DS_LOGIN',
        'DS_SENHA',
        'DS_FACEBOOK',
        'DS_INSTAGRAM',
        'DS_FOTO_COMPRADOR',
        'DT_CADASTRO_COMPRADOR',
        'id_user',
//        'name', 'email', 'password','id_perfil','validade'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function infos(){
        $usuario = DB::table('TB_FAQ')
            ->select(
                'DS_PERGUNTA as pergunta'
            ,'DS_RESPOSTA as resposta')
            ->get();
        return $usuario;
    }

    public function getAuthPassword()
    {
        return $this->DS_SENHA;
    }

    public static function updatesenha(array $array){
        $usuario = DB::table('TB_COMPRADOR')
            ->where('DS_EMAIL',$array['email'])
            ->update([
                'DS_SENHA' => Hash::make(($array['senha'])),
            ]);

        return $array['senha'];
    }

    public static function userdetail($id){
      
        $usuario = DB::table('TB_COMPRADOR')
            ->join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')
            ->join('TB_CIDADE','TB_COMPRADOR.ID_CIDADE','TB_CIDADE.ID_CIDADE')
            ->join('TB_CONTATO','TB_PRODUTOR.ID_PRODUTOR','TB_CONTATO.ID_PRODUTOR')
            ->join('TB_UF','TB_CIDADE.ID_UF','TB_UF.ID_UF')
            ->select(
                'TB_COMPRADOR.ID_COMPRADOR'
                ,'TB_PRODUTOR.ID_PRODUTOR'
                ,'TB_PRODUTOR.DS_RAZAO_SOCIAL'
                ,'TB_PRODUTOR.DS_NOME_FANTASIA'
                ,'TB_PRODUTOR.DS_ENDERECO AS enderecoEmp'
                ,'TB_PRODUTOR.DS_COMPLEMENTO AS complementoEmp'
                ,'TB_PRODUTOR.NR_ENDERECO AS NREmp'
                ,'TB_PRODUTOR.NR_CEP AS CEPEmp'
                ,'TB_CIDADE.DS_CIDADE'
                ,'TB_UF.DS_UF'
                ,'TB_PRODUTOR.NR_CNPJ'
                ,'TB_PRODUTOR.DS_VIDEO_PROMOCIONAL'
                ,'TB_PRODUTOR.DS_TAMANHO_FABRICA as tamanhoFab'
                ,'TB_PRODUTOR.QT_EMPREGADOS'
                ,'TB_PRODUTOR.DS_LOGOTIPO'
                ,'TB_PRODUTOR.ID_TIPO_NEGOCIO'
                ,'TB_PRODUTOR.ID_CATEGORIA_EMPRESA'
                ,'TB_COMPRADOR.DS_NOME'
                ,'TB_COMPRADOR.DS_SOBRENOME'
                ,'TB_COMPRADOR.NR_CPF'
                ,'TB_COMPRADOR.DS_EMAIL'
                ,'TB_COMPRADOR.DS_ENDERECO'
                ,'TB_COMPRADOR.DS_COMPLEMENTO'
                ,'TB_COMPRADOR.NR_ENDERECO'
                ,'TB_COMPRADOR.NR_CEP'
                ,'TB_COMPRADOR.NR_DDD_TELEFONE'
                ,'TB_COMPRADOR.NR_TELEFONE'
                ,'TB_COMPRADOR.DS_FACEBOOK'
                ,'TB_COMPRADOR.DS_INSTAGRAM'
                ,'TB_COMPRADOR.DS_GMAIL'
                ,'TB_COMPRADOR.DS_FOTO_COMPRADOR'
                ,'TB_CONTATO.DS_NOME as nomeContato'
                ,'TB_CONTATO.DS_SOBRENOME as sobrenomeContato'
                ,'TB_CONTATO.DS_CARGO as cargo'
                ,'TB_CONTATO.NR_DDD_TELEFONE as dddContato'
                ,'TB_CONTATO.NR_TELEFONE as telContato'
                ,'TB_CONTATO.NR_WHATSAP as whatsassp'
                ,'TB_CONTATO.DS_EMAIL as emailContato'
            )
            ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
            ->get();  
            
           


        $cidadeEmp = DB::table('TB_PRODUTOR')
            ->join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->join('TB_CIDADE','TB_PRODUTOR.ID_CIDADE','TB_CIDADE.ID_CIDADE')
            ->join('TB_UF','TB_CIDADE.ID_UF','TB_UF.ID_UF')
            ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
            ->select( 'TB_CIDADE.DS_CIDADE as cidadeEmp','TB_UF.DS_UF as ufEmp')->get();
        if(count($cidadeEmp)>0){
            $usuario['0']->ufEmp = $cidadeEmp['0']->ufEmp;
            $usuario['0']->cidadeEmp = $cidadeEmp['0']->cidadeEmp;
        }else{
            $usuario['0']->ufEmp = '';
            $usuario['0']->cidadeEmp = '';
        }

        $cidadeAtendida = DB::table('TB_CIDADE_ATENDIDA')
            ->join('TB_PRODUTOR','TB_CIDADE_ATENDIDA.ID_PRODUTOR','TB_PRODUTOR.ID_PRODUTOR')
            ->join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->join('TB_CIDADE','TB_CIDADE_ATENDIDA.ID_CIDADE','TB_CIDADE.ID_CIDADE')
            ->join('TB_UF','TB_CIDADE.ID_UF','TB_UF.ID_UF')
            ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
            ->select( 'TB_CIDADE.DS_CIDADE as cidadeAtendida','TB_UF.DS_UF as ufAtendida')->get();

        if(count($cidadeAtendida)>0){
            $usuario['0']->ufAtendida = $cidadeAtendida['0']->ufAtendida;
            $usuario['0']->cidadeAtendida = $cidadeAtendida['0']->cidadeAtendida;
        }else{
            $usuario['0']->ufAtendida = '';
            $usuario['0']->cidadeAtendida = '';
        }


        $usuario['0']->tipoEmpresa = DB::table('TB_TIPO_NEGOCIO')
            ->select( 
                'ID_TIPO_NEGOCIO'
                ,'DS_TIPO_NEGOCIO'
                ,'ID_CATEGORIA_EMPRESA')->get();

        $usuario['0']->catEmpresa = DB::table('TB_CATEGORIA_EMPRESA')
                ->select( 
                    'ID_CATEGORIA_EMPRESA'
                    ,'DS_CATEGORIA_EMPRESA'
                )->get();
                  
        foreach ($usuario as $item){

            $foto[] = FotoAtacadista::listar($item->ID_PRODUTOR);
            $item->foto = $foto;

        }
        if($usuario['0']->DS_FOTO_COMPRADOR != null){
            $DS_FOTO = explode(".", $usuario['0']->DS_FOTO_COMPRADOR);
            $usuario['0']->extencaoFoto = $DS_FOTO[1];
        }else{
            $usuario['0']->extencaoFoto = null;
        }

        $estados = $estados = Comprador::getEstados();

        $usuario['0']->estados = $estados;
        return $usuario;
    }

    protected function createUserApp(array $data)
    {
        $user = DB::table('users')->insert(
            ['name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])]
        );

        return $user;
    }

    public static function updateToken($data_auth, $id_user){
        $updateToken = DB::table('users')
            ->where('id',$id_user)
            ->update(['DS_TOKEN' => $data_auth['token'],'DT_CREATE_TOKEN' => $data_auth['creationDate']]);

        return $updateToken;
    }

    public static function findByEmail($email){
        $listaUsers = DB::table('users')
            ->where('email',$email)
            ->get();

        return $listaUsers;
    }

    public static function findById($id){
        $listaUsers = DB::table('users')
            ->where('id',$id)
            ->select('id_perfil','id')
            ->get();

        return $listaUsers;
    }

    public static function validacao($email){
        $listaUsers = DB::table('users')
            ->select('validade')
            ->where('email',$email)
            ->get();

        return $listaUsers;
    }

    public static function verificacao($id){
        $listaUsers = DB::table('TB_COMPRADOR')
            ->where('ID_COMPRADOR',$id)
            ->update(['DS_VALIDACAO' =>1]);

        return $listaUsers;
    }

    public static function deleteById($id){
        $usuairo = DB::table('user')
            ->where('user',$id)
            ->delete();

    }

    public static function findIdUsuario($id){

            $usuario = Atacadista::findId($id);

            return $usuario;


    }

    public static function userchat($id){

        $usuario = DB::table('TB_PRODUTOR')
        ->join('TB_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->select(
                'ID_PRODUTOR as id',
                'TB_PRODUTOR.ID_COMPRADOR as idComprador',
                'DS_NOME_FANTASIA as nome'
                ,'DS_FOTO_COMPRADOR as foto'
            )
            ->where('ID_PRODUTOR',$id)
            ->get();


        if(count($usuario) <1 ){
            $usuario = DB::table('TB_COMPRADOR')
                ->join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')
                ->select(
                    'ID_PRODUTOR as id',
                    'TB_COMPRADOR.ID_COMPRADOR as idComprador',
                    'DS_NOME as nome'
                    ,'DS_FOTO_COMPRADOR as foto'
                )
                ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
                ->get();
            $usuario['0']->usuarioLogin = Atacadista::findId(session()->all()['id']);
        }else{
            $usuario['0']->usuarioLogin = session()->all()['id'];
        }

        $usuario['0']->review = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR','TB_AVALIACAO_PRODUTO.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_COMPRADOR',$usuario['0']->idComprador)
            ->select(
                DB::raw( 'SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao' )
                    ,DB::raw( 'COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao' )
            )->get();


        if($usuario['0']->foto == null){
            $usuario['0']->foto = null;
        }else{
            $usuario['0']->foto = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/".$usuario['0']->idComprador.'/'.$usuario['0']->foto;
        }

        return $usuario;
    }

    public static function userchatApp($id){

        $usuario = DB::table('TB_PRODUTOR')
            ->select(
                'ID_COMPRADOR as id',
                'ID_COMPRADOR as idComprador',
                'DS_NOME_FANTASIA as nome'
                ,'DS_LOGOTIPO as foto'
            )
            ->where('ID_PRODUTOR',$id)
            ->get();


        if(count($usuario) <1 ){
            $usuario = DB::table('TB_COMPRADOR')
                ->join('TB_PRODUTOR','TB_COMPRADOR.ID_COMPRADOR','TB_PRODUTOR.ID_COMPRADOR')
                ->select(
                    'ID_PRODUTOR as id',
                    'TB_COMPRADOR.ID_COMPRADOR as idComprador',
                    'DS_NOME as nome'
                    ,'DS_FOTO_COMPRADOR as foto'
                )
                ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
                ->get();
            //$usuario['0']->usuarioLogin = Atacadista::findId(session()->all()['id']);
        }else{
            //$usuario['0']->usuarioLogin = session()->all()['id'];
        }

        $usuario['0']->review = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR','TB_AVALIACAO_PRODUTO.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_COMPRADOR',$usuario['0']->idComprador)
            ->select(
                DB::raw( 'SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao' )
                    ,DB::raw( 'COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao' )
            )->get();

        $usuario['0']->foto = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/".$usuario['0']->idComprador.'/'.$usuario['0']->foto;

        return $usuario;
    }
    public static function user($id){

        $usuario = DB::table('TB_COMPRADOR')
            ->select(
                'TB_COMPRADOR.ID_COMPRADOR as id'
                ,'TB_COMPRADOR.DS_NOME as nome'
                ,'TB_COMPRADOR.DS_FOTO_COMPRADOR as foto')
            ->where('TB_COMPRADOR.ID_COMPRADOR',$id)
            ->get();

            if($usuario['0']->foto == null){
                $usuario['0']->foto = null;
            }else{
                $usuario['0']->foto = "https://testetendering.myappnow.com.br/clubeatacado/images/usuarios/".$usuario['0']->id.'/'.$usuario['0']->foto;
            }
            
            $usuario['0']->review = DB::table('TB_AVALIACAO_PRODUTO')
            ->join('TB_COMPRADOR','TB_AVALIACAO_PRODUTO.ID_COMPRADOR','TB_COMPRADOR.ID_COMPRADOR')
            ->where('TB_AVALIACAO_PRODUTO.ID_COMPRADOR',$usuario['0']->id)
            ->select(
                DB::raw( 'SUM(TB_AVALIACAO_PRODUTO.VL_AVALIACAO)/ COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as avaliacao' )
                    ,DB::raw( 'COUNT(TB_AVALIACAO_PRODUTO.VL_AVALIACAO) as qt_avaliacao' )
            )->get();
            
        return $usuario;
    }
}
