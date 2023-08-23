<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ResponseService;
use App\Http\Services\CompradorService;
use App\Http\Services\EmailService;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    
    protected $responseService;

    protected $compradorService;

    protected $emailService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CompradorService $compradorService, 
        ResponseService $responseService,
        EmailService $emailService
        )
    {
        $this->middleware('guest');
        $this->responseService = $responseService;
        $this->compradorService = $compradorService;
        $this->emailService = $emailService;
    }

    public function showRecuperarSenhaForm()
    {
        if (!key_exists('email', session()->all())) {
            return view('auth.passwords.recuperarSenha');        
        }
        return view('home');
    }

    public function enviarEmailRecuperarSenha(Request $request)
    {

        $json = $request->all();
        $dados = json_decode(json_encode($json, true));

        $senha = substr(Hash::make(rand(0, 99999)),0, 8);
        
        try {                      
            $this->emailService->enviarEmail($dados->DS_EMAIL, 0, $senha, 'recuperarSenha');
            $this->compradorService->atualizarSenha($dados->DS_EMAIL, $senha);
        } catch (\Exception $e) {                       
            return $this->responseService->responseErroJson(400, 'Erro ao enviar o email de recuperação de senha!');
        }
        return $this->responseService->responseSucessoJson(200, 'E-mail de recuperação de senha enviado com sucesso!');
    }
}
