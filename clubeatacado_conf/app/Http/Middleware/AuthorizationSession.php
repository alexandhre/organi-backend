<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\ResponseService;
use App\Authorization;
use App\Http\Services\SharedService;

class AuthorizationSession
{

    protected $responseService;

    protected $sharedService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ResponseService $responseService,
        SharedService $sharedService
    ) {
        $this->responseService = $responseService;
        $this->sharedService = $sharedService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {          
        $dados =  $this->sharedService->converterRequestToJson($request);                         
        if (Authorization::validarSessao($dados->idComprador)) {
            return $next($request);
        }
        Authorization::deletarSessao($dados->idComprador);
        $response = [
            'message' => 'Sessão expirada, por favor faça novamente o login!'
        ];    
        return $this->responseService->responseSucessoJson(401, $response);
    }
}
