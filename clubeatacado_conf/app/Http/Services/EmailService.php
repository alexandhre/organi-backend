<?php

namespace App\Http\Services;

use App\User;
use App\Notifications\EmailContato;
use App\Notifications\EmailValidade;
use App\Notifications\PasswordResetRequest;

class EmailService
{
   public function enviarEmail($DS_EMAIL, $ID_COMPRADOR, $DS_SENHA, $metodo)
   {
      $invitedUser = new User;
      $invitedUser->email = $DS_EMAIL;

      //trocar por um switch case
      if($metodo == 'cadastro'){
         $invitedUser->notify(
            new EmailValidade($ID_COMPRADOR)
         );
      } else if($metodo == 'recuperarSenha') {
         $invitedUser->notify(
            new PasswordResetRequest($DS_EMAIL,  $DS_SENHA)
        );
      }     
   }

   public function enviarEmailContato($dados)
   {
      $invitedUser = new User;
      $invitedUser->email = $dados->DS_EMAIL;
      $invitedUser->notify(
         new EmailContato($dados)
      );
   }
}
