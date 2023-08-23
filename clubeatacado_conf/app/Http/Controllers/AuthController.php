<?php

namespace App\Http\Controllers;

use App\PessoaFisica;
use App\PessoaJuridica;
use Illuminate\Http\Request;
use App\User;
use App\Usuario;

class AuthController extends Controller
{
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $userInfo = Usuario::create([
            'ID_PERFIL_USUARIO' => $data['id_perfil'],
            'DS_NOME' => $data['name'],
            'DS_EMAIL' => $data['email'],
            'DS_SENHA' => bcrypt($data['password']),
            'id_users' => $user->id ,
        ]);

        return $user;
    }
}
