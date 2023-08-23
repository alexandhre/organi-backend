<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    public static function create(Request $json)
    {
        $currentPath= Route::getFacadeRoot()->current()->uri();
        $pattern = '/' . 'api' . '/';
        if (preg_match($pattern, $currentPath)) {
            $request = json_decode(json_encode($json['request'],true));
        }else{
            $request = $json->request;
        }
        foreach ($request as $item){
            $email = $item;
        }

        $user = User::where('email', $email)->first();

        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email]
        );
        if ($user && $passwordReset) {

            $array= [
                'senha' => substr(md5(rand(600000 , 12000000)), 0,8),
                'email' => $email
            ];

            $user->notify(

                new PasswordResetRequest($user, $array)
            );

            User::updatesenha($array);
            // Usuario::token($passwordReset->remember_token);

            $currentPath= Route::getFacadeRoot()->current()->uri();
            $pattern = '/' . 'api' . '/';

            if (preg_match($pattern, $currentPath)) {
                $success = [
                    'successMessage' => 'Email enviado com secesso!'
                ];

                return response()->json(compact('success'));
            }else{
                $senha = $array['senha'];

                $categoria = Produto::listAll();
                $show = 0;
                return redirect()->back()->with([$senha,$categoria,$show]);
                //return view('auth.passwords.novasenha',compact(['categoria','show','senha']));
            }

        }
    }
}
