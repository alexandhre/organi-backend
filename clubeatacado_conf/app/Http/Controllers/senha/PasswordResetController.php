<?php

namespace App\Http\Controllers\senha;

use App\Notifications\PasswordResetRequest;
use App\User;
use Illuminate\Http\Request;
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

        $user = User::where('DS_EMAIL', $email)->first();       

        if (!$user){
            $error = [
                'errorId' => 500,
                'errorMessage' => 'Não foi posivel encontrar seu email'
            ];
            $response = [
                'error' => $error
            ];
            return response()->json(compact('response'), 200);
        }

        $passwordReset1 = PasswordReset::updateOrCreate(
            ['DS_EMAIL' => $user->DS_EMAIL]
        );        

        if ($user) {

            $array = [
                'senha' => substr(md5(rand(600000 , 12000000)), 0,8),
                'email' => $email
            ];

            try {
                
                $invitedUser = new User;
                $invitedUser->email = $email;

                $invitedUser->notify(
                    new PasswordResetRequest($user, $array)
                );
            } catch (Exception $e) {
                $error = [
                    'errorId' => 500,
                    'errorMessage' => 'Falha ao enviar email'
                ];
                $response = [
                    'error' => $error
                ];
                return response()->json(compact('response'),200);
            }        

            User::updatesenha($array);
            // Usuario::token($passwordReset->remember_token);

            $currentPath= Route::getFacadeRoot()->current()->uri();
            $pattern = '/' . 'api' . '/';

            if (preg_match($pattern, $currentPath)) {
                $success = [
                    'successMessage' => 'Email enviado com sucesso!'
                ];

                return response()->json(compact('success'));
            }else{
                $senha = $array['senha'];
                //return redirect()->back()->with($senha);
                return view('auth.passwords.novasenha', compact('senha'));
            }

        }
    }

}
