<?php

namespace App\Http\Services;

use App\Comprador;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class CompradorService
{
   public function validarComprador($credenciais)
   {
      $comprador = $this->recuperarCompradorPorEmail($credenciais['email']);
      return !$comprador ? false : true;
   }

   public function validarCompradorAutenticado($comprador)
   {
      return $comprador->DS_VALIDACAO != 1 ? false : true;
   }

   public function recuperarCompradorPorEmail($email)
   {
      return Comprador::recuperarDadosCompradorPorEmail($email);
   }

   public function autenticarComprador($credenciais)
   {
      return Auth::attempt(array(
         'DS_EMAIL' => $credenciais['email'],
         'password' =>  $credenciais['password']
      ));
   }

   public function incluirCompradorNaSessao($comprador, $credenciais)
   {
      session()->flush();
      session([
         'email' => $credenciais['email'],
         'nome' => $comprador->DS_NOME,
         'id' => $comprador->ID_COMPRADOR,
         'atacadista' => $comprador->ID_PRODUTOR != null ? true : false
      ]);
   }

   public function montarResponseComprador($comprador)
   {
      $response = [
         'DS_EMAIL' => $comprador->DS_EMAIL,
         'DS_NOME' => $comprador->DS_NOME,
         'DS_SOBRENOME' => $comprador->DS_SOBRENOME,
         'ID_COMPRADOR' => $comprador->ID_COMPRADOR,
         'ID_PRODUTOR' => $comprador->ID_PRODUTOR,
      ];

      return $response;
   }

   public function atualizarSenha($email, $senha)
   {
      return Comprador::atualizarSenha($email, $senha);
   }

   public function validarDadosUsuario(Request $request)
   {  
      $validator = Validator::make($request->all(), [
         'nome' => 'max:100',
         'sobrenome' => 'max:100',
         'cpf' => ['max:14','max:14', Rule::unique('TB_COMPRADOR', 'NR_CPF')->ignore($request->id_comprador)],
         'email' => ['max:100', Rule::unique('TB_COMPRADOR', 'DS_EMAIL')->ignore($request->id_comprador)],
         'gmail' => ['max:100', Rule::unique('TB_COMPRADOR', 'DS_GMAIL')->ignore($request->id_comprador)],
         'ddd' => 'max:3',
         'telefone' => 'max:15',
         'endereco' => 'max:100',
         'nr_endereco' => 'max:50',
         'complemento' => 'max:100',
         'cep' => 'max:11',
         'facebook' => 'max:100',
         'instagram' => 'max:100',
      ]);

      return $validator;          
   }

   public function atualizarDadosComprador($dados)
   {  
      return Comprador::atualizarDadosComprador($dados);          
   }

   public function recuperarComprasUsuario($id_comprador)
   {  
      return Comprador::recuperarComprasUsuario($id_comprador);          
   }

   public function recuperarFavoritosByUser($id_comprador)
   {  
      return Comprador::recuperarFavoritosByUser($id_comprador);          
   }

   public function recuperarAnunciosUsuario($id_comprador)
   {  
      return Comprador::recuperarAnunciosUsuario($id_comprador);          
   }
}
